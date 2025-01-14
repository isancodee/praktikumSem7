<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function index(): view
    {
        $customers = Customer::latest()->paginate(10);
        return view('customer.index', compact('customers'));
    }

    public function create(): view
    {
        return view('customer.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'alamat' => 'required'
        ]);


        Customer::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get customer by ID
        $customer = Customer::findOrFail($id);
        //render view with customer
        return view('customer.show', compact('customer'));
    }

    public function edit(string $id): View
    {
        //get customer by ID
        $customer = Customer::findOrFail($id);
        //render view with customer
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'alamat' => 'required'
        ]);
        //get customer by ID
        $customer = Customer::findOrFail($id);

        $customer->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'alamat' => $request->alamat
        ]);

        //redirect to index
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get customer by ID
        $customer = Customer::findOrFail($id);

        $customer->delete();
        //redirect to index
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
