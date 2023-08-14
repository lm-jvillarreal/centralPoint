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
                            <h1>Administración de Grupos a Calificar</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administración y Seguridad</a></li>
                                <li class="breadcrumb-item active">Grupo a Calificar</li>
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
                                    <h3 class="card-title">Catálogo de Calificaciones</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="departamentos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="clickable-cell" data-url="http://localhost:8080/CDI/centralPoint/public/35" width='15%'>#</th>
                                                <th class="clickable-cell" data-url="http://localhost:8080/CDI/centralPoint/public/35" width='85%'>#Nivel</th>
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
                    <!-- ... (código existente) ... -->
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
        $(document).ready(function () {
            Tabla();
            setupClickableCells();
        });

        function setupClickableCells() {
            $('.clickable-cell').click(function () {
                var url = $(this).data('url');
                if (url) {
                    redireccionar(url);
                }
            });
        }

        function redireccionar(url) {
            window.location.href = url;
        }

        function Tabla() {
            var tabla = $("#departamentos").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                "lengthChange": false,
                "autoWidth": false,
                "dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>rt<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "ajax": {
                    type: "POST",
                    url: "mCDIGrupoCalis/listar",
                    dataSrc: "",
                    data: "",
                },
                "columns": [
                    {
                        "type": "html-num",
                        "data": "id"
                    },
                    {
                        "data": "nivel"
                    }
                ]
            });
        }
    </script>
</body>

</html>
