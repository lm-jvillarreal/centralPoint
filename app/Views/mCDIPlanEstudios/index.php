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
							<h1>Plan de Estudios</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administracion de Plan de Estudios</a></li>
								<li class="breadcrumb-item active">Plan</li>
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
									<h3 class="card-title">Catalogo de Planes de Estudios</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="planestudio" class="table table-bordered table-striped">
										<thead>
											<tr>

                                                <th width="4%">#</th>
												<th width="4%">Clave</th>
                                                <th width="4%">Nombre</th>
										
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
											<div class="form-group" id="clave">
												<label for="clave" class="form-label">*Clave:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_clave" id="txt_clave" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group" id="nombre">
												<label for="nombre" class="form-label">*Nombre:</label>
												<input type="text" name="txt_nombre" id="txt_nombre" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar informacion</button>
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
        })

		function Tabla() {
			var tabla = $("#planestudio").DataTable({
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
								title: 'PlanEstudios',
								exportOptions: {
									columns: ':visible'
								}
							},
							{
								extend: 'pdf',
								text: '<i class="fa fa-file-pdf"></i> PDF',
								className: 'btn btn-default',
								title: 'PlanEstudios',
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
					url: "mCDIPlanEstudio/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "clave"
					},
					{
						"data": "nombre"
					}
				]
			});
		}
		$(document).ready(function() {
			var table = $('#planestudio').DataTable();
			$('#planestudio tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				var clave = table.cell(rowIdx, 1).data();
                var nombre = table.cell(rowIdx, 2).data();
				lanzarModal("editar", id, clave, nombre);
			});
		});
		$("#btnGuardar").click(function() {
			$("#clave > div").html("");
			$("#clave > input").removeClass("is-invalid");
			$("#nombre > div").html("");
			$("#nombre > input").removeClass("is-invalid");
			$("#fechahora > div").html("");
			$("#fechahora > input").removeClass("is-invalid");
            $("#activo > div").html("");
			$("#activo input").removeClass("is-invalid");
            $("#usuario > div").html("");
			$("#usuario input").removeClass("is-invalid");
			$.ajax({
				url: "mCDIPlanEstudio/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#planestudio').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.clave != "") {
							$("#clave > div").html(resp.clave);
							$("#clave > input").addClass("is-invalid");
						}
						if (resp.nombre != "") {
							$("#nombre > div").html(resp.nombre);
							$("#nombre > input").addClass("is-invalid");
						}
					},
					401: function(xhr) {

					}
				}
			})
		});

		function lanzarModal(origen, id, clave, nombre) {
			if (origen == 'nuevo') {
				$("#btnEliminar").css('display', 'none');
				limpiar('#frmNuevo');
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Plan de Estudios | Nuevo Registro");
			}  else if (origen == 'editar') {
                $("#btnEliminar").removeAttr('style');
                $("#id").val(id);
                $("#txt_clave").val(clave);
                $("#txt_nombre").val(nombre);
                $("#modalNuevo").modal("show");
                $("#titulo").html("Catalogo de Planes de Estudio | Editar Registro");
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
						url: "mCDIPlanEstudio/eliminar",
						type: "POST",
						data: {
							id: id
						},
						success: function(response) {
							var resp = JSON.parse(response);
							$("#modalNuevo").modal("toggle");
							$('#planestudio').DataTable().ajax.reload();
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