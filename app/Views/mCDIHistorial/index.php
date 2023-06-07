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
							<h1>Administración de Alumnos</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Alumnos</li>
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
									<h3 class="card-title">Historial de Alumnos</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="departamentos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th width='5%'>#Ficha</th>
												<th width='5%'>Nombre</th>
												<th width='5%'>ApPaterno</th>
												<th width='5%'>ApMaterno</th>
												<th width='5%'>Domicilio</th>
												<th width='5%'>fechaNac</th>
												<th width='5%'>EdadActual</th>
												<th width='5%'>Tel</th>
												<th width='5%'>Cel</th>
												<th width='5%'>Email</th>
												<th width='5%'>Ocupacion</th>
												<th width='5%'>Empresa</th>
												<th width='5%'>Escuela</th>
												<th width='5%'>Nivel</th>
												<th width='5%'>FechaRegistro</th>
												<th width='5%'>HoraRegistro</th>
												<th width='5%'>Activo</th>
												<th width='5%'>Usuario</th>

												
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
				<div class="modal fade" id="modalNuevo">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="titulo"></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="POST" id="frmNuevo">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="Nombre">
												<label for="Nombre" class="form-label">*Nombre:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_nombre" id="txt_nombre" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="ApPaterno">
												<label for="ApPaterno" class="form-label">*ApPaterno:</label>
												<input type="text" name="txt_ApPaterno" id="txt_ApPaterno" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="ApMaterno">
												<label for="ApMaterno" class="form-label">*ApMaterno:</label>
												<input type="text" name="txt_ApMaterno" id="txt_ApMaterno" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Domicilio">
												<label for="Domicilio" class="form-label">*Domicilio:</label>
												<input type="text" name="txt_domicilio" id="txt_domicilio" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="fechaNac">
												<label for="fechaNac" class="form-label">*Fecha de Nacimiento:</label>
												<input type="text" name="txt_fechaNac" id="txt_fechaNac" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="EdadActual">
												<label for="EdadActual" class="form-label">*Edad Actual:</label>
												<input type="text" name="txt_EdadAcual" id="txt_EdadActual" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Tel">
												<label for="Tel" class="form-label">*Telefono:</label>
												<input type="number" name="txt_Tel" id="txt_Tel" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Cel">
												<label for="domicilio" class="form-label">*Celular:</label>
												<input type="text" name="txt_Cel" id="txt_Cel" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Email">
												<label for="Email" class="form-label">*Email:</label>
												<input type="text" name="txt_Email" id="txt_Email" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Ocupacion">
												<label for="Ocupacion" class="form-label">*Ocupacion:</label>
												<input type="text" name="txt_Ocupacion" id="txt_Ocupacion" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Empresa">
												<label for="Empresa" class="form-label">*Empresa:</label>
												<input type="text" name="txt_Empresa" id="txt_Empresa" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Escuela">
												<label for="Escuela" class="form-label">*Escuela:</label>
												<input type="text" name="txt_Escuela" id="txt_Escuela" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="Nivel">
												<label for="Nivel" class="form-label">*Nivel:</label>
												<input type="text" name="txt_Nivel" id="txt_Nivel" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="fecharegistro">
												<label for="fecharegistro" class="form-label">*Fecha Registro:</label>
												<input type="datatime" name="txt_fecharegistro" id="txt_fecharegistro" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="horaregistro">
												<label for="horaregistro" class="form-label">*Hora Registro:</label>
												<input type="datatime" name="txt_horaregistro" id="txt_horaregistro" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="activo">
												<label for="abreviatura" class="form-label">*Activo:</label>
												<input type="number" name="txt_activo" id="txt_activo" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="usuario">
												<label for="usuario" class="form-label">*Usuario:</label>
												<input type="text" name="txt_usuario" id="txt_usuario" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar Aspirante</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
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
		});
		$('#txt_responsable').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "persona/select",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			$("#Nombre > div").html("");
			$("#Nombre > input").removeClass("is-invalid");
			$("#ApPaterno > div").html("");
			$("#ApPaterno > input").removeClass("is-invalid");
			$("#ApMaterno > div").html("");
			$("#ApMaterno > input").removeClass("is-invalid");
			$("#Domicilio > div").html("");
			$("#Domicilio > input").removeClass("is-invalid");
			$("#fechaNac > div").html("");
			$("#fechaNac > input").removeClass("is-invalid");
			$("#EdadActual > div").html("");
			$("#EdadActual > input").removeClass("is-invalid");
			$("#Tel > div").html("");
			$("#Tel > input").removeClass("is-invalid");
			$("#Cel > div").html("");
			$("#Cel > input").removeClass("is-invalid");
			$("#Email > div").html("");
			$("#Email > input").removeClass("is-invalid");
			$("#Ocupacion > div").html("");
			$("#Ocupacion > input").removeClass("is-invalid");
			$("#Empresa > div").html("");
			$("#Empresa > input").removeClass("is-invalid");
			$("#Escuela > div").html("");
			$("#Escuela > input").removeClass("is-invalid");
			$("#Nivel > div").html("");
			$("#Nivel > input").removeClass("is-invalid");
			$("#fecharegistro > div").html("");
			$("#fecharegistro > select").removeClass("is-invalid");
			$("#horaregistro > div").html("");
			$("#horaregistro > select").removeClass("is-invalid");
			$("#activo > div").html("");
			$("#activo > select").removeClass("is-invalid");
			$("#usuario > div").html("");
			$("#usuario > select").removeClass("is-invalid");
		})

		function Tabla() {
			var tabla = $("#departamentos").DataTable({
				"language": {
					"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
				},
				"lengthChange": false,
				"autoWidth": false,
				"dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
				buttons: [{
						text: '<i class="fa fa-plus-square"></i> Nuevo',
						className: 'red',
						action: function() {
							lanzarModal("nuevo", null, null, null, null);
						},
						counter: 1
					},
					{
						extend: 'collection',
						text: '<i class="fa fa-file-export"></i> Exportar',
						className: "btnArrow",
						buttons: [{
								extend: 'excel',
								text: '<i class="fa fa-file-excel"></i> Excel',
								className: 'btn btn-default',
								title: 'CategoriasModulos',
								exportOptions: {
									columns: ':visible'
								}
							},
							{
								extend: 'pdf',
								text: '<i class="fa fa-file-pdf"></i> PDF',
								className: 'btn btn-default',
								title: 'CategoriasModulos',
								exportOptions: {
									columns: ':visible'
								}
							},
						],
					},
					{
						extend: 'copy',
						text: '<i class="fa fa-copy"></i> Copiar registros',
						className: 'btn btn-primary',
						copyTitle: 'Ajouté au presse-papiers',
						copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
						copySuccess: {
							_: '%d lignes copiées',
							1: '1 ligne copiée'
						}
					},
				],
				"ajax": {
					type: "POST",
					url: "departamento/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "Nombre"
					},
					{
						"data": "ApPaterno"
					},
					{
						"data": "ApMaterno"
					},
					{
						"data": "Domicilio"
					},
					{
						"data": "fechaNac"
					},
					{
						"data": "EdadActual"
					},
					{
						"data": "Tel"
					},
					{
						"data": "Cel"
					},
					{
						"data": "Email"
					},
					{
						"data": "Ocupacion"
					},
					{
						"data": "Empresa"
					},
					{
						"data": "Escuela"
					},
					{
						"data": "Nivel"
					},
					{
						"data": "fecharegistro"
					},
					{
						"data": "horaregistro"
					},
					{
						"data": "activo"
					},
					{
						"data": "usuario"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#Historial-Alumnos').DataTable();
			$('#departamentos tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			$("#Nombre > div").html("");
			$("#Nombre > input").removeClass("is-invalid");
			$("#ApPaterno > div").html("");
			$("#ApPaterno > input").removeClass("is-invalid");
			$("#ApMaterno > div").html("");
			$("#ApMaterno > input").removeClass("is-invalid");
			$("#Domicilio > div").html("");
			$("#Domicilio > input").removeClass("is-invalid");
			$("#fechaNac > div").html("");
			$("#fechaNac > input").removeClass("is-invalid");
			$("#EdadActual > div").html("");
			$("#EdadActual > input").removeClass("is-invalid");
			$("#Tel > div").html("");
			$("#Tel > input").removeClass("is-invalid");
			$("#Cel > div").html("");
			$("#Cel > input").removeClass("is-invalid");
			$("#Email > div").html("");
			$("#Email > input").removeClass("is-invalid");
			$("#Ocupacion > div").html("");
			$("#Ocupacion > input").removeClass("is-invalid");
			$("#Empresa > div").html("");
			$("#Empresa > input").removeClass("is-invalid");
			$("#Escuela > div").html("");
			$("#Escuela > input").removeClass("is-invalid");
			$("#Nivel > div").html("");
			$("#Nivel > input").removeClass("is-invalid");
			$("#fecharegistro > div").html("");
			$("#fecharegistro > select").removeClass("is-invalid");
			$("#horaregistro > div").html("");
			$("#horaregistro > select").removeClass("is-invalid");
			$("#activo > div").html("");
			$("#activo > select").removeClass("is-invalid");
			$("#usuario > div").html("");
			$("#usuario > select").removeClass("is-invalid");
			$.ajax({
				url: "Historial/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#Historial-Alumnos').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.Nombre != "") {
							$("#Nombre > div").html(resp.nombre);
							$("#Nombre > input").addClass("is-invalid");
						}
						if (resp.ApPaterno != "") {
							$("#ApPaterno > div").html(resp.ApPaterno);
							$("#ApPaterno > input").addClass("is-invalid");
						}
						if (resp.ApMaterno != "") {
							$("#ApMaterno > div").html(resp.ApMaterno);
							$("#ApMaterno > input").addClass("is-invalid");
						}
						if (resp.Domicilio != "") {
							$("#Domicilio > div").html(resp.Domicilio);
							$("#Domicilio > input").addClass("is-invalid");
						}
						if (resp.fechaNac != "") {
							$("#fechaNac > div").html(resp.fechaNac);
							$("#fechaNac > input").addClass("is-invalid");
						}
						if (resp.EdadActual != "") {
							$("#EdadActual > div").html(resp.EdadActual);
							$("#EdadActual > input").addClass("is-invalid");
						}
						if (resp.Tel != "") {
							$("#Tel > div").html(resp.Tel);
							$("#Tel > input").addClass("is-invalid");
						}
						if (resp.Cel != "") {
							$("#Cel > div").html(resp.cel);
							$("#Cel > input").addClass("is-invalid");
						}
						if (resp.Email != "") {
							$("#Email > div").html(resp.Email);
							$("#Email > input").addClass("is-invalid");
						}
						if (resp.Ccupacion != "") {
							$("#Ocupacion > div").html(resp.Ocupacion);
							$("#Ocupacion > input").addClass("is-invalid");
						}
						if (resp.Empresa != "") {
							$("#Empresa > div").html(resp.Empresa);
							$("#Empresa > input").addClass("is-invalid");
						}
						if (resp.Escuela != "") {
							$("#Escuela > div").html(resp.Escuela);
							$("#Escuela > input").addClass("is-invalid");
						}
						if (resp.Nivel != "") {
							$("#Nivel > div").html(resp.Nivel);
							$("#Nivel > input").addClass("is-invalid");
						}
						if (resp.fecharegistro != "") {
							$("#fecharegistro > div").html(resp.fecharegistro);
							$("#fecharegistro > select").addClass("is-invalid");
						}
						if (resp.horaregistro != "") {
							$("#horaregistro > div").html(resp.horaregistro);
							$("#horaregistro > select").addClass("is-invalid");
						}
						if (resp.activo != "") {
							$("#activo > div").html(resp.activo);
							$("#activo > select").addClass("is-invalid");
						}
						if (resp.usuario != "") {
							$("#usuario > div").html(resp.usuario);
							$("#usuario > select").addClass("is-invalid");
						}
					},
					401: function(xhr) {

					}
				}
			})
		});

		function lanzarModal(origen, id) {
			if (origen == 'nuevo') {
				$("#btnEliminar").css('display', 'none');
				$("#id").val("");
				$("#txt_Nombre").val("");
				$("#txt_ApPaterno").val("");
				$("#txt_ApMaterno").val("");
				$("#txt_Domicilio").val("");
				$("#txt_fechaNac").val("");
				$("#txt_EdadActual").val("");
				$("#txt_Tel").val("");
				$("#txt_Cel").val("");
				$("#txt_Email").val("");
				$("#txt_Ocupacion").val("");
				$("#txt_Empresa").val("");
				$("#txt_Escuela").val("");
				$("#txt_Nivel").val("");
				$("#txt_fecharegistro").val("");
				$("#txt_horaregistro").val("");
				$("#txt_activo").val("");
				$("#txt_usuario").val("");
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Historial | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "departamento/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_Nombre").val(res.Nombre);
						$("#txt_ApPaterno").val(resp.ApPaterno);
						$("#txt_ApMaterno").val(resp.ApMaterno);
						$("#txt_Domicilio").val(resp.Domicilio);
						$("#txt_fechaNac").val(resp.fechaNac);
						$("#txt_EdadActual").val(resp.EdadActual);
						$("#txt_Tel").val(resp.Tel);
						$("#txt_Cel").val(resp.Cel);
						$("#txt_Email").val(resp.Email);
						$("#txt_Ocupacion").val(resp.Ocupacion);
						$("#txt_Empresa").val(resp.Empresa);
						$("#txt_Escuela").val(resp.Escuela);
						$("#txt_Nivel").val(resp.nivel);
						$("#txt_fecharegistro").val(resp.fecharegistro);
						$("#txt_horaregistro").val(resp.horaregistro);
						$("#txt_activo").val(resp.activo);
						$("#txt_usuario").val(resp.usuario);
						$("#titulo").html("Administración de departamentos | Editar Registro");
						$("#modalNuevo").modal("show");
					}
				})
			}
		}
		$("#btnEliminar").click(function() {
			var id = $("#id").val();
			Swal.fire({
				title: '¿Estás seguro?',
				text: "La eliminación de un registro es irreversible",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Confirmar eliminación'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "departamento/eliminar",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#sedes').DataTable().ajax.reload();
							if (resp.msg == "eliminado") {
								Swal.fire(
									'Eliminado',
									'El registro ha sido eliminado',
									'success'
								)
							}
						}
					})
				}
			})
		})
	</script>
</body>

</html>