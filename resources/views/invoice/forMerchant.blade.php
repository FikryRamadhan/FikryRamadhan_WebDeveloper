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
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable">
						
						<thead>
							<tr>
								<th> Kode Transaksi </th>
								<th> Nama Perusahaan </th>
								<th> Nama Customer </th>
								<th width="100"> Aksi </th>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th> Kode Transaksi </th>
								<th> Nama Perusahaan </th>
								<th> Nama Customer </th>
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
				url : "{{ route('invoices.get') }}"
			},
			columns : [
				{
					data : "kode_transaksi",
					name : "kode_transaksi",
				},
				{
					data : "id_user",
					name : "id_user",
				},
				{
					data : "id_customer",
					name : "id_customer",
				},
				{
					data : 'action',
					name : 'action',
					orderable : false,
					searchable : false,
				}
			]
		})

		const reloadDT = () => {
			$('#dataTable').DataTable().ajax.reload();
		}
	})

</script>
@endsection