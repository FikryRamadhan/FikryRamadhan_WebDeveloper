@extends('layouts.template')


@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                    </h4>
                </div>

                <div class="card-body">
                    <form data-action="{{ route('invoices.store') }}" id="form" method="POST">

                        {!! Template::requiredBanner() !!}

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Kode Transaksi {!! Template::required() !!} </label>
                                    <input type="text" name="kode_transaksi" class="form-control" value="{{ App\Models\Invoise::createFormatTransaksi() }}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Nama Perusahaan {!! Template::required() !!} </label>

                                    <select name="id_user" id="perusahaan" class="form-control">
                                        <option value=""></option>
                                        @foreach (App\Models\User::where('role', 'Merchant')->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>

                            <input type="text" name="id_customer" hidden value="{{ auth()->user()->id }}">
                        </div>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover" id="menu-table">
                                <thead>
                                    <tr>
                                        <th> Menu Makanan </th>
                                        <th> Jumlah </th>
                                        <th> Tanggal Pengiriman </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" align="right">
                                            <button type="button" class="btn btn-success btn-sm" id="add-menu-item">
                                                <i class="fas fa-plus mr-2"></i> Tambah Menu
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-check mr-2"></i> Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
            const $form = $('#form');
            const $submitBtn = $form.find(`[type="submit"]`).ladda();

            $form.find(`[name="id_user"]`).select2({
                placeholder: '-- Pilih Perusahaan --',
                allowClear: true
            })
            $form.find(`[name="id_menu[]"]`).select2({
                placeholder: '-- Pilih Menu --',
                allowClear: true
            })

            $form.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = $(this).serialize();
                let url = $(this).data('action');
                $submitBtn.ladda('start')

                ajaxSetup();
                $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                    })
                    .done(response => {
                        $submitBtn.ladda('stop')
                        ajaxSuccessHandling(response)
                        resetForm()
                    })
                    .fail(error => {
                        $submitBtn.ladda('stop')
                        ajaxErrorHandling(error, $form)
                    })
            })

            const resetForm = () => {
                $form[0].reset();
            }

            resetForm();

            const addProductItem = () => {
                let html = $('#menu-template').text()
                $('#menu-table').find('tbody').append(html)
                renderedEvent();
                $('#menu-table').find('.menu').last().val('').trigger(
                    'change')
            }

            const renderedEvent = () => {
                $('.menu').select2({
                    placeholder: '-- Pilih Menu --',
                })

                $('.remove').off('click')
                $('.remove').on('click', function() {
                    $(this).parents('tr').remove()
                    renderedEvent()
                })
            }

            $('#add-menu-item').on('click', function(e) {
                e.preventDefault()
                addProductItem();
            })

            addProductItem();


        })
    </script>

    <script type="text/html" id="menu-template">
        <tr class="menu-item">
            <td>
                <select class="menu" name="id_menu[]" style="width: 100%;" required>
                    @foreach (\App\Models\Menu::all() as $item)
                        <option value="{{ $item->id }}"> {{ $item->nama }} </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah">
                <span class="invalid-feedback"></span>
            </td>

            <td>
                <input type="date" name="tgl_pengiriman[]" class="form-control jumlah">
                <span class="invalid-feedback"></span>
            </td>
            
            <td>
                <button class="btn btn-danger px-2 py-1 remove">
                    <i class="fas fa-times"></i>
                </button>
            </td>
            </tr>
    </script>
@endsection
