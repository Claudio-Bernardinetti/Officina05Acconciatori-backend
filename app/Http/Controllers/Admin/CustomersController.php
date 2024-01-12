<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function create()
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->category = $request->category;
        $customer->save();

        return response()->json($customer);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function edit(Customer $customer)
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json('Customer deleted successfully');
    }
}