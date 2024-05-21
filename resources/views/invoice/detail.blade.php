@extends('layouts.template')


@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="d-inline-block">
                        {{ $title ?? 'Judul' }}
                    </span>
                </h4>
            </div>

            <div class="card-body">
                <table class="table" style="width: 100%;">
                    <tr>
                        <td style="border-bottom: none;" width="45%">Kode Transaksi</td>
                        <td style="border-bottom: none;" width="2%">:</td>
                        <td style="border-bottom: none;">{{ $invoice->kode_transaksi }}</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;" width="45%">Perusahaan</td>
                        <td style="border-bottom: none;" width="2%">:</td>
                        <td style="border-bottom: none;">{{ $invoice->getUserName() }}</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;" width="45%">Customer</td>
                        <td style="border-bottom: none;" width="2%">:</td>
                        <td style="border-bottom: none;">{{ $invoice->getUserNameCustomer() }}</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;" width="45%">Alamat Customer</td>
                        <td style="border-bottom: none;" width="2%">:</td>
                        <td style="border-bottom: none;">{{ $invoice->customer->alamat }}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span class="d-inline-block">
                        Daftar Produk
                    </span>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">

                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th width="100">Jumlah</th>
                                <th> Tanggal Pengiriman </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $item->menu->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->tgl_pengiriman }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Menu</th>
                                <th width="100">Jumlah</th>
                                <th> Tanggal Pengiriman </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection