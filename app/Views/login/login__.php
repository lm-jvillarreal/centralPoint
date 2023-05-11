<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Central Point | Inicio de Sesión</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Inicio de Sesión</h1>
        <div class="row">
            <div class="col-md-12">
                <div id="alert"  role="alert">
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="frmLogin" action="" method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="usuario">
                                <label for="usuario" class="form-label">*Usuario:</label>
                                <input type="text" name="usuario" id="usuario" value="<?=old('usuario')?>" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="passwrd">
                                <label for="pass" class="from-label">*Pass:</label>
                                <input type="password" class="form-control" id="pass"  name="pass">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-lg">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        (function($){
            $('#frmLogin').submit(function(ev){
                $("#usuario > input").removeClass('is-invalid');
                $("#passwrd > input").removeClass('is-invalid');
                $("#alert").html("");
                $("#alert").removeClass('alert alert-danger');
                ev.preventDefault();
                $.ajax({
                    url:'login/processLogin',
                    type:'POST',
                    data:$(this).serialize(),
                    success:function(response){
                        var url=JSON.parse(response);
                        window.location.replace(url.url);
                    },
                    error: function(xhr){
                        if(xhr.status==400){
                            var errores=JSON.parse(xhr.responseText);
                            if(errores.usuario != ""){
                                $("#usuario > div").html(errores.usuario);
                                $("#usuario > input").addClass('is-invalid');
                            }
                            if(errores.pass != ""){
                                $("#passwrd > div").html(errores.pass);
                                $("#passwrd > input").addClass('is-invalid');
                            }
                        }else if(xhr.status==401){
                            $("#alert").removeClass('alert alert-danger');
                            var errores=JSON.parse(xhr.responseText);
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