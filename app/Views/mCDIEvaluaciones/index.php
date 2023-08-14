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
							<h1>Administración de Evaluaciones</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Evaluaciones</li>
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
									<h3 class="card-title">Catálogo de Evaluaciones</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="departamentos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='6%'>#</th>
												<th width='40%'>Nombre</th>
												<th width='40%'>Tipo Evaluacion</th>
												<th width='14%'></th>
												
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
											<div class="form-group" id="id_grupo">
												<label for="id_grupo" class="form-label">*Grupo:</label>
												<input type="hidden" name="id" id="id">
												<select type="text" name="txt_Grupo" id="txt_Grupo" class="form-control"></select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="nombre">
												<label for="nombre" class="form-label">*Nombre:</label>
												<input type="text" name="txt_Nombre" id="txt_Nombre" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="tipo_evaluacion">
												<label for="tipo_evaluacion" class="form-label">*Tipo Evaluacion:</label>
												<select type="text" name="txt_tipo" id="txt_tipo" class="form-control"></select>
												<div class="invalid-feedback"></div>
											</div>
										</div>
										
									
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar Evaluacion</button>
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
		$('#txt_Grupo').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "mCDIEvaluaciones/select1",
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
        $('#txt_tipo').select2({
			theme: 'bootstrap4',
			width: '100%',
			dropdownParent: $("#modalNuevo"),
			placeholder: 'Seleccione una opcion',
			lenguage: 'es',
			ajax: {
				url: "mCDIEvaluaciones/select2",
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
			$("#Grupo > div").html("");
			$("#Grupo > input").removeClass("is-invalid");
			$("#Nombre > div").html("");
			$("#Nombre > input").removeClass("is-invalid");
			$("#TipoEvaluacion > div").html("");
			$("#TipoEvaluacion > input").removeClass("is-invalid");
			
		})

		function Tabla() {
    var tabla = $("#departamentos").DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        },
        "lengthChange": false,
        "autoWidth": false,
        "dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
        buttons: [
            {
                text: '<i class="fa fa-plus-square"></i> Nuevo',
                className: 'red',
                action: function() {
                    lanzarModal("nuevo", null, null, null, null);
                },
                counter: 1
            },
            // ... (otros botones)
        ],
        "ajax": {
            type: "POST",
            url: "mCDIEvaluaciones/listar",
            dataSrc: "",
            data: "",
        },
        "columns": [
            {
                "type": "html-num",
                "data": "id"
            },
            {
                "data": "nombre"
            },
            {
                "data": "tipo_evaluacion"
            },
            {
				"render": function (data, type, row, meta) {
                    return '<button class="btn btn-sm btn-primary" onclick="redireccionar(' + row.id + ', \'' + row.detalles + '\')">Despliegue de Listado </button>';
                }
            }
        ]
    });
}


function redireccionar(id, detalles) {
    // Aquí pasamos los detalles a la página de redireccionamiento utilizando parámetros GET
    window.location.href = "http://localhost:8080/CDI/centralPoint/public/29?id=" + id + "&detalles=" + encodeURIComponent(detalles);
}


		
		$(document).ready(function() {
			var table = $('#departamentos').DataTable();
			$('#departamentos tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			$("#Grupo > div").html("");
			$("#Grupo > input").removeClass("is-invalid");
			$("#Nombre > div").html("");
			$("#Nombre > input").removeClass("is-invalid");
			$("#TipoEvaluacion > div").html("");
			$("#TipoEvaluacion > input").removeClass("is-invalid");
		
			$.ajax({
				url: "mCDIEvaluaciones/insertar",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					$("#modalNuevo").modal("toggle");
					$('#aspirantes').DataTable().ajax.reload();
					if (resp.msg == "insertado") {
						toastr.success('Registro agregado correctamente');
					} else if (resp.msg == "editado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
						var resp = JSON.parse(xhr.responseText);
						if (resp.Grupo != "") {
							$("#Grupo > div").html(resp.Grupo);
							$("#Grupo > input").addClass("is-invalid");
						}
						if (resp.Nombre != "") {
							$("#Nombre > div").html(resp.Nombre);
							$("#Nombre > input").addClass("is-invalid");
						}
						if (resp.TipoEvaluacion != "") {
							$("#TipoEvaluacion > div").html(resp.TipoEvaluacion);
							$("#TipoEvaluacion > input").addClass("is-invalid");
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
				$("#txt_Grupo").val("");
				$("#txt_Nombre").val("");
				$("#txt_tipo").val("");
				
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Evaluaciones | Nuevo Registro");
				
				
									
			} else if (origen == 'editar') {
				$.ajax({
					url: "mCDIEvaluaciones/campos",
					type: "POST",
					data: {
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_Grupo").val(resp.Grupo);
						$("#txt_Nombre").val(resp.Nombre);
						$("#txt_tipo").val(resp.TipoEvaluacion);
						
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
						url: "mCDIEvaluaciones/eliminar",
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