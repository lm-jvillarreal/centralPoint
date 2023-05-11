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
							<h1>Administración de colaboradores</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Colaboradores</li>
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
									<h3 class="card-title">Catálogo de colaboradores</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="colaboradores" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th width='10%'># Emp.</th>
												<th>Colaborador</th>
												<th width="10%">Sede</th>
												<th width="20%">Departamento</th>
												<th width='15%'>Puesto</th>
												<th width='10%'>Categoría</th>
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
											<div class="form-group" id="persona">
												<label for="txt_persona" class="form-label">*Persona:</label>
												<input type="hidden" name="id" id="id">
												<select name="txt_persona" id="txt_persona" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="no_empleado">
												<label for="txt_numEmp" class="form-label">*Num. Emp:</label>
												<input type="number" name="txt_numEmp" id="txt_numEmp" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group" id="departamento">
												<label for="txt_departamento" class="form-label">*Departamento:</label>
												<select name="txt_departamento" id="txt_departamento" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="puesto">
												<label for="txt_puesto" class="form-label">*Puesto:</label>
												<select name="txt_puesto" id="txt_puesto" class="form-control">
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
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar colaborador</button>
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
		$('#txt_persona').select2({
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
		$('#txt_puesto').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "puesto/select",
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
			$("#persona > div").html("");
			$("#persona > select").removeClass("is-invalid");
			$("#no_empleado > div").html("");
			$("#no_empleado > input").removeClass("is-invalid");
			$("#departamento > div").html("");
			$("#departamento > select").removeClass("is-invalid");
			$("#puesto > div").html("");
			$("#puesto > select").removeClass("is-invalid");
		})

		function Tabla() {
			var tabla = $("#colaboradores").DataTable({
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
					url: "colaborador/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "num_emp"
					},
					{
						"data": "persona"
					},
					{
						"data": "sede"
					},
					{
						"data": "depto"
					},
					{
						"data": "puesto"
					},
					{
						"data": "tipo_persona"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#colaboradores').DataTable();
			$('#colaboradores tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			$("#persona > div").html("");
			$("#persona > select").removeClass("is-invalid");
			$("#no_empleado > div").html("");
			$("#no_empleado > input").removeClass("is-invalid");
			$("#departamento > div").html("");
			$("#departamento > select").removeClass("is-invalid");
			$("#puesto > div").html("");
			$("#puesto > select").removeClass("is-invalid");
			$.ajax({
				url: "colaborador/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#colaboradores').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.persona != "") {
							$("#persona > div").html(resp.persona);
							$("#persona > select").addClass("is-invalid");
						}
						if (resp.no_empleado != "") {
							$("#no_empleado > div").html(resp.no_empleado);
							$("#no_empleado > input").addClass("is-invalid");
						}
						if (resp.departamento != "") {
							$("#departamento > div").html(resp.departamento);
							$("#departamento > select").addClass("is-invalid");
						}
						if (resp.puesto != "") {
							$("#puesto > div").html(resp.puesto);
							$("#puesto > select").addClass("is-invalid");
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
				$('#txt_persona').val('').trigger('change.select2');
				$("#txt_numEmp").val("");
				$('#txt_departamento').val('').trigger('change.select2');
				$('#txt_puesto').val('').trigger('change.select2');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de colaboradores | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "colaborador/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_persona").select2("trigger", "select", {
							data: {
								id: resp.id_persona,
								text: resp.persona
							}
						});
						$("#txt_numEmp").val(resp.no_empleado);
						$("#txt_departamento").select2("trigger", "select", {
							data: {
								id: resp.id_departamento,
								text: resp.departamento
							}
						});
						$("#txt_puesto").select2("trigger", "select", {
							data: {
								id: resp.id_puesto,
								text: resp.puesto
							}
						});
						$("#titulo").html("Administración de colaboradores | Editar Registro");
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
						url: "colaboradores/eliminar",
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