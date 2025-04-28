<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

  
    
    public function CustomerOrder()
    {
        $orders = Order::with(['products'])->get();
        return response()->json($orders);
    }

    public function OrderDetails(Order $order){
        return view('order._detail' , compact('order'));
    }
    public function getCustomerOrders(Customer $customer){
        $orders= $customer->orders()->get();
        return response()->json($orders);
    }
    public function getOrderDetails(Order $order){
        return view('order._detail' ,compact('order'));
    }

}