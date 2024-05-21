@if ( auth()->user()->role  == 'Merchant')
	@include('layouts.menu.merchant')
@else
	@include('layouts.menu.customer')
@endif