<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CP | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="">
        <br><br><br>
        <div class="login-logo">
            <a href="#"><b>Central</b>POINT</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa tus credenciales para iniciar</p>
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert" role="alert">

                        </div>
                    </div>
                </div>
                <form id="frmLogin" action="" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                        <div class="input-group flex-wrap">
                            <input type="text" class="form-control" placeholder="Nombre de usuario" name="usuario" id="usuario">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group flex-wrap">
                            <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        (function($) {
            $('#frmLogin').submit(function(ev) {
                $("#usuario").removeClass('is-invalid');
                $("#pass").removeClass('is-invalid');
                $("#alert").html("");
                $("#alert").removeClass('alert alert-danger');
                ev.preventDefault();
                $.ajax({
                    url: 'login/processLogin',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        var url = JSON.parse(response);
                        window.location.replace(url.url);
                    },
                    error: function(xhr) {
                        if (xhr.status == 400) {
                            var errores = JSON.parse(xhr.responseText);
                            if (errores.usuario != "" && errores.pass != "") {
                                $("#alert").addClass('alert alert-danger');
                                $("#alert").html(errores.usuario+"<br>"+errores.pass);
                                $("#usuario").addClass('is-invalid');
                                $("#pass").addClass('is-invalid');
                            }
                            else if (errores.usuario=="" && errores.pass != "") {
                                $("#alert").addClass('alert alert-danger');
                                $("#alert").html(errores.pass);
                                $("#pass").addClass('is-invalid');
                            }else if(errores.usuario!="" && errores.pass == ""){
                                $("#alert").addClass('alert alert-danger');
                                $("#alert").html(errores.usuario);
                                $("#usuario").addClass('is-invalid');
                            }
                        } else if (xhr.status == 401) {
                            $("#alert").removeClass('alert alert-danger');
                            var errores = JSON.parse(xhr.responseText);
                            $("#alert").html(errores.msg);
                            $("#alert").addClass('alert alert-danger');
                            $("#pass").val('');
                            $("#pass").focus();
                        }

                    }
                })
            })
        })(jQuery)
    </script>
</body>

</html>