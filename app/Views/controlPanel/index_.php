<!DOCTYPE html>
<html lang="es">

<head>
  <?= $template['head']; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= $template['header']; ?>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?= $template['menuV']; ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Panel de Control</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Central Point</a></li>
                <li class="breadcrumb-item active">Panel de Control</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <div class="container-fluid">
        <?php for($i=0; $i<count($categorias);){?>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title"><?=$categorias[$i]['categoria'];?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php for($a=0;$a<count($categorias[$i]['modulos']);){?>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box <?=$categorias[$i]['modulos'][$a]['tema']?>">
                      <div class="inner">
                        <h3><br></h3>
                        <p><?=$categorias[$i]['modulos'][$a]['modulo']?></p>
                      </div>
                      <div class="icon">
                        <i class="ion <?=$categorias[$i]['modulos'][$a]['icono']?>"></i>
                      </div>
                      <a href="<?=$categorias[$i]['modulos'][$a]['id_modulo']?>" class="small-box-footer">Accesar al módulo <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <?php $a++; } ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <?php $i=$i+1; } ?>
      </div>
      <!-- Main content -->
      <seccion class="content">

      </seccion>
    </div>
    <!-- /.content-wrapper -->
    <?= $template['footer2']; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <?= $template['footer'] ?>
</body>

</html>