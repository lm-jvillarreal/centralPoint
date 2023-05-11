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
              <h1>Mis datos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
                <li class="breadcrumb-item active">Mis datos</li>
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
                  <h3 class="card-title">Mis datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="" method="POST" id="frmNuevo">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group" id="titulo">
                          <label for="txt_titulo" class="form-label">*Titulo:</label>
                          <select name="txt_titulo" id="txt_titulo" class="form-control">
                            <option value=""></option>
                            <option value="Sr">Señor (Sr.)</option>
                            <option value="Sra">Señora (Sra.)</option>
                            <option value="Lic">Licenciado (Lic.)</option>
                            <option value="Dr">Doctor (Dr.)</option>
                            <option value="Ing">Ingeniero (Ing.)</option>
                            <option value="C">Ciudadano (C.)</option>
                            <option value="Mttro.">Maestro (Mttro.)</option>
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="nombre">
                          <label for="txt_nombre" class="form-label">*Nombre:</label>
                          <input type="text" name="txt_nombre" id="txt_nombre" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" id="ap_paterno">
                          <label for="txt_apPaterno" class="form-label">*Ap. Paterno</label>
                          <input type="text" name="txt_apPaterno" id="txt_apPaterno" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" id="ap_materno">
                          <label for="txt_apMaterno" class="form-label">*Ap. Materno</label>
                          <input type="text" name="txt_apMaterno" id="txt_apMaterno" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="sexo">
                          <label for="txt_sexo">*Sexo:</label>
                          <select name="txt_sexo" id="txt_sexo" class="form-control">
                            <option value=""></option>
                            <option value="H">Masculino</option>
                            <option value="M">Femenino</option>
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group" id="curp">
                          <label for="txt_curp" class="form-label">*CURP:</label>
                          <input type="text" name="txt_curp" id="txt_curp" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="eCivil">
                          <label for="txt_eCivil">*Estado civil:</label>
                          <select name="txt_eCivil" id="txt_eCivil" class="form-control">
                            <option value=""></option>
                            <option value="Soltero(a)">Soltero(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Viudo(a)">Viudo(a)</option>
                            <option value="Divorciado(a)">Divorciado(a)</option>
                            <option value="Unión Libre">Unión Libre</option>
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group" id="departamento">
                          <label for="txt_departamento">*Departamento:</label>
                          <select name="txt_departamento" id="txt_departamento" class="form-control">
                            <option value=""></option>
                          </select>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="numemp">
                          <label for="txt_numEmp">*Num. Empleado</label>
                          <input type="text" name="txt_numEmp" id="txt_numEmp" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="rfc">
                          <label for="txt_rfc">*RFC:</label>
                          <input type="text" name="txt_rfc" id="txt_rfc" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group" id="celular">
                          <label for="txt_celular">*Celular:</label>
                          <input type="text" name="txt_celular" id="txt_celular" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" id="email">
                          <label for="txt_email">*Email institucional:</label>
                          <input type="text" name="txt_email" id="txt_email" class="form-control">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-right">
                  <button type="button" class="btn btn-primary" id="btnGuardar">Actualizar mis datos</button>
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
    $("#txt_titulo").select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: 'Seleccione una opcion',
      language: 'es'
    });
    $("#txt_sexo").select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: 'Seleccione una opcion',
      language: 'es'
    });
    $("#txt_eCivil").select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: 'Seleccione una opcion',
      language: 'es'
    });
    $('#txt_departamento').select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: 'Seleccione una opcion',
      language: 'es',
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
    $(document).ready(function() {
      datos();
    });
    function datos() {
      $.ajax({
        url: "persona/campos",
        type: "POST",
        data: {
          
        },
        success: function(response) {
          var resp = JSON.parse(response);
          $("#txt_titulo").select2("trigger", "select", {
            data: {
              id: resp.titulo
            }
          });
          $("#txt_nombre").val(resp.nombre);
          $("#txt_apPaterno").val(resp.ap_paterno);
          $("#txt_apMaterno").val(resp.ap_materno);
          $("#txt_sexo").select2("trigger", "select", {
            data: {
              id: resp.sexo,
              text: resp.sexo
            }
          });
          $("#txt_curp").val(resp.curp);
          $("#txt_eCivil").select2("trigger", "select", {
            data: {
              id: resp.eCivil,
              text: resp.eCivil
            }
          });
          $("#txt_rfc").val(resp.rfc);
          $("#txt_celular").val(resp.celular);
          $("#txt_email").val(resp.email);
        }
      })
    }
    $("#btnGuardar").click(function(){
      $.ajax({
				url: "persona/misDatos",
				type: "POST",
				data: $("#frmNuevo").serialize(),
				success: function(response) {
					var resp = JSON.parse(response);
					if (resp.msg == "actualizado") {
						toastr.success('Registro actualizado correctamente');
					}
				},
				statusCode: {
					400: function(xhr) {
					
					},
					401: function(xhr) {

					}
				}
			})
    });
  </script>
</body>

</html>