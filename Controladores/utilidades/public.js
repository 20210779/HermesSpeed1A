/*
 *   Controlador es de uso general en las páginas web del sitio público.
 *   Sirve para manejar las plantillas del encabezado y pie del documento.
 */

// Constante para completar la ruta de la API.
const USER_API = "servicios/publico/cliente.php";
// Constante para establecer el elemento del contenido principal.
const MAIN = document.querySelector("main");
MAIN.style.paddingTop = "75px";
MAIN.style.paddingBottom = "100px";
MAIN.classList.add("container-fluid");
// Se establece el título de la página web.
document.querySelector("title").textContent = "HERMESPEED - Tienda";

/*  Función asíncrona para cargar el encabezado y pie del documento.
 *   Parámetros: ninguno.
 *   Retorno: ninguno.
 */
const loadTemplate = async () => {
  // Petición para obtener en nombre del usuario que ha iniciado sesión.
  const DATA = await fetchData(USER_API, "getUser");
  // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
  if (DATA.session) {
    // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
    if (!location.pathname.endsWith("sesion.html")) {
      // Se agrega el encabezado de la página web antes del contenido principal.
      MAIN.insertAdjacentHTML(
        "beforebegin",
        `
                    <header class="container-fluid bg-dark d-flex justify-content-center">
        <p class="mb-0 p-1">Contáctanos 2039-3939</p>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFFFFF;">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
              aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <img class="ms-5" id="" src="../../recursos/img/logo.png" alt="logo" width="70" height="64">
            <div class="row" id="ajustarBoton">
              <div class="col pe-1">
                <a class="btn blue_color_fixer" aria-current="page" href="sesion.html">
                  <i class="fa-solid fa-user" style="margin-top: 2px;"></i>
                </a>
              </div>
              <div class="col ps-1">
                <a class="btn blue_color_fixer" aria-current="page" href="carrito.html">
                  <i class="fa-solid fa-cart-shopping" style="margin-top: 2px;"></i>
                </a>
              </div>
              <div class="col ps-1">
                <a class="btn blue_color_fixer" aria-current="page" onclick="openReport(${DATA.idCliente})">
                  <i class=" fa-solid fa-receipt" style="margin-top: 2px;"></i>
                </a>
              </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.html"><strong>index</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="hombre.html"><strong>Hombre</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="mujer.html"><strong>Mujer</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="nino.html"><strong>Niños</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="sobre_nosotros.html"><strong>Sobre
                      nosotros</strong></a>
                </li>
                <form class="d-flex" id="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
              </ul>

            </div>
          </div>
        </nav>       
            `
      );
    } else {
      location.href = "index.html";
    }
  } else {
    // Se agrega el encabezado de la página web antes del contenido principal.
    MAIN.insertAdjacentHTML(
      "beforebegin",
      `
    <header class="container-fluid bg-dark d-flex justify-content-center">
      <p class="mb-0 p-1">Contáctanos 2039-3939</p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFFFFF;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <img class="ms-5" id="" src="../../recursos/img/logo.png" alt="logo" width="70" height="64">
        <div class="row" id="ajustarBoton">
          <div class="col pe-1">
            <a class="btn blue_color_fixer" aria-current="page" href="sesion.html">
              <i class="fa-solid fa-user" style="margin-top: 2px;"></i>
            </a>
          </div>
          <div class="col ps-1">
            <a class="btn blue_color_fixer" aria-current="page" href="carrito.html">
              <i class="fa-solid fa-cart-shopping" style="margin-top: 2px;"></i>
            </a>
          </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html"><strong>Inicio</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="detalle_producto.html"><strong>Hombre</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="mujer.html"><strong>Mujer</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="nino.html"><strong>Niños</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="sobre_nosotros.html"><strong>Sobre
                  nosotros</strong></a>
            </li>
           <form class="d-flex" id="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">
              <i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          </ul>

        </div>
      </div>
    </nav>     
        `
    );
  }
  // Se agrega el pie de la página web después del contenido principal.
  MAIN.insertAdjacentHTML(
    "afterend",
    `
        <footer>
            <nav class="navbar fixed-bottom bg-body-tertiary">
                <div class="container">
                    <div>
                        <h6>HERMESPEED</h6>
                        <p><i class="bi bi-c-square"></i> 2018-2024 Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> hermespeed@outlook.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `
  );
};

const openReport = (id) => {
  // Se declara una constante tipo objeto con la ruta específica del reporte en el servidor.
  const PATH = new URL(`${SERVER_URL}reportes/publico/factura.php`);
  
  PATH.searchParams.append('idCliente', id);
  // Se abre el reporte en una nueva pestaña.
  window.open(PATH.href);
}
