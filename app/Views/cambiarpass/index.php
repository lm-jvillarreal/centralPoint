<!DOCTYPE html>
<html lang="es">

<head>
	<?= $head; ?>
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?= $header; ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<?= $menuV; ?>
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Cambiar contraseña</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Contraseña</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Cambiar contraseña</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<form action="" method="POST" id="frmNuevo">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group" id="pass">
													<label for="txt_pass" class="form-label">*Contraseña:</label>
													<input type="password" name="txt_pass" id="txt_pass" class="form-control">
													<div class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group" id="pass_verificar">
													<label for="txt_pass_verificar" class="form-label">*Verificar contraseña</label>
													<input type="password" name="txt_pass_verificar" id="txt_pass_verificar" class="form-control">
													<div class="invalid-feedback"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="card-footer text-right">
									<button type="button" class="btn btn-primary" id="btnGuardar">Actualizar contraseña</button>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?= $footer2; ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<?= $footer; ?>
	<!-- Page specific script -->
	<script>
		$("#btnGuardar").click(function() {
			$("#pass > div").html("");
			$("#pass > input").removeClass("is-invalid");
			$("#pass_verificar > div").html("");
			$("#pass_verificar > input").removeClass("is-invalid");
			$.ajax({
				url: "persona/passReset",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					toastr.success('Contraseña actualizada correctamente');
					$("#txt_pass").val("");
					$("#txt_pass_verificar").val("");
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.pass != "") {
							$("#pass > div").html(resp.pass);
							$("#pass > input").addClass("is-invalid");
						}
						if (resp.pass_verificar != "") {
							$("#pass_verificar > div").html(resp.pass_verificar);
							$("#pass_verificar > input").addClass("is-invalid");
						}
					},
					401: function(xhr) {

					}
				}
			})
		})
	</script>
</body>

</html>