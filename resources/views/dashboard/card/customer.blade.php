<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-lg-12 col-md-12">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-cart-1 text-danger"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category"> Total Pesanan</p>
								<h4 class="card-title"> {{ App\Models\Invoise::where('id_user', auth()->user()->id)->count() }} </h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>