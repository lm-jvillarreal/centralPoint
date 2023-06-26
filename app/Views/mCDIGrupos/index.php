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
							<h1>Administración de Grupos</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
								<li class="breadcrumb-item active">Grupos</li>
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
									<h3 class="card-title">Catálogo de Grupos</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="departamentos" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th width='10%'>#</th>
												<th width='10%'>Plan</th>
												<th width='10%'>Periodo.</th>
												<th width='10%'>Nivel.</th>
												<th width='10%'>Docente.</th>
												
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
											<div class="form-group" id="id_Plan">
												<label for="id_Plan" class="form-label">*id_Plan:</label>
												<input type="number" name="txt_id_plan" id="txt_id_plan" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="id_periodo">
												<label for="id_periodo" class="form-label">*id_periodo:</label>
												<input type="number" name="txt_id_periodo" id="txt_id_periodo" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" id="nivel">
												<label for="Nivel" class="form-label">*Nivel:</label>
												<input type="number" name="txt_nivel" id="txt_nivel" class="form-control">
												<input type="hidden" name="txt_fechahora" id="txt_fechahora" class="form-control">
												<input type="hidden" name="txt_activo" id="txt_activo" class="form-control">
												<input type="hidden" name="txt_usuario" id="txt_usuario" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="form-group" id="id_docente">
												<label for="id_docente" class="form-label">*#id_docente:</label>
												<input type="number" name="txt_id_docente" id="txt_id_docente" class="form-control">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										
										
									
								</form>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="btnEliminar" class="btn btn-danger ml-auto" style="display:none;">Eliminar</button>
								<button type="button" class="btn btn-secondary" id="btnGuardar">Guardar </button>
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
		
		$('#modalNuevo').on('hidden.bs.modal', function() {
			$(this).find('frmNuevo').trigger('reset');
			$("#id_Plan > div").html("");
			$("#id_Plan > input").removeClass("is-invalid");
			$("#id_periodo > div").html("");
			$("#id_periodo > input").removeClass("is-invalid");
			$("#nivel > div").html("");
			$("#nivel > input").removeClass("is-invalid");
			$("#id_docente > div").html("");
			$("#id_docente > input").removeClass("is-invalid");
			$("#txt_fechahora > div").html("");
			$("#txt_fechahora > input").removeClass("is-invalid");
			$("#txt_activo > div").html("");
			$("#txt_activo > input").removeClass("is-invalid");
			$("#txt_usuario > div").html("");
			$("#txt_usuario > input").removeClass("is-invalid");

			
		})

		function Tabla() {
			var tabla = $("#mCDIGrupos").DataTable({
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
					url: "mCDIGrupos/listar",
					dataSrc: "",
					data: "",
				},
				"columns": [{
						"type": "html-num",
						"data": "id"
					},
					{
						"data": "id_Plan"
					},
					{
						"data": "id_periodo"
					},
					{
						"data": "nivel"
					},
					{
						"data": "id_docente"
					},
				]
			});
		}
		$(document).ready(function() {
			var table = $('#mCDIGrupos').DataTable();
			$('#mCDIGrupos tbody').on('click', ' tr td:nth-child(1)', function() {
				var rowIdx = table.row(this).index();
				var id = table.cell(rowIdx, 0).data();
				lanzarModal("editar", id);
			});
		});
		$("#btnGuardar").click(function() {
			$(this).find('frmNuevo').trigger('reset');
			$("#id_Plan > div").html("");
			$("#id_Plan > input").removeClass("is-invalid");
			$("#id_periodo > div").html("");
			$("#id_periodo > input").removeClass("is-invalid");
			$("#Nivel > div").html("");
			$("#Nivel > input").removeClass("is-invalid");
			$("#id_docente > div").html("");
			$("#id_docente > input").removeClass("is-invalid");
			$("#txt_fechahora > div").html("");
			$("#txt_fechahora > input").removeClass("is-invalid");
			$("#txt_activo > div").html("");
			$("#txt_activo > input").removeClass("is-invalid");
			$("#txt_usuario > div").html("");
			$("#txt_usuario > input").removeClass("is-invalid");
			
			$.ajax({
				url: "grupos/insertar",
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
						if (resp.id_Plan != "") {
							$("#id_Plan > div").html(resp.id_Plan);
							$("#id_Plan > input").addClass("is-invalid");
						}
						if (resp.id_peroido != "") {
							$("#id_peroido > div").html(resp.id_peroido);
							$("#id_peroido > input").addClass("is-invalid");
						}
						if (resp.Nivel != "") {
							$("#Nivel > div").html(resp.Nivel);
							$("#Nivel > select").addClass("is-invalid");
						}
						if (resp.id_docente != "") {
							$("#id_docente > div").html(resp.id_docente);
							$("#id_docente > select").addClass("is-invalid");
						}
						if (resp.txt_fechahora != "") {
							$("#txt_fechahora > div").html(resp.txt_fechahora);
							$("#txt_fechahora > select").addClass("is-invalid");
						}
						if (resp.txt_activo != "") {
							$("#txt_activo > div").html(resp.txt_activo);
							$("#txt_activo > select").addClass("is-invalid");
						}
						if (resp.txt_usuario != "") {
							$("#txt_usuario > div").html(resp.txt_usuario);
							$("#txt_usuario > select").addClass("is-invalid");
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
				$("#txt_id_plan").val("");
				$("#txt_id_periodo").val("");
				$("#txt_Nivel").val("");
				$("#txt_id_docente").val("");
				$("#txt_fechahora").val("");
				$("#txt_activo").val("");
				$("#txt_usuario").val("");
				$("#modalNuevo").modal("show");
				$("#titulo").html("Catálogo de Grupos | Nuevo Registro");
			} else if (origen == 'editar') {
				$.ajax({
					url: "grupos/campos",
					type: "POST",
					data: {
						
						id: id
					},
					success: function(response) {
						var resp = JSON.parse(response);
						$("#btnEliminar").removeAttr('style');
						$("#id").val(resp.id);
						$("#txt_id_plan").val(resp.id_Plan);
						$("#txt_id_periodo").val(resp.id_periodo);
						$("#txt_Nivel").val(resp.Nivel);
						$("#txt_id_docente").val(resp.id_docente);
						$("#txt_fechahora").val(resp.fechahora);
						$("#txt_activo").val(resp.activo);
						$("#txt_usuario").val(resp.usuario);
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
						url: "departamento/eliminar",
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