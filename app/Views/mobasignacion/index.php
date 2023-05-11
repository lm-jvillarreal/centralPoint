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
							<h1>Asignación de mobiliario</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Bienes y patrimonio</a></li>
								<li class="breadcrumb-item active">Asignación de mobiliario</li>
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
									<h3 class="card-title">Administración de asignación de mobiliario</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="asignaciones" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='10%'>#</th>
												<th width='25%'>Descripción</th>
												<th width='10%'>Sede</th>
												<th width='10%'>Edificio</th>
												<th width='25%'>Departamento</th>
												<th>Nomenclatura</th>
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
											<div class="form-group" id="inventario">
												<label for="txt_inventario" class="form-label">*Inventario</label>
												<input type="text" name="txt_inventario" id="txt_inventario" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="mobiliario">
												<label for="txt_mobiliario" class="form-label">*Mobiliario</label>
												<select name="txt_mobiliario" id="txt_mobiliario" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="mobcategoria">
												<label for="txt_mobcategoria" class="form-label">*Tipo mobiliario</label>
												<select name="txt_mobcategoria" id="txt_mobcategoria" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group" id="sede">
												<label for="txt_sede" class="form-label">*Sede</label>
												<select name="txt_sede" id="txt_sede" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="edificio">
												<label for="txt_edificio" class="form-label">*Edificio</label>
												<select name="txt_edificio" id="txt_edificio" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="departamento">
												<label for="txt_departamento" class="form-label">*Departamento</label>
												<select name="txt_departamento" id="txt_departamento" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group" id="consecutivo">
												<label for="txt_consevutivo" class="form-label">*Consecutivo</label>
												<input type="text" id="txt_consecutivo" name="txt_consecutivo" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="responsable">
												<label for="txt_responsable" class="form-label">*Responsable</label>
												<select name="txt_responsable" id="txt_responsable" class="form-control">
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
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar categoría</button>
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

		function removerClass(formulario) {
			$(formulario + ' .form-group').each(function(index, obj) {
				var id_group = $(formulario + " .form-group")[index].id;
				var tipo_elemento = $(formulario + " .form-control")[index].tagName.toLowerCase();
				$("#" + id_group + " >  div").html("");
				$("#" + id_group + " > " + tipo_elemento).removeClass("is-invalid");
			});
		}

		function limpiar(formulario) {
			$(formulario + ' .form-group').each(function(index, obj) {
				var id_group = $(formulario + " .form-group")[index].id;
				var tipo_elemento = $(formulario + " .form-control")[index].tagName.toLowerCase();
				$("#" + id_group + " >  div").html("");
				$("#" + id_group + " > " + tipo_elemento).removeClass("is-invalid");
				if (tipo_elemento == "input") {
					$("#" + id_group + " > " + tipo_elemento).val('');
				} else if (tipo_elemento == "select") {
					$("#" + id_group + " > " + tipo_elemento).select2("trigger", "select", {
						data: {
							id: '',
							text: ''
						}
					});
				}
			});
		}
		$('#modalNuevo').on('hidden.bs.modal', function() {
			limpiar('#frmNuevo');
		});
		$('#txt_mobiliario').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "mobiliario/select",
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
		$('#txt_mobcategoria').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "mobiliarioCategoria/select",
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
		$('#txt_edificio').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "edificio/select",
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
		$('#txt_departamento').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "departamento/select",
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
		$('#txt_responsable').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "colaborador/select",
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
			var tabla = $("#asignaciones").DataTable({
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
					url: "mobiliarioAsignacion/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "mobtipo"
					},
					{
						"data": "sede"
					},
					{
						"data": "edificio"
					},
					{
						"data": "departamento"
					},
					{
						"data": "nomenclatura"
					}
				]
			});
		}
		$("#btnGuardar").click(function() {
			removerClass();
			$.ajax({
				url: "mobiliarioAsignacion/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#asignaciones').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						$.each(resp, function(ind, elem) {
							if (elem != "") {
								$("#" + ind + " > div").html(elem);
								$("#" + ind + " > .form-control").addClass("is-invalid");
							}
						});
					},
					401: function(xhr) {

					}
				}
			})
		});

		function lanzarModal(origen, id) {
			if (origen == 'nuevo') {
				$("#btnEliminar").css('display', 'none');
				limpiar('#frmNuevo');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Mobiliario | Nueva Asignación");
			} else if (origen == 'editar') {
				$.ajax({
					url: "mobiliario/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#titulo").html("Mobiliario | Eliminar Registro");
						$("#modalNuevo").modal("show");
					}
				})
			}
		}
	</script>
</body>

</html>