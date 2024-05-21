<?php

namespace App\Models;

use App\MyClass\MyClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Invoise extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'id_customer');
    }

    public static function createInvoice($request){
        return self::create($request);
    }

    public static function DataTableForCustomer(){
        $data = self::select([ 'invoises.*' ]);

        $data->where('id_customer', auth()->user()->id);

        return DataTables::eloquent($data)
        ->addColumn('action', function ($data) {
            $action = '
                <div class="dropdown">
                    <button class="btn btn-danger px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item delete" href="' . route('invoices.detail', $data->id) . '">
                            <i class="fas fa-search mr-1"></i> Detail
                        </a>
                    </div>
                </div>
            ';
            return $action;
        })
        ->editColumn('id_user', function($data){
            return $data->getUserName();
        })
        ->editColumn('id_customer', function($data){
            return $data->getUserNameCustomer();
        })
        ->rawColumns([ 'action', 'image' ])
        ->make(true);
    }

    public static function DataTableForMerchant(){
        $data = self::select([ 'invoises.*' ]);

        $data->where('id_user', auth()->user()->id);

        return DataTables::eloquent($data)
        ->addColumn('action', function ($data) {
            $action = '
                <div class="dropdown">
                    <button class="btn btn-danger px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item delete" href="' . route('invoices.detail', $data->id) . '">
                            <i class="fas fa-search mr-1"></i> Detail
                        </a>
                    </div>
                </div>
            ';
            return $action;
        })
        ->editColumn('id_user', function($data){
            return $data->getUserName();
        })
        ->editColumn('id_customer', function($data){
            return $data->getUserNameCustomer();
        })
        ->rawColumns([ 'action', 'image' ])
        ->make(true);
    }

    public function getUserName(){
        return $this->user?$this->user->nama: '-';
    }

    public function getUserNameCustomer(){
        return $this->customer?$this->customer->nama: '-';
    }

    public static function createFormatTransaksi($idInvoice = null){
        // Ambil Tahun Saat Ini
        $tahunIni = date('Y');
        
        // Cari Transaksi Di Tahun Ini
        $transaksiTerbaru = self::whereBetween('created_at', [$tahunIni.'-01-01', $tahunIni.'-12-31']);
        if($idInvoice != null) {
            $transaksiTerbaru->whereNotIn('id', [$idInvoice]);
        }
        $transaksiTerbaru->orderBy('created_at', 'DESC')->first();
        $transaksi = $transaksiTerbaru->first();
        
        if($transaksi){
            $noTransaksi = $transaksi->kode_transaksi;
            $explode = explode('/', $noTransaksi);
            $noUrut = (int) $explode[0];
            $noUrut++;
        }else {
            $noUrut = 1;
        }
        $urutan = str_pad($noUrut,4,0,STR_PAD_LEFT);

        $data = [
            'tanggal' => now(),
            'kodeBarang' => 'INVOICE',
            'urutan' => $urutan,
        ];

        return MyClass::formatNoTransaksi($data);
    }
}
