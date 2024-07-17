// Constante para completar la ruta de la API.
// el nombre es por el producto en categorias, la H es de la categoria de hombre y la D de su subcategoria de Calsado Deportivo
const PRODUCTO_API = 'servicios/publico/producto.php';
const CATEGORIA_API = 'servicios/publico/categoria.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const PRODUCTOS = document.getElementById('productos');
const ID_CATEGORIA = document.getElementById('idCategoria');
const MAIN_TITLE = document.getElementById('MainTitle');

// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Llamada a la función para mostrar el encabezado y pie del documento.
    loadTemplate();
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('idCategoria', PARAMS.get('id'));
    // Petición para solicitar los productos de la categoría seleccionada.
    const DATA = await fetchData(PRODUCTO_API, 'readProductosCategoriaHDeportivos');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se asigna como título principal la categoría de los productos.
        MAIN_TITLE.textContent = `Deportivo`;
        // Se inicializa el contenedor de productos.
        PRODUCTOS.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
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
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        MAIN_TITLE.textContent = DATA.error;
    }
});