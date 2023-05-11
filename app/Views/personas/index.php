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
							<h1>Personas</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Personas</li>
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
									<h3 class="card-title">Administración de Personas</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="personas" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th>Nombre</th>
												<th width='10%'>Sede</th>
												<th width='10%'>Tipo</th>
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
											<div class="form-group" id="nombre">
												<label for="txt_nombre" class="form-label">*Nombre:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_nombre" id="txt_nombre" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="ap_paterno">
												<label for="txt_apPaterno" class="form-label">*Ap. Paterno:</label>
												<input type="text" name="txt_apPaterno" id="txt_apPaterno" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="ap_materno">
												<label for="txt_apMaterno" class="form-label">*Ap. Materno</label>
												<input type="text" name="txt_apMaterno" id="txt_apMaterno" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="sede">
												<label for="txt_sede" class="form-label">*Sede</label>
												<select name="txt_sede" id="txt_sede" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="tipo_persona">
												<label for="txt_tipoPersona" class="form-label">*Tipo Persona</label>
												<select name="txt_tipoPersona" id="txt_tipoPersona" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar persona</button>
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

		function removerClass() {
			$("#nombre > div").html("");
			$("#nombre > input").removeClass("is-invalid");
			$("#ap_paterno > div").html("");
			$("#ap_paterno > input").removeClass("is-invalid");
			$("#ap_materno > div").html("");
			$("#ap_materno > input").removeClass("is-invalid");
			$("#sede > div").html("");
			$("#sede > select").removeClass("is-invalid");
			$("#tipo_persona > div").html("");
			$("#tipo_persona > select").removeClass("is-invalid");
		}
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			removerClass();
		});
		$('#txt_sede').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "sede/select",
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
		$('#txt_tipoPersona').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "personasTipo/select",
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

		function Tabla() {
			var tabla = $("#personas").DataTable({
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
							lanzarModal("nuevo", null);
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
								title: 'modulos',
								exportOptions: {
									columns: ':visible'
								}
							},
							{
								extend: 'pdf',
								text: '<i class="fa fa-file-pdf"></i> PDF',
								className: 'btn btn-default',
								title: 'modulos',
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
					url: "persona/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"data": "id"
					},
					{
						"data": "nombre"
					},
					{
						"data": "sede"
					},
					{
						"data": "tipo_persona"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#personas').DataTable();

			$('#personas tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			removerClass();
			$.ajax({
				url: "persona/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#personas').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.nombre != "") {
							$("#nombre > div").html(resp.nombre);
							$("#nombre > input").addClass("is-invalid");
						}
						if (resp.ap_paterno != "") {
							$("#ap_paterno > div").html(resp.ap_paterno);
							$("#ap_paterno > input").addClass("is-invalid");
						}
						if (resp.ap_materno != "") {
							$("#ap_materno > div").html(resp.ap_materno);
							$("#ap_materno > input").addClass("is-invalid");
						}
						if (resp.sede != "") {
							$("#sede > div").html(resp.sede);
							$("#sede > select").addClass("is-invalid");
						}
						if (resp.perfil != "") {
							$("#tipo_persona > div").html(resp.tipo_persona);
							$("#tipo_persona > select").addClass("is-invalid");
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
				$("#txt_nombre").val("");
				$("#txt_apPaterno").val("");
				$("#txt_apMaterno").val("");
				$('#txt_sede').val('').trigger('change.select2');
				$("#txt_tipoPersona").val('').trigger('change.select2');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Administración de personas | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "persona/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_nombre").val(resp.nombre);
						$("#txt_apPaterno").val(resp.ap_paterno);
						$("#txt_apMaterno").val(resp.ap_materno);
						$("#txt_sede").select2("trigger", "select", {
							data: {
								id: resp.id_sede,
								text: resp.nombre_sede
							}
						});
						$("#txt_tipoPersona").select2("trigger", "select", {
							data: {
								id: resp.id_tipoPersona,
								text: resp.tipo_tipoPersona
							}
						});
						$("#titulo").html("Administración de personas | Editar Registro");
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
						url: "persona/eliminar",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#personas').DataTable().ajax.reload();
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