<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
	<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light">Central Point</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
		</div>
		<div class="info">
			<a href="#" class="d-block"><?= session('nombre_persona'); ?></a>
		</div>
	</div>

	<!-- SidebarSearch Form -->
	<div class="form-inline">
		<div class="input-group" data-widget="sidebar-search">
			<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-sidebar">
					<i class="fas fa-search fa-fw"></i>
				</button>
			</div>
		</div>
	</div>

	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			<li class="nav-item menu-open">
				<a href="#" class="nav-link active">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>
						Favoritos
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?= base_url('controlPanel') ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Panel de Control</p>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link active">
					<i class="nav-icon fas fa-th"></i>
					<p>
						Catálogo de Puestos
					</p>
				</a>
			</li>
			<li class="nav-header">NAVEGACIÓN</li>
			<li class="nav-item">
				<a href="<?= base_url('misDatos') ?>" class="nav-link">
					<i class="nav-icon fas fa-address-card"></i>
					<p>
						Mis datos
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?= base_url('cambiar_pass') ?>" class="nav-link">
					<i class="nav-icon fas fa-key"></i>
					<p>
						Cambiar contraseña
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?= base_url('logout') ?>" class="nav-link">
					<i class="nav-icon fa fa-lock"></i>
					<p>
						Cerrar sesión
					</p>
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->