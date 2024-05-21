<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="_token" content="N8bSUAQ1IjUid9QN8QVI4mRxpCBSz6oyXSwNd9RQ">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title> Login | PT.Kathering</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}" />
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

	<script src="{{ url('js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
					"simple-line-icons"
				],
				urls: ['css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('css/atlantis.min.css') }}">
	<link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
	<link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">
	<link rel="stylesheet" href="{{ url('css/custom/select2-atlantis.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/custom/login-added.css') }}" />

    <style type="text/css">
        .container:before {
			background-image: linear-gradient(-45deg,#cd0303 0%,#ac00d7 100%);
		}

        .btn-red {
			background-color: #cd0303;
		}
        .btn-red:hover {
			background-color: #cd0303;
		}

        .image {
            width: 80%;
            margin-right: 80px;
            margin-bottom: 60px;
        }
        .select{
            background-color: transparent;
            border: none;
            border-radius: 55px;
        }
        /* .input-field{
            height: 30px;
        }
        .input-field i{
            height: 30px;
        }
        .input-field input{
            height: 30px;
        } */
    </style>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form class="sign-in-form" id="formDaftar" method="POST">
					@csrf
					<h2 class="title">Sign In</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Masukan Nama Perusahaan Anda" name="nama" required />
					</div>
                    <div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Email" name="email" required />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" required />
					</div>
                    <div class="input-field">
						<i class="fas fa-user"></i>
						<select name="role" id="role" class="select">
                            <option value="" selected>Pilih Role Anda</option>
                            <option value="Customer">Customer</option>
                            <option value="Merchant">Merchant</option>
                        </select>
					</div>

                    <div class="input-field">
						<i class="fas fa-map"></i>
						<input type="text" placeholder="Masukan Alamat Anda" name="alamat" required />
					</div>

					<button type="submit" class="btn btn-red btn-round">
						Daftar
					</button>

					<p class="message-error text-danger"></p>

					<p class="social-text text-center"> 
						Sudah Punya Akun <i class="fas fa-heart text-danger"></i> <br>
						<a href="{{ route('login') }}"> Click Disini </a>
					</p>
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				{{-- <img src="{{ url('Logo/hotel-intan-putih.png') }}" class="image" alt=""> --}}
			</div>
		</div>
	</div>



	<script src="{{ url('js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ url('js/core/popper.min.js') }}"></script>
	<script src="{{ url('js/core/bootstrap.min.js') }}"></script>


	<!-- Bootstrap Notify -->
	<script src="{{ url('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Atlantis JS -->
	{{-- <script src="{{ url('js/atlantis.min.js') }}"></script> --}}

	<script src="{{ url('vendors/ladda/spin.min.js') }}"></script>
	<script src="{{ url('vendors/ladda/ladda.min.js') }}"></script>
	<script src="{{ url('vendors/ladda/ladda.jquery.min.js') }}"></script>
	<script src="{{ url('js/myJs.js') }}"></script>

	<script type="text/javascript">
		$(function() {

			const $formLogin = $('#formDaftar');
			const $formLoginSubmitBtn = $('#formDaftar').find(`[type="submit"]`).ladda();


			$formLogin.on('submit', function(e) {
				e.preventDefault();
				$('.message-error').html('')

				const formData = $(this).serialize();
				$formLoginSubmitBtn.ladda('start')

				ajaxSetup()
				$.ajax({
						url: "{{ route('register.daftar') }}",
						method: 'post',
						data: formData,
						dataType: 'json'
					})
					.done(response => {
						successNotification('Berhasil', 'Daftar Berhasil')
						setTimeout(() => {
							window.location.href = "{{ url('/login') }}"
						}, 1000)
					})
					.fail(error => {
						$formLoginSubmitBtn.ladda('stop');
						errorNotification('Error', error);
						$('.message-error').html('Username/Password Salah')
					})
			})

		})
	</script>

</body>

</html>
