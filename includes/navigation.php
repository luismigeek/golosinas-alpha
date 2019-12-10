<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1" href="index.php">
    <img src="http://placehold.it/50x50?text=Logo" alt="">
    Gologinas Alpha
  </a>

  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
  </button>

  <a href="../tienda" class="btn btn-info text-break">
    <span></span>Ir a tienda
  </a>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto mr-0 mr-md-3">
    <li class="nav-item dropdown no-arrow">

      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-3x fa-user-circle fa-fw"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">Cambiar contraseña</a>
        <a class="dropdown-item" href="#">Usuarios</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>      </div>

    </li>
  </ul>
</nav>