<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public static function createDetail(array $data){
        $idInvoice = $data['idInvoice'];
        $idMenu = $data['idMenu'];
        $amount = $data['jumlah'];
        $tgl = $data['tglPengiriman'];
        
        return self::create([
            'id_invoice' => $idInvoice,
            'id_menu' => $idMenu,
            'jumlah' => $amount,
            'tgl_pengiriman' => $tgl
        ]);
    }

}
