@extends('layouts.template')


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
				
				<form id="form" data-action="{{ route('setting.save_profile',auth()->user()->id) }}">
                    @method('PUT')
					{!! Template::requiredBanner() !!}

					{{-- <div class="text-center my-2">
						<img src="{{ url('img/default_avatar.png') }}" id="change-avatar">
					</div> --}}

					<input type="file" name="upload_avatar" style="display: none;" accept="image/*">

					<div class="form-group">
						<label> Nama Perusahaan {!! Template::required() !!} </label>
						<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Perusahaan" value="{{ auth()->user()->nama }}">
						<span class="invalid-feedback"></span>
					</div>

					<div class="form-group">
						<label> Alamat {!! Template::required() !!} </label>
						<p class="small text-muted">
							* Digunakan untuk login
						</p>
						<input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ auth()->user()->alamat }}">
						<span class="invalid-feedback"></span>
					</div>

					<div class="form-group">
						<label> Email {!! Template::required() !!} </label>
						<p class="small text-muted">
							* Digunakan untuk menerima laporan
						</p>
						<input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ auth()->user()->email }}">
						<span class="invalid-feedback"></span>
					</div>

					<div class="form-group">
						<label> Deskripsi </label>
						<textarea type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi" >{{ auth()->user()->deskripsi ?? '' }}</textarea>
						<span class="invalid-feedback"></span>
					</div>

					<hr>

					<div class="form-group">
						<button class="btn btn-danger" type="submit">
							<i class="fa fa-save mr-1"></i> Simpan
						</button>
					</div>

				</form>

			</div>
		</div>
	</div>

</div>
@endsection


@section('scripts')
<script>
	
	$(function(){

		const $modal = $('#modal');
		const $form = $('#form');
		const $formSubmitBtn = $form.find(`[type="submit"]`).ladda();

		$form.find(`[name="name"]`).focus();

		$form.on('submit', function(e){
			e.preventDefault();
			clearInvalid();

			let formData = $(this).serialize();
            let url = $(this).data('action');
			$formSubmitBtn.ladda('start');

			ajaxSetup();
			$.ajax({
				url: url,
				method: 'PUT',
				data: formData,
				dataType: 'json',
			})
			.done(response => {
				let { message } = response;
				successNotification('Berhasil', message)
				redirectUrlTo(1000 ,`{{ route('dashboard') }}`)
				formReset();
			})
			.fail(error => {
				$formSubmitBtn.ladda('stop');
				ajaxErrorHandling(error, $form);
			})
		})

	})

</script>
@endsection