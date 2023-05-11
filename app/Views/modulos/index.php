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
							<h1>Módulos</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Módulos</li>
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
									<h3 class="card-title">Administración de Módulos</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="modulos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th width='10%'>Módulo</th>
												<th width='10%'>Ruta</th>
												<th>Descripción</th>
												<th width='10%'>Categoría</th>
												<th width='10%'>ícono</th>
												<th width='10%'>Tema</th>
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
										<div class="col-md-3">
											<div class="form-group" id="modulo">
												<label for="txt_modulo" class="form-label">*Módulo:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_modulo" id="txt_modulo" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="ruta">
												<label for="txt_ruta" class="form-label">*Ruta:</label>
												<input type="text" name="txt_ruta" id="txt_ruta" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="descripcion">
												<label for="descripcion" class="form-label">*Descripción</label>
												<input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="categoria">
												<label for="txt_categoria" class="form-label">*Categoría:</label>
												<select name="txt_categoria" id="txt_categoria" class="form-control"></select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="icono">
												<label for="txt_icono" class="form-label">*Ícono</label>
												<input type="text" name="txt_icono" id="txt_icono" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="tema">
												<label for="txt_tema" class="form-label">*Tema</label>
												<select name="txt_tema" id="txt_tema" class="form-control">
													<option value=""></option>
													<option value="bg-primary">Primary</option>
													<option value="bg-secondary">Secondary</option>
													<option value="bg-info">Info</option>
													<option value="bg-success">Success</option>
													<option value="bg-warning">Warning</option>
													<option value="bg-danger">Danger</option>
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

		function removerClass() {
			$("#modulo > div").html("");
			$("#modulo > input").removeClass("is-invalid");
			$("#ruta > div").html("");
			$("#ruta > input").removeClass("is-invalid");
			$("#descripcion > div").html("");
			$("#descripcion > input").removeClass("is-invalid");
			$("#categoria > div").html("");
			$("#categoria > select").removeClass("is-invalid");
			$("#icono > div").html("");
			$("#icono > input").removeClass("is-invalid");
			$("#tema > div").html("");
			$("#tema > select").removeClass("is-invalid");
		}
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			removerClass();
		});
		$('#txt_categoria').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "modulosCategoria/select",
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
		$("#txt_tema").select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es'
		});

		function Tabla() {
			var tabla = $("#modulos").DataTable({
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
					url: "modulo/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "nombre"
					},
					{
						"data": "ruta"
					},
					{
						"data": "descripcion"
					},
					{
						"data": "categoria"
					},
					{
						"data": "icono"
					},
					{
						"data": "tema"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#modulos').DataTable();

			$('#modulos tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			removerClass();
			$.ajax({
				url: "modulo/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#modulos').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.modulo != "") {
							$("#modulo > div").html(resp.modulo);
							$("#modulo > input").addClass("is-invalid");
						}
						if (resp.ruta != "") {
							$("#ruta > div").html(resp.ruta);
							$("#ruta > input").addClass("is-invalid");
						}
						if (resp.descripcion != "") {
							$("#descripcion > div").html(resp.descripcion);
							$("#descripcion > input").addClass("is-invalid");
						}
						if (resp.categoria != "") {
							$("#categoria > div").html(resp.categoria);
							$("#categoria > select").addClass("is-invalid");
						}
						if (resp.icono != "") {
							$("#icono > div").html(resp.icono);
							$("#icono > input").addClass("is-invalid");
						}
						if (resp.tema != "") {
							$("#tema > div").html(resp.tema);
							$("#tema > select").addClass("is-invalid");
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
				$("#txt_modulo").val("");
				$("#txt_ruta").val("");
				$("#txt_descripcion").val("");
				$("#txt_categoria").select2("trigger", "select", {
					data: {
						id: '',
						text: ''
					}
				});
				$("#txt_icono").val("");
				$('#txt_tema').val('').trigger('change.select2');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Módulos | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "modulo/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_modulo").val(resp.modulo);
						$("#txt_ruta").val(resp.ruta);
						$("#txt_descripcion").val(resp.descripcion);
						$("#txt_categoria").select2("trigger", "select", {
							data: {
								id: resp.categoria,
								text: resp.nombre_categoria
							}
						});
						$("#txt_icono").val(resp.icono);
						$('#txt_tema').val(resp.tema).trigger('change.select2');
						$("#titulo").html("Catálogo de Módulos | Editar Registro");
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
						url: "modulo/eliminar",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#modulos').DataTable().ajax.reload();
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