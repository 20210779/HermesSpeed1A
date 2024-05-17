/*
 *   Controlador de uso general en las páginas web del sitio privado.
 *   Sirve para manejar la plantilla del encabezado y pie del documento.
 */

// Constante para completar la ruta de la API.
const USER_API = "servicios/privado/administrador.php";
// Constante para establecer el elemento del contenido principal.
const MAIN = document.querySelector("main");
// Se establece el título de la página web.
document.querySelector("title").textContent = "HermeSpeed - Menu";
// Constante para establecer el elemento del título principal.
const MAIN_TITLE = document.getElementById("mainTitle");
MAIN_TITLE.classList.add("text-center", "py-0");

/*  Función asíncrona para cargar el encabezado y pie del documento.
 *   Parámetros: ninguno.
 *   Retorno: ninguno.
 */
const loadTemplate = async () => {
  // Petición para obtener en nombre del usuario que ha iniciado sesión.
  const DATA = await fetchData(USER_API, "getUser");
  // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
  if (DATA.session) {
    // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
      // Se agrega el encabezado de la página web antes del contenido principal.
      MAIN.insertAdjacentHTML(
        "beforebegin",
        `
            <header class="container-fluid bg-dark d-flex justify-content-center">
      <p class="mb-0 p-1a text-warning">Contactanos 2039-3939</p>
    </header> 
    <nav class="navbar navbar-expand-lg navbar-light p-1" style="background-color: #FFFFFF;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../../recursos/img/logo.png" alt="" width="70" height="64">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="menu.html">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="producto.html">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pedido.html">Pedido</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="clientes.html">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="administrador.html">Administradores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="talla.html">Talla</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="marca.html">Marcas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="color.html">Colores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="detalleproducto.html">Detalle_producto</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="perfil.html">Editar perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                </ul>
          </li>
        </ul>                             
      </div>
    </div>
  </nav>`
      );
      // Se agrega el pie de la página web después del contenido principal.
      MAIN.insertAdjacentHTML(
        "afterend",
        `
                <footer>
                    <nav class="navbar fixed-bottom bg-body-tertiary">
                        <div class="container">
                            <div>
                                <p><a class="nav-link" href="https://github.com/dacasoft/coffeeshop" target="_blank"><i class="bi bi-github"></i> CoffeeShop</a></p>
                                <p><i class="bi bi-c-square-fill"></i> 2018-2024 Todos los derechos reservados</p>
                            </div>
                            <div>
                                <p><a class="nav-link" href="../public/" target="_blank"><i class="bi bi-cart-fill"></i> Sitio público</a></p>
                                <p><i class="bi bi-envelope-fill"></i> dacasoft@outlook.com</p>
                            </div>
                        </div>
                    </nav>
                </footer>
            `
      );
    } else {
      sweetAlert(3, DATA.error, false, "index.html");
    }
  } else {
    // Se comprueba si la página web es la principal, de lo contrario se direcciona a iniciar sesión.
    if (location.pathname.endsWith("index.html")) {
      // Se agrega el encabezado de la página web antes del contenido principal.
      MAIN.insertAdjacentHTML("beforebegin", ``);
      // Se agrega el pie de la página web después del contenido principal.
      MAIN.insertAdjacentHTML(
        "afterend",
        `
                <footer>
                    <nav class="navbar fixed-bottom bg-body-tertiary">
                        <div class="container"> 
                            <p><a class="nav-link" href="https://github.com/dacasoft/coffeeshop" target="_blank"><i class="bi bi-github"></i> CoffeeShop</a></p>
                            <p><i class="bi bi-envelope-fill"></i> dacasoft@outlook.com</p>
                        </div>
                    </nav>
                </footer>
            `
      );
    } else {
      location.href = "index.html";
    }
  }
};
