<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?= base_url(); ?>/assets/img/favicon.ico">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/dist/css/adminlte.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			[ Nama Aplikasi ]
		</div>
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Login to start your session</p>
				<?= form_open('login/cek_login', ['class' => 'formlogin']) ?>
				<?= csrf_field(); ?>
				<div class="input-group mb-3">
					<input type="text" id="nip" name="nip" class="form-control" placeholder="No. Induk Pegawai/Karyawan">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" id="password" name="password" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6"></div>
					<div class="col-6">
						<div class="icheck-primary">
							<label style="float:right;">
								<a href="javascript:void(0)" class="showPassword" onClick="showPassword()" style="color:inherit;font-weight:500;">Show Password</a>
							</label>
						</div>
					</div>
				</div>
				<hr class="mt-1">
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">SIGN IN</button>
					</div>
				</div>
				</form>
				<?= form_close() ?>
			</div>
		</div>
	</div>
	<?php if (!empty(session()->getFlashdata('sukses'))) {
		echo '<div class="flash_msg" data-successful="' . session()->getFlashdata('sukses') . '"></div>';
	} else if (!empty(session()->getFlashdata('gagal'))) {
		echo '<div class="flash_msg" data-failed="' . session()->getFlashdata('gagal') . '"></div>';
	} else if (!empty(session()->getFlashdata('error'))) {
		echo '<div class="flash_msg" data-goofy="' . session()->getFlashdata('error') . '"></div>';
	}
	?>
	<!-- jQuery -->
	<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url(); ?>/assets/plugins/sweetalert2.all.min.js"></script>
	<script src="<?= base_url(); ?>/assets/script/validation.js"></script>
	<script src="<?= base_url(); ?>/assets/dist/js/adminlte.min.js"></script>
	<script>
		$(document).ready(function() {
			const Toast = Swal.mixin({
				toast: true,
				position: "top",
				showConfirmButton: false,
				timer: 3000,
			});
			$('.formlogin').submit(function(e) {
				e.preventDefault();
				if ($('#nip').val() == "") {
					Toast.fire({
						icon: "warning",
						title: "Silahkan masukkan NIP/NIK Anda",
					});
					$("#nip").focus();
				} else if ($('#password').val() == "") {
					Toast.fire({
						icon: "warning",
						title: "Silahkan masukkan password Anda",
					});
					$("#password").focus();
				} else {
					$.ajax({
						type: "post",
						url: "<?= base_url('login/cek_login'); ?>",
						data: $(this).serialize(),
						dataType: "json",
						success: function(response) {
							if (response.sukses) {
								setTimeout(function() {
									Toast.fire({
										icon: "success",
										title: response.sukses,
									});
								}, 10);
								window.setTimeout(function() {
									window.location.replace("<?= base_url('dashboard'); ?>");
								}, 2000);
							} else {
								Toast.fire({
									icon: "error",
									title: response.gagal,
								});
							}
						}
					});
					return false;
				}
			});
		});

		var allPasswordInp = [];
		(function() {
			$("input[type=password]").each(function(idx, ele) {
				allPasswordInp.push(ele)
			});
		})()

		function showPassword() {
			var passText = $(".showPassword").text();
			var input_type = (passText == "Show Password") ? "text" : "password";
			if (input_type == "text") {
				$(".showPassword").text("Hide Password");
			} else {
				$(".showPassword").text("Show Password");
			}
			$.each(allPasswordInp, function(idx, ele) {
				$(ele).attr("type", input_type);
			})
		}
	</script>
</body>

</html>