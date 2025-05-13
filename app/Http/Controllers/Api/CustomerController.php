<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    // Menyediakan data customer
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Endpoint untuk menambah customer
    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }
}