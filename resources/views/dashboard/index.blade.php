@extends('layouts.template')


@section('content')
<div class="panel-header bg-danger-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
			</div>
		</div>
	</div>
</div>

	@if (auth()->user()->role == 'Merchant')
		@include('dashboard.card.merchant')

		@else

		@include('dashboard.card.customer')
	@endif
@endsection


@section('scripts')
<script>
	$(function(){
		$('#dataTable').DataTable();
	})
</script>
@endsection
