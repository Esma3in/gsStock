<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Mail\MyTestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function index(){
        $customers =Customer::paginate(10);
        return view('customer.index' ,compact('customers'));
    }
    public function show(Customer $customer){
        return view('customer.show', compact('customer'));
    }
    public function create(){

        return view('customer.create');
    }
    public function edit(Customer $customer){
        return view('customer.edit' , compact('customer'));
    }
    public function update(CustomerRequest $request , Customer $customer){
        $customer->update($request->validated());
        return redirect()->route('customers.index')->with('success' ,'info modided successfully');
    }

    public function store(CustomerRequest $request){
       $customer= Customer::create($request->validated());
        Mail::to($customer->email)->send(new MyTestEmail($customer->name));
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        }
        public function delete(Customer $customer)
        {
            return view('customer.delete', compact('customer'));
        }
    public function destroy(Customer $customer){
        $customer->delete();
        return redirect()->route('customers.index')->with('success','customer deleted succesfully');
    }
    public function searchTerm(Request $request, $term)
    {

        $customers = Customer::where('first_name', 'like', "%{$term}%")
            ->orWhere('last_name', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%")
            ->orWhere('phone', 'like', "%{$term}%")
            ->get();

        return response()->json($customers);
    }
    public function search(Request $request){
        $term =$request->input('term');
        $customers =Customer::where('first_name' ,'like' ,"%{$term}%")
        ->orWhere('last_name' ,'like',"%{$term}%")
        ->orWhere('email' ,'like',"{$term}")
        ->orWhere('phone','like' ,"{$term}")
        ->paginate(10);
        
        return response()->json([
            'customers'=>$customers->items(),
            'pagination' => [
                'total' => $customers->total(),
                'per_page' => $customers->perPage(),
                'current_page' => $customers->currentPage(),
                'last_page' => $customers->lastPage(),
                'from' => $customers->firstItem(),
                'to' => $customers->lastItem(),
                'links' => $customers->linkCollection()->toArray()
            ]

        ]);
    }

  
}

