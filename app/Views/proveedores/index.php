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
							<h1>Proveedores</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Bienes y Patrimonio</a></li>
								<li class="breadcrumb-item active">Proveedores</li>
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
									<h3 class="card-title">Administración de Proveedores</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="proveedores" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th width='20%'>Nombre</th>
												<th>Razon Social</th>
												<th width='15%'>RFC</th>
												<th width='15%'>Teléfono</th>
												<th width='15%'>Email</th>
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
												<label for="txt_nombre" class="form-label">*Proveedor:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_nombre" id="txt_nombre" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group" id="razon_social">
												<label for="txt_razonsocial" class="form-label">*Razón Social:</label>
												<input type="text" name="txt_razonsocial" id="txt_razonsocial" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="rfc">
												<label for="txt_rfc" class="form-label">*RFC:</label>
												<input type="text" name="txt_rfc" id="txt_rfc" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md 6">
											<div class="form-group" id="direccion">
												<label for="txt_direccion" class="form-label">*Dirección:</label>
												<input type="text" name="txt_direccion" id="txt_direccion" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="telefono">
												<label for="txt_telefono" class="form-label">*Teléfono:</label>
												<input type="text" name="txt_telefono" id="txt_telefono" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="email">
												<label for="txt_email" class="form-label">*Email:</label>
												<input type="text" name="txt_email" id="txt_email" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group" id="categoria_proveedor">
												<label for="txt_categoria" class="form-label">*Categoría</label>
												<select name="txt_categoria" id="txt_categoria" class="form-control">
													<option value=""></option>
												</select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group" id="descripcion_proveedor">
												<label for="txt_descripcion" class="form-label">*Descripción</label>
												<input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control">
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
		function removerClass(formulario) {
			$(formulario + ' .form-group').each(function(index, obj) {
				var id_group = $(formulario + " .form-group")[index].id;
				var tipo_elemento = $(formulario + " .form-control")[index].tagName.toLowerCase();
				$("#" + id_group + " >  div").html("");
				$("#" + id_group + " > " + tipo_elemento).removeClass("is-invalid");
			});
		}
		function limpiar(formulario){
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

		$(document).ready(function() {
			Tabla();
		});
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			limpiar("#frmNuevo");
		});
		$('#txt_categoria').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "proveedoresCategoria/select",
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
			var tabla = $("#proveedores").DataTable({
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
					url: "proveedor/listar",
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
						"data": "razon_social"
					},
					{
						"data": "rfc"
					},
					{
						"data": "telefono"
					},
					{
						"data": "email"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#proveedores').DataTable();

			$('#proveedores tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			removerClass("#frmNuevo");
			$.ajax({
				url: "proveedor/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#proveedores').DataTable().ajax.reload();
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
				$("#id").val("");
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Proveedores | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "proveedor/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_nombre").val(resp.nombre);
						$("#txt_razonsocial").val(resp.razon_social);
						$("#txt_rfc").val(resp.rfc);
						$("#txt_direccion").val(resp.direccion);
						$("#txt_telefono").val(resp.telefono);
						$("#txt_email").val(resp.email);
						$("#txt_categoria").select2("trigger", "select", {
							data: {
								id: resp.id_categoria,
								text: resp.nombre_categoria
							}
						});
						$("#txt_descripcion").val(resp.descripcion_proveedor);
						$("#titulo").html("Catálogo de Proveedores | Editar Registro");
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
						url: "proveedor/eliminar",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#proveedores').DataTable().ajax.reload();
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