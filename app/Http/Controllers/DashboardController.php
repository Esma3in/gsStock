<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $name = $user->name;
        $pic = $user->avatar;
        return view('dashboard', compact('name', 'pic'));
    }
        
    public function  orders()
    {
        return view('order.index');
    }
    public function ordersByCustomers()
    {

      $customers= Customer::all();
        return view('order.bycustomers', compact('customers'));
    }

    public function getOrdersByCustomer(Request $request ,$searchedElement)
{
    // Fetch customers with orders, applying search filter
    $customers = Customer::with('orders')
        ->when($searchedElement, function ($query, $searchedElement) {
            return $query->where('first_name', 'LIKE', "%{$searchedElement}%")
                         ->orWhere('last_name', 'LIKE', "%{$searchedElement}%");
        });
    return view('order.bycustomers', compact('customers', 'search'));
}

public function productsBySupplier(){
    $suppliers = Supplier::all();
    return view('products.by-supplier', compact('suppliers'));
}
public function getProductsBySupplier(Supplier $supplier){
    $products = Product::with(['stocks','category'])
    ->where('supplier_id', $supplier->id)
    ->get();
    return view('products._products_by_supplier' , compact('products'))->render();
}

// methode porducts by store
    public function productsByStore(){
        $stores= Store::all();
        return view('products.by-store' , compact('stores'));
    }

    public function getProductsByStore(Store $store){
        $products =Product::with(['category' ,'stocks'])->whereHas('stocks' , function ($query) use ($store){
            $query->where('store_id' , $store->id);
        }) ->get();
        return Response()->json($products);
    }
    // cookies
    public function saveCookie(){
        $name =request()->input('txtCookie');
        Cookie::queue('Username' ,$name ,959);
        return redirect()->back();
    }
    public function saveSession(){
        $name = request()->input('txtSession');
        request()->session()->put('SessionName' ,$name);
        return redirect()->back();
    }



    public function saveAvatar(Request $request)
    {
        $request->validate([
            'avatarFile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $extension = $request->file('avatarFile')->getClientOriginalExtension();
        $fileName = Str::random(30) . time() . '.' . $extension;
    
        $request->file('avatarFile')->move(public_path('storage/avatars'), $fileName);
    
        $user = User::find(1);
        $user->avatar = $fileName;
        $user->save();
    
        $name = $user->name;
        $pic = $fileName;
        
        return view('dashboard', compact('name', 'pic'));
    }
    
    }
