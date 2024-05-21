<?php

namespace App\Http\Controllers;

use App\Models\DetailInvoice;
use App\Http\Requests\StoreDetailInvoiceRequest;
use App\Http\Requests\UpdateDetailInvoiceRequest;

class DetailInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailInvoice  $detailInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(DetailInvoice $detailInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailInvoice  $detailInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailInvoice $detailInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailInvoiceRequest  $request
     * @param  \App\Models\DetailInvoice  $detailInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailInvoiceRequest $request, DetailInvoice $detailInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailInvoice  $detailInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailInvoice $detailInvoice)
    {
        //
    }
}
