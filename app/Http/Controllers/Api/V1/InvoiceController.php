<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Filters\V1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\{BulkStoreInvoiceRequest, StoreInvoiceRequest, UpdateInvoiceRequest};
use App\Http\Resources\V1\{InvoiceResource, InvoiceCollection};

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // filter
        // dd(new InvoiceCollection(Invoice::paginate()));
        $filter = new InvoiceFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate());
        } else {
            // keeping the filter on url with append
            $invoices = Invoice::where($queryItems)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Store a bulk of customers (multiple customers) 
     * 
     */
    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk = collect($request->all())->map(function ($array, $key) {
            return Arr::except($array, ['customerId', 'billedDated', 'paidDated']);
        });

        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
