// Constante para completar la ruta de la API.
const VALORACION_API = 'servicios/publico/valoracion.php';
// Constante tipo objeto para obtener los parámetros disponibles en la URL.
const PARAMS = new URLSearchParams(location.search);
const VALORACIONES = document.getElementById('valoraciones');



// Método manejador de eventos para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', async () => {
    // Llamada a la función para mostrar el encabezado y pie del documento.
    loadTemplate();
    // Se define un objeto con los datos de la categoría seleccionada.
    const FORM = new FormData();
    FORM.append('idProducto', PARAMS.get('id'));
    // Petición para solicitar los productos de la categoría seleccionada.
    const DATA = await fetchData(VALORACION_API, 'readAllComment',FORM);
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
    if (DATA.status) {
        // Se asigna como título principal la categoría de los productos.
        // Se inicializa el contenedor de productos.
        VALORACIONES.innerHTML = '';
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se crean y concatenan las tarjetas con los datos de cada producto.
            VALORACIONES.innerHTML += `
            <div class="review">
            <div class="review-header">
              <div>
                <span class="star-rating">★★★★★</span>
                <span class="review-author"><strong>${row.nombre_cliente}</strong></span>
              </div>
              <span class="review-date">${row.fecha_valoracion}</span>
            </div>
            <div class="review-body">
              <h5><strong>${row.titulo_comentario}</strong></h5>
              <p class="fst-normal">${row.comentario_producto}</p>
              <div class="d-flex align-items-center">
                <span class="me-3">Helpful?</span>
                <button class="btn btn-light btn-sm ml-2"><i class="fa-regular fa-thumbs-up"></i> 0</button>
                <button class="btn btn-light btn-sm ml-2"><i class="fa-regular fa-thumbs-down"></i> 0</button>
                <button class="btn btn-link btn-sm ms-2 text-dark">Report review</button>
              </div>
            </div>
          </div>
            `;
        });
        document.getElementById('idProducto').textContent;
        // Se presenta un mensaje de error cuando no existen datos para mostrar.
        MAIN_TITLE.textContent = DATA.error;
    }
});