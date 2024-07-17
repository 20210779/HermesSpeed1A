// Constantes para completar las rutas de la API.
const PEDIDO_API = "servicios/privado/pedido.php";

// Constante para establecer el formulario de buscar.
const SEARCH_FORM = document.getElementById("searchForm");
// Constantes para establecer el contenido de la tabla.
const TABLE_BODY = document.getElementById("tableBody"),
  ROWS_FOUND = document.getElementById("rowsFound");
// Constantes para establecer los elementos del componente Modal.
const SAVE_MODAL = new bootstrap.Modal("#saveModal"),
  MODAL_TITLE = document.getElementById("modalTitle");

// Constantes para establecer los elementos del formulario de guardar.
const SAVE_FORM = document.getElementById("saveForm"),
  ID_PEDIDO = document.getElementById("idPedido"),
  ESTADO_PEDIDO = document.getElementById("estadoPedido"),
  FECHA_PEDIDO = document.getElementById("fechaPedido"),
  DIRECCION_PEDIDO = document.getElementById("direccionPedido");

// Método del evento para cuando el documento ha cargado.
document.addEventListener("DOMContentLoaded", () => {
  // Llamada a la función para mostrar el encabezado y pie del documento.
  loadTemplate();
  // Se establece el título del contenido principal.
  MAIN_TITLE.textContent = "Gestionar pedidos";
  // Llamada a la función para llenar la tabla con los registros existentes.
  fillTable();
});

// Método del evento para cuando se envía el formulario de buscar.
SEARCH_FORM.addEventListener("submit", (event) => {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  // Constante tipo objeto con los datos del formulario.
  const FORM = new FormData(SEARCH_FORM);
  // Llamada a la función para llenar la tabla con los resultados de la búsqueda.
  fillTable(FORM);
});

// Método del evento para cuando se envía el formulario de guardar.
SAVE_FORM.addEventListener("submit", async (event) => {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  // Se verifica la acción a realizar.
  ID_PEDIDO.value ? (action = "updateRow") : (action = "createRow");
  // Constante tipo objeto con los datos del formulario.
  const FORM = new FormData(SAVE_FORM);
  // Petición para guardar los datos del formulario.
  const DATA = await fetchData(PEDIDO_API, action, FORM);
  // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
  if (DATA.status) {
    // Se cierra la caja de diálogo.
    SAVE_MODAL.hide();
    // Se muestra un mensaje de éxito.
    sweetAlert(1, DATA.message, true);
    // Se carga nuevamente la tabla para visualizar los cambios.
    fillTable();
  } else {
    sweetAlert(2, DATA.error, false);
  }
});

/*
 *   Función asíncrona para llenar la tabla con los registros disponibles.
 *   Parámetros: form (objeto opcional con los datos de búsqueda).
 *   Retorno: ninguno.
 */

const fillTable = async (form = null) => {
  // Se inicializa el contenido de la tabla.
  ROWS_FOUND.textContent = "";
  TABLE_BODY.innerHTML = "";
  // Se verifica la acción a realizar.
  form ? (action = "searchRows") : (action = "readAll");
  // Petición para obtener los registros disponibles.
  const DATA = await fetchData(PEDIDO_API, action, form);
  // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
  if (DATA.status) {
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    DATA.dataset.forEach((row) => {
      // Se crean y concatenan las filas de la tabla con los datos de cada registro.
      TABLE_BODY.innerHTML += `
                <tr>
                    <td>${row.id_pedido}</td>
                    <td>${row.nombre_cliente}</td>
                    <td>${row.fecha_pedido}</td>
                    <td>${row.direccion_pedido}</td>
                    <td>${row.estado_pedido}</td>
                    <td>
                        <button type="button" class="btn btn-info" onclick="openUpdate(${row.id_pedido})">
                        <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </td>
                </tr>
            `;
    });
    // Se muestra un mensaje de acuerdo con el resultado.
    ROWS_FOUND.textContent = DATA.message;
  } else {
    sweetAlert(4, DATA.error, true);
  }
};

/*
 *   Función para preparar el formulario al momento de insertar un registro.
 *   Parámetros: ninguno.
 *   Retorno: ninguno.
 */
const openCreate = () => {
  // Se muestra la caja de diálogo con su título.
  SAVE_MODAL.show();
  MODAL_TITLE.textContent = "Crear pedido";
  // Se prepara el formulario.
  SAVE_FORM.reset();
  fillSelect(PEDIDO_API, "readAll", "estado_pedido");
};

const openUpdate = async (id) => {
  // Se define un objeto con los datos del registro seleccionado.
  const FORM = new FormData();
  FORM.append("idPedido", id);
  // Petición para obtener los datos del registro solicitado.
  const DATA = await fetchData(PEDIDO_API, "readOne", FORM);
  // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
  if (DATA.status) {
    // Se muestra la caja de diálogo con su título.
    SAVE_MODAL.show();
    MODAL_TITLE.textContent = "Actualizar pedido";
    // Se prepara el formulario.
    SAVE_FORM.reset();
    // Se inicializan los campos con los datos.
    const ROW = DATA.dataset;
    ID_PEDIDO.value = ROW.id_pedido;
    ESTADO_PEDIDO.value=ROW.estado_pedido;
  } else {
    sweetAlert(2, DATA.error, false);
  }
};

/*
*   Función para abrir un reporte automático de productos por categoría.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const openReport = () => {
  // Se declara una constante tipo objeto con la ruta específica del reporte en el servidor.
  const PATH = new URL(`${SERVER_URL}reportes/privado/pedido.php`);
  // Se abre el reporte en una nueva pestaña.
  window.open(PATH.href);
}