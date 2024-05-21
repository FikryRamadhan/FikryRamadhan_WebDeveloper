<?php

namespace App\Http\Controllers;

use App\Models\Invoise;
use App\Http\Requests\StoreInvoiseRequest;
use App\Http\Requests\UpdateInvoiseRequest;
use App\Models\DetailInvoice;
use App\MyClass\Response;
use App\MyClass\Validations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Invoise::DataTableForCustomer();
        }
        return view('invoice.index', [
            'title' => 'Daftar Pesanan',
            'breadcrumbs' => [
                [
                'title' => 'Daftar Pesanan',
                'link' => route('menu.index'),
                ]
            ]
        ]);
    }

    public function indexForMerchant(Request $request)
    {
        if($request->ajax()){
            return Invoise::DataTableForMerchant();
        }
        return view('invoice.forMerchant', [
            'title' => 'Daftar Pesanan',
            'breadcrumbs' => [
                [
                'title' => 'Daftar Pesanan',
                'link' => route('menu.index'),
                ]
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create', [
            'title' => 'Pesan Makanan',
            'breadcrumbs' => [
                [
                'title' => 'Pesan Makanan',
                'link' => route('invoices.create'),
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validations::createInvoice($request);
        DB::beginTransaction();

        try {
            $idMenu = $request->id_menu;

            $invoice = Invoise::createInvoice([
                'kode_transaksi' => $request->kode_transaksi,
                'id_user' => $request->id_user,
                'id_customer' => $request->id_customer
            ]);

            $idInvoice = $invoice->id;
            $jumlah = $request->jumlah;
            $tglPengiriman = $request->tgl_pengiriman;

            for ($i = 0; $i < count($idMenu); $i++) {
                $dataInvoiceDetail = [
                    'idInvoice' => $idInvoice,
                    'idMenu' => $idMenu[$i],
                    'jumlah' => $jumlah[$i],
                    'tglPengiriman' => $tglPengiriman[$i],
                ];

                DetailInvoice::createDetail($dataInvoiceDetail);
            }
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }

        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function detail(Invoise $invoice){
        $detail = DetailInvoice::where('id_invoice', $invoice->id)->get();
        return view('invoice.detail', [
            'title' => 'Pesan Makanan',
            'detail' => $detail,
            'invoice' => $invoice,
            'breadcrumbs' => [
                [
                'title' => 'Pesan Makanan',
                'link' => route('invoices.create'),
                ]
            ]
        ]);
    }
}