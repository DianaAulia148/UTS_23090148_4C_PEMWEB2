<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch customers, paginate if needed
        $customers = Customer::latest()->paginate(10);

        // Pass customers data to the view
        return view('dashboard.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('dashboard.customer.create');
    }

    public function store(Request $request)
    {
        $this->validateCustomer($request);

        Customer::create($request->only(['name', 'email', 'address']));

        return redirect()->route('dashboard.customer.index')
                         ->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('dashboard.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $this->validateCustomer($request, $customer->id);

        $customer->update($request->only(['name', 'email', 'address']));

        return redirect()->route('dashboard.customer.index')
                         ->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('dashboard.customer.index')
                         ->with('success', 'Customer berhasil dihapus.');
    }

    // Reusable validation logic for both store and update methods
    private function validateCustomer(Request $request, $excludeId = null)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email,' . $excludeId,
            'address' => 'nullable|string',
        ]);
    }
}
