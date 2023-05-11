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
							<h1>Facturas</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Bienes y Patrimonio</a></li>
								<li class="breadcrumb-item active">Facturas</li>
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
									<h3 class="card-title">Administración de facturas</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="facturas" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='5%'>#</th>
												<th>Proveedor</th>
												<th width='15%'>Folio</th>
												<th width='10%'>Subtotal</th>
												<th width='10%'>Impuestos</th>
												<th width='10%'>Total</th>
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
								<form action="" method="POST" id="frmNuevo" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="proveedor">
												<input type="hidden" name="id" id="id">
												<label for="txt_proveedor" class="form-label">*Proveedor:</label>
												<select name="txt_proveedor" id="txt_proveedor" class="form-control"></select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="folio">
												<label for="txt_folio" class="form-label">*Folio:</label>
												<input type="text" name="txt_folio" id="txt_folio" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" id="subtotal">
												<label for="txt_subtotal" class="form-label">*Subtotal:</label>
												<input type="number" name="txt_subtotal" id="txt_subtotal" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="impuestos">
												<label for="txt_impuestos" class="form-label">*Impuestos:</label>
												<input type="number" name="txt_impuestos" id="txt_impuestos" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="total">
												<label for="txt_total" class="form-label">*Total:</label>
												<input type="number" name="txt_total" id="txt_total" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="documento">
												<label for="txt_documento" class="form-label">*Total:</label>
												<input type="file" name="txt_documento" id="txt_documento" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar factura</button>
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
		$('#txt_proveedor').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "proveedor/select",
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
			var tabla = $("#facturas").DataTable({
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
					url: "factura/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "proveedor"
					},
					{
						"data": "folio_documento"
					},
					{
						"data": "subtotal"
					},
					{
						"data": "impuestos"
					},
					{
						"data": "total"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#facturas').DataTable();

			$('#facturas tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			removerClass("#frmNuevo");
			var form = $("#frmNuevo")[0];
			var data = new FormData(form);
			$.ajax({
				url: "factura/insertar",
				type: "POST",
				enctype: "multipart/form-data",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#facturas').DataTable().ajax.reload();
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
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Facturas | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "factura/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_proveedor").select2("trigger", "select", {
							data: {
								id: resp.id_proveedor,
								text: resp.proveedor
							}
						});
						$("#txt_folio").val(resp.folio);
						$("#txt_subtotal").val(resp.subtotal);
						$("#txt_impuestos").val(resp.impuestos);
						$("#txt_total").val(resp.total);
						$("#titulo").html("Catálogo de Facturas | Editar Registro");
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