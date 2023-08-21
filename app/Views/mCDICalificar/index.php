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
							<h1>Lista de Calificar</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Lista de Calificar</a></li>
								<li class="breadcrumb-item active">Lista de Calificar</li>
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
									<h3 class="card-title">Lista de Asistencia</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="Evaluacion" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th >#</th>
												<th >Evaluacion</th>
                                            
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<Br></Br>
									
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
							<table id="Alumnos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width="10%">#</th>
												<th width='80%'>Alumno</th>
												<th width="10%">Calificacion</th>
                                            
											</tr>
										</thead>
										<tbody></tbody>
									</table>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
                                <button type="button" class="btn btn-secondary" id="btnGuardar">Guardar Grupo</button>
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
			Tabla2();
		});
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			removerClass();
		});
		
		
		function Tabla() {
			var tabla = $("#Evaluacion").DataTable({
				"language": {
					"url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
				},
				"lengthChange": false,
				"autoWidth": false,
				"dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
				
				"ajax": {
					type: "POST",
					url: "mCDICalificars/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
                "data": "Nombre",
                "render": function(data, type, row) {
                    return '<a href="#" class="detalle-link" data-id="' + row.id + '">' + data + '</a>';
                }
            }
				]
			});
			$('#Evaluacion tbody').on('click', '.detalle-link', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        // Aquí puedes abrir la modal con el contenido correspondiente al ID
        // Puedes usar una librería como Bootstrap Modal para esto
        $('#modalNuevo').modal('show');
    });
		}

		// Tabla 2 es para las calificar

		function Tabla2() {
    var tabla = $("#Alumnos").DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        },
        "lengthChange": false,
        "autoWidth": false,
        "dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "ajax": {
            type: "POST",
            url: "mCDICalificars/listarAlumnos",
            dataSrc: ""
        },
        "columns": [
            {
                "type": "html-num",
                "data": "id"
            },
            {
                "data": "id_alumno"
            },
            {
                "render": function(data, type, row) {
                    // Aquí creas un campo de entrada (input) para ingresar calificaciones
                    return '<input type="number" class="calificacion-input" data-alumno-id="' + row.id_alumno + '">';
                }
            }
        ]
    });

		}
		$("#btnGuardar").click(function() {
            removerClass("#frmNuevo");
            $.ajax({
                url: "mCDICalificars/insertar",
                type: "POST",
                data: $("#frmNuevo").serialize(),
                success: function(response) {
                    var resp = JSON.parse(response);
                    $("#modalNuevo").modal("toggle");
                    $('#example1').DataTable().ajax.reload();
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

		
	</script>
</body>

</html>