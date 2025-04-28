<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('stock')->get();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
             'stock_id' => 'required|exists:stocks,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string'
           
        ]);

        Store::create($validated);

        return redirect()->route('stores.index')
            ->with('success', 'Store created successfully.');
    }

    public function show(Store $store)
    {
        $store->load(['stock', 'products']);
        return view('stores.show', compact('store'));
    }

    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string'
            
        ]);

        $store->update($validated);

        return redirect()->route('stores.index')
            ->with('success', 'Store updated successfully.');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index')
            ->with('success', 'Store deleted successfully.');
    }

    public function stock(Store $store)
    {
        $store->load(['stock.products']);
        return view('stores.stock', compact('store'));
    }
}