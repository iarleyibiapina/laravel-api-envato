<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Filters\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\{CustomerResource, CustomerCollection};

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // inlude invoices
        $includeInvoices = $request->query('includeInvoices');

        // filter
        $filter = new CustomerFilter();
        // array of array is for simultaneous and advanced querys
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // include the invoices
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices === "true") {
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        // old format
        // return $customer;
        // with new format modified by CustomerResource kk
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
