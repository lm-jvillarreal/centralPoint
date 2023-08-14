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
							<h1>Lista de Calificar</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Lista de Calificar</a></li>
								<li class="breadcrumb-item active">Lista de Calificar</li>
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
									<h3 class="card-title">Lista de Asistencia</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="Evaluacion" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th >#</th>
												<th >Evaluacion</th>
                                            
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<Br></Br>
									<table id="Alumnos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='80%'>Alumno</th>
												<th width="20%">Calificacion</th>
                                            
											</tr>
										</thead>
										<tbody></tbody>
									</table>
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
				
				<!-- /.modal -->
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
		$(document).ready(function() {
			Tabla();
			Tabla2();
		});
		<?php
    $id = $_GET['id'];
    $detalles = urldecode($_GET['detalles']);

    // Aquí puedes utilizar $id y $detalles para mostrar la información en la página
    echo "<p>ID de Evaluación: $id</p>";
    echo "<p>Detalles: $detalles</p>";
    ?>
		function Tabla() {
			var tabla = $("#Evaluacion").DataTable({
				"language": {
					"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
				},
				"lengthChange": false,
				"autoWidth": false,
				"dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
				
				"ajax": {
					type: "POST",
					url: "mCDICalificars/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "Nombre"
					}
				]
			});
		}

		// Tabla 2 es para las calificar

		// function Tabla2() {
		// 	var tabla = $("#Alumnos").DataTable({
		// 		"language": {
		// 			"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
		// 		},
		// 		"lengthChange": false,
		// 		"autoWidth": false,
		// 		"dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
				
				
		// 		// "ajax": {
		// 		// 	type: "POST",
		// 		// 	url: "departamento/listar",
		// 		// 	dataSrc: "",
		// 		// 	data: "",
		// 		// },
		// 		"columns": [{
		// 				"type": "html-num",
		// 				"data": "id"
		// 			},
		// 			{
		// 				"data": "Evaluacion"
		// 			}
		// 		]
		// 	});
		// }
		
	</script>
</body>

</html>