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
					<div class="float-right">
						<a class="btn btn-danger btn-sm mr-2" href="{{ route('menu.create') }}">
							<i class="fa fa-plus"></i> Tambah
						</a>
					</div>
				</h4>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable">
						
						<thead>
							<tr>
								<th> Nama </th>
								<th> Image </th>
								<th> Harga </th>
								<th> Deskripsi </th>
								<th> Pemilik </th>
								<th width="100"> Aksi </th>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th> Nama </th>
								<th> Image </th>
								<th> Harga </th>
								<th> Deskripsi </th>
								<th> Pemilik </th>
								<th width="100"> Aksi </th>
							</tr>
						</tfoot>

					</table>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection


@section('scripts')
<script>
	
	$(function(){

		$('#dataTable').DataTable({
			processing : true,
			serverSide : true,
			autoWidth : false,
			ajax : {
				url : "{{ route('menu.index') }}"
			},
			columns : [
				{
					data : "nama",
					name : "nama",
				},
				{
					data : "image",
					name : "image",
				},
				{
					data : "harga",
					name : "harga",
				},
				{
					data : "deskripsi",
					name : "deskripsi",
				},
				{
					data: "id_user",
					name: "id_user"
				},
				{
					data : 'action',
					name : 'action',
					orderable : false,
					searchable : false,
				}
			],
			drawCallback : settings => {
				renderedEvent();
			}
		})

		const reloadDT = () => {
			$('#dataTable').DataTable().ajax.reload();
		}

		const renderedEvent = () => {
			$.each($('.delete'), (i, deleteBtn) => {
				$(deleteBtn).off('click')
				$(deleteBtn).on('click', function(){
					let { deleteMessage, deleteHref } = $(this).data();
					confirmation(deleteMessage, function(){
						ajaxSetup()
						$.ajax({
							url: deleteHref,
							method: 'delete',
							dataType: 'json'
						})
						.done(response => {
							let { message } = response
							successNotification('Berhasil', message)
							reloadDT();
						})
						.fail(error => {
							ajaxErrorHandling(error);
						})
					})
				})
			})
		}
	})

</script>
@endsection