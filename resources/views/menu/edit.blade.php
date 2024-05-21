@extends('layouts.template')

@section('styles')
    <style>
        .image{
        width: 100%;
        height: 70%;
        }
    </style>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            {{ $title ?? 'Judul' }}
                        </span>
                    </h4>
                </div>

                <div class="card-body">
                    <form data-action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data"id="form" method="POST">
                        @method('PUT')

                        {!! Template::requiredBanner() !!}

                        <div class="form-group">
                            <label> Nama Menu {!! Template::required() !!} </label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Menu" value="{{ $menu->nama }}">
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label> Image {!! Template::required() !!} </label>
                            <input type="file" name="image" class="form-control">
                            <input type="file" hidden name="imageOld" class="form-control" value="{{ $menu->image }}">
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label> Harga {!! Template::required() !!} </label>
                            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga" value="{{ $menu->harga }}">
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label> Deskripsi {!! Template::required() !!} </label>
                            <textarea type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Menu">{{ $menu->deskripsi ?? '' }}</textarea>
                            <span class="invalid-feedback"></span>
                        </div>

                        <hr>

                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-check mr-2"></i> Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="d-inline-block">
                            Image Menu
                        </span>
                    </h4>
                </div>

                <div class="card-body">
                    <img src="{{ url('/storage/photo/',$menu->image) }}" class="image">
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

            $form.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = new FormData(this);
                let url = $(this).data('action');
                $submitBtn.ladda('start')

                ajaxSetup();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
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

        })
    </script>
@endsection
