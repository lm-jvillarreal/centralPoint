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
                            <h1>Periodos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administracon de Periodos</a></li>
                                <li class="breadcrumb-item active">Periodos</li>
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
                                    <h3 class="card-title">Catalogo de Periodos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <!-- class="text-center" -->
                                            <tr>
                                                <th width='2%'>#</th>
                                                <th width='4%'>Periodo</th>
                                                <th width="4%">Fecha incial del periodo</th>
                                                <th width="4%">Fecha final del periodo</th>
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
										<div class="col-md-8">
											<div class="form-group" id="periodo">
												<label for="periodo" class="form-label">*Periodo:</label>
												<input type="hidden" name="id" id="id">
												<input type="text" name="txt_periodo" id="txt_periodo" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div  class="form-group" id="fecha_inicio">
											  <label for="fecha_inicio" class="form-label">*Fecha inicial del periodo:</label>
											  <input type="date" name="txt_fecha_inicio"  id="txt_fecha_inicio" class="form-control">
											  <div class="invalid-feedback"></div>
											</div>
										</div>
										<!-- <h1>>_<</h1> -->
										<div class="col-md-4">
											<div class="form-group" id="fecha_fin">
												<label for="fecha_fin" class="form-label">*Fecha final del periodo:</label>
												<input type="date" name="txt_fecha_fin"  id="txt_fecha_fin" class="form-control" >


						
												<div class="invalid-feedback"></div>
											</div>
										</div>
                                        

                                    <!-- <script>
                                        function ValidarFechas() {
                                            var txt_fecha_inicio = document.getElementById("txt_fecha_inicio").value;
                                            var txt_fecha_fin = document.getElementById("txt_fecha_fin").value;

                                            if (Date.parse(txt_fecha_fin) < Date.parse(txt_fecha_inicio)) {
                                                alert("La fecha final debe ser mayor a la fecha inicial");
                                                return false; 
                                            }
                                            return true;
                                        }
                                    </script> -->

									</div>
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button"   class="btn btn-secondary" id="btnGuardar">Guardar informacion</button>

                                <!-- donde tienes la funcionalidad del boton guardar ?? -->
							</div>
						</div>
                        <!-- /.modal-content --
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
            var tabla = $("#example1").DataTable({
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
                            lanzarModal("nuevo", null, null, null);
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
                                title: 'ListaPeriodos',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fa fa-file-pdf"></i> PDF',
                                className: 'btn btn-default',
                                title: 'ListaPeriodos',
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
                    url: "mCDIPeriodo1/listar",
                    dataSrc: "",
                    data: "",
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "periodo"
                    },
                    {
                        "data": "fecha_inicio"
                    },
                    {
                        "data": "fecha_fin"
                    }
                ]
            });
        }
        $(document).ready(function() {
            var table = $('#example1').DataTable();

            $('#example1 tbody').on('click', ' tr td:nth-child(1)', function() {
                var rowIdx = table.row(this).index();
                var id = table.cell(rowIdx, 0).data();
                var periodo = table.cell(rowIdx, 1).data();
                var fecha_inicio = table.cell(rowIdx, 2).data();
                var fecha_fin = table.cell(rowIdx, 3).data();
                lanzarModal("editar", id, periodo, fecha_inicio, fecha_fin);
            });
        });
        //aqiiiiiiiiiiiiiiiiiii
        function ValidarFechas() {
            var txt_fecha_inicio = document.getElementById("txt_fecha_inicio").value;
            var txt_fecha_fin = document.getElementById("txt_fecha_fin").value;

            if (Date.parse(txt_fecha_fin) < Date.parse(txt_fecha_inicio)) {
                Swal.fire(
                                    'Error',
                                    'La fecha final no pude anterior a la fecha inicial',
                                    'error'
                                )
                 return false; 
            }
               return true;
        }

        // Para validar ña funcion dentro del boton guardar


        // es todo esto tttootot
        $("#btnGuardar").click(function() {
            if (!ValidarFechas()) {
        return; // Si la validación falla, detenemos la ejecución del evento de clic del botón.
    }
else{
            removerClass("#frmNuevo");
            $("#periodo > div").html("");
			$("#periodo > input").removeClass("is-invalid");
			$("#fecha_inicio > div").html("");
			$("#fecha_inicio > input").removeClass("is-invalid");
			$("#fecha_fin > div").html("");
			$("#fecha_fin input").removeClass("is-invalid");
            $("#fechahora > div").html("");
			$("#fechahora input").removeClass("is-invalid");
            $("#activo > div").html("");
			$("#activo input").removeClass("is-invalid");
            $("#usuario > div").html("");
			$("#usuario input").removeClass("is-invalid");


            $.ajax({
                url: "mCDIPeriodo1/insertar",
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
        }
        });
        // function lanzarModal(origen, id) {
		// 	if (origen == 'nuevo') {
		// 		$("#btnEliminar").css('display', 'none');
		// 		$("#id").val("");
		// 		$("#txt_periodo").val("");
		// 		$("#txt_periodo").val("");
		// 		$("#txt_fecha_inicio").val("");
        //         $("#txt_fecha_fin").val("");
        //         $("#txt_fechahora").val("");
        //         $("#txt_activo").val("");
		// 		$("#txt_usuario").val("");
		// 		$("#modalNuevo").modal("show");
		// 		$("#titulo").html("Catálogo de Periodos | Nuevo Registro");
		// 	} else if (origen == 'editar') {
		// 		$.ajax({
		// 			url: "mCDIPeriodo1/campos",
		// 			type: "POST",
		// 			data: {
		// 				id: id
		// 			},
		// 			success: function(response) {
		// 				var resp = JSON.parse(response);
		// 				$("#btnEliminar").removeAttr('style');
		// 				$("#id").val(resp.id);
		// 				$("#txt_periodo").val(resp.periodo);
		// 				$("#txt_fecha_inicio").val(resp.fecha_inicio);
		// 				$("#txt_fecha_fin").val(resp.fecah_fin);
        //                 $("#txt_fechahora").val(resp.fechahora);
        //                 $("#txt_activo").val(resp.activo);
        //                 $("#txt_usuario").val(resp.usuario);
		// 				$("#titulo").html("Administración de Periodos | Editar Registro");
		// 				$("#modalNuevo").modal("show");
		// 			}
		// 		})
		// 	}
		// }

        function lanzarModal(origen, id, periodo, fecha_inicio, fecha_fin) {
            if (origen == 'nuevo') {
                $("#btnEliminar").css('display', 'none');
                limpiar('#frmNuevo');
                $("#modalNuevo").modal("show");
                $("#titulo").html("Catalogo de Periodos | Nuevo Registro");
            } else if (origen == 'editar') {
                $("#btnEliminar").removeAttr('style');
                $("#id").val(id);
                $("#txt_periodo").val(periodo);
                $("#txt_fecha_inicio").val(fecha_inicio);
                $("#txt_fecha_fin").val(fecha_fin);
                $("#modalNuevo").modal("show");
                $("#titulo").html("Catalogo de Periodos | Editar Registro");
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
                        url: "mCDIPeriodo1/eliminar",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var resp = JSON.parse(response);
                            $("#modalNuevo").modal("toggle");
                            $('#example1').DataTable().ajax.reload();
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