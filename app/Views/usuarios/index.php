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
							<h1>Catálogo de usuarios</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Usuarios</li>
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
									<h3 class="card-title">Catálogo de usuarios</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="usuarios" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='10%'>#</th>
												<th>Colaborador</th>
												<th width='10%'>Usuario</th>
												<th width='15%'>Perfil</th>
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
										<div class="col-md-6">
											<div class="form-group" id="colaborador">
												<label for="txt_colaborador" class="form-label">*Colaborador:</label>
												<input type="hidden" name="id" id="id">
												<select name="txt_colaborador" id="txt_colaborador" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="perfil">
												<label for="txt_perfil" class="form-label">*Perfil:</label>
												<select name="txt_perfil" id="txt_perfil" class="form-control">
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
								<button type="button" id="btnReset" class="btn btn-danger ml-auto" style="display:none;">Restaurar contraseña</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar usuario</button>
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
		$('#txt_colaborador').select2({
			theme: 'bootstrap4',
			width: '100%',
			placeholder: 'Seleccione una opcion',
			language: 'es',
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
		$('#txt_perfil').select2({
			theme: 'bootstrap4',
			width: '100%',
			placeholder: 'Seleccione una opcion',
			language: 'es',
			ajax: {
				url: "usuariosPerfil/select",
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
			$("#colaborador > div").html("");
			$("#colaborador > select").removeClass("is-invalid");
			$("#perfil > div").html("");
			$("#perfil > select").removeClass("is-invalid");
		})

		function Tabla() {
			var tabla = $("#usuarios").DataTable({
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
					url: "usuario/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"data": "id"
					},
					{
						"data": "colaborador"
					},
					{
						"data": "usuario"
					},
					{
						"data": "perfil"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#usuarios').DataTable();

			$('#usuarios tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			$("#colaborador > div").html("");
			$("#colaborador > select").removeClass("is-invalid");
			$("#perfil > div").html("");
			$("#perfil > select").removeClass("is-invalid");
			$.ajax({
				url: "usuario/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#usuarios').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.colaborador != "") {
							$("#colaborador > div").html(resp.colaborador);
							$("#colaborador > select").addClass("is-invalid");
						}
						if (resp.perfil != "") {
							$("#perfil > div").html(resp.perfil);
							$("#perfil > select").addClass("is-invalid");
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
				$("#btnReset").css('display', 'none');
				$("#id").val("");
				$('#txt_colaborador').val('').trigger('change.select2');
				$('#txt_perfil').val('').trigger('change.select2');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de usuarios | Nuevo Registro");
			} else if (origen == 'editar') {
				$("#btnEliminar").removeAttr('style');
				$("#btnReset").removeAttr('style');
				$("#id").val(id);
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de usuarios | Editar Registro");
				$.ajax({
					url: "usuario/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#txt_colaborador").select2("trigger", "select", {
							data: {
								id: resp.id_colaborador,
								text: resp.nombre_colaborador
							}
						});
						$("#txt_perfil").select2("trigger", "select", {
							data: {
								id: resp.id_perfil,
								text: resp.nombre_perfil
							}
						});
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
						url: "sede/eliminar",
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
		$("#btnReset").click(function() {
			var id = $("#id").val();
			Swal.fire({
				title: '¿Estás seguro?',
				text: "Estás a punto de restaurar la contraseña de usuario",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Confirmar restauración'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "persona/passRes",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#sedes').DataTable().ajax.reload();
							if (resp.msg == "restaurado") {
								Swal.fire(
									'Actualizado',
									'la contraseña del usuario ha sido restaurada',
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