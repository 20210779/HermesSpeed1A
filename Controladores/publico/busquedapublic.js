const MAIN = document.querySelector("MAIN");

MAIN.innerHTML = `
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFFFFF;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img class="ms-5" id="" src="../../Recursos/img/logo.png" alt="logo" width="70" height="64">

      <div class="row" id="ajustarBoton">
        <div class="col dropdown mt-1 pe-1">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/Recursos/img/Perfil.jpg" alt="" width="32" height="32" class="rounded-circle me-1">

          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li class="ms-3"><strong>Manu</strong></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
        <div class="col ps-1">
          <a class="btn blue_color_fixer" aria-current="page" href="index.html">
            <i class="fa-solid fa-cart-shopping" style="margin-top: 2px;"></i>
          </a>
        </div>

      </div>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html"><strong>Menu</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="hombre.html"><strong>Hombre</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><strong>Mujer</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><strong>Niños</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="sobre_nosotros.html"><strong>Sobre
                nosotros</strong></a>
          </li>
        </ul>
        <form class="d-flex" id="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
    </div>
  </nav>
`;