// Constante para completar la ruta de la API.
const PRODUCTO_API = "servicios/publico/producto.php";
// Constante para establecer el contenedor de categorías.
const PRODUCTOS = document.getElementById("productos");

// Método del evento para cuando el documento ha cargado.
document.addEventListener("DOMContentLoaded", async () => {
  // Llamada a la función para mostrar el encabezado y pie del documento.
  loadTemplate();
  // Petición para obtener las categorías disponibles.
  const DATA = await fetchData(PRODUCTO_API, "readAll");
  // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
  if (DATA.status) {
    // Se inicializa el contenedor de categorías.
    PRODUCTOS.innerHTML = "";
    // Se recorre el conjunto de registros fila por fila a través del objeto row.
    DATA.dataset.forEach((row) => {
      // Se crean y concatenan las tarjetas con los datos de cada categoría.
      PRODUCTOS.innerHTML += `
            <div class="col-md-3 py-3 py-md-0">
                <a href="producto.html?id=${row.id_producto}" class="blue_color_fixer">
                    <div class="card mb-2">
                    <img src="${SERVER_URL}images/productos/${row.imagen_producto}" alt="${row.nombre_producto}">
                    <div class="card-body">
                        <h3>${row.nombre_producto}</h3>
                        <h5>${row.precio_producto} </h5>
                    </div>
                    </div>
                </a>
            </div>
            `;
    });
  } else {
    // Se asigna al título del contenido de la excepción cuando no existen datos para mostrar.
    document.getElementById("mainTitle").textContent = DATA.error;
  }
});
