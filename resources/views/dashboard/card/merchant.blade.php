<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-lg-6 col-md-12">
			<div class="card card-stats card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="fas fa-utensils text-success"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category"> Total Menu </p>
								<h4 class="card-title"> {{ App\Models\Menu::where('id_user', auth()->user()->id)->count() }} </h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
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