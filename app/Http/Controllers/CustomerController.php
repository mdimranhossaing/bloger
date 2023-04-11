<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['customers'] = Customer::orderBy('id', 'DESC')->get();
        return view('admin.customer.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|string|max:100',
            'area'      =>  'required|string|max:100',
            'package'   =>  'required|string|max:100',
            'status'   =>  'required|string|max:100',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->withSuccess('Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['customer']   =   Customer::findOrFail($id);
        return view('admin.customer.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      =>  'required|string|max:100',
            'area'      =>  'required|string|max:100',
            'package'   =>  'required|string|max:100',
            'status'   =>  'required|string|max:100',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update($request->all());
        return redirect()->route('customers.index')->withSuccess('Customer Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->withSuccess('Customer Delete successfully!');
    }
}
