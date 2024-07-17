// Constante para completar la ruta de la API.
const PRODUCTO_API = 'servicios/privado/producto.php';
const CLIENTE_API = 'servicios/privado/cliente.php';


const CARDS_FOUND = document.getElementById('cardsFound');

// Método del evento para cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', () => {
    // Constante para obtener el número de horas.
    const HOUR = new Date().getHours();
    // Se define una variable para guardar un saludo.
    let greeting = '';
    // Dependiendo del número de horas transcurridas en el día, se asigna un saludo para el usuario.
    if (HOUR < 12) {
        greeting = 'Buenos días';
    } else if (HOUR < 19) {
        greeting = 'Buenas tardes';
    } else if (HOUR <= 23) {
        greeting = 'Buenas noches';
    }
    // Llamada a la función para mostrar el encabezado y pie del documento.
    loadTemplate();
    // Se establece el título del contenido principal.
    MAIN_TITLE.textContent = `${greeting}, bienvenido`;
    // Llamada a la funciones que generan los gráficos en la página web.
    graficoBarrasVentasCantidad();
    graficoClientesFrecuentesPie();
    graficoDistribucionPedido();
    graficoValoracionProductos();
    graficoIngresosMensuales();
    //graficoPastelCategorias();
});

/*
*   Función asíncrona para mostrar un gráfico de barras con la cantidad de productos por categoría.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/

const fillCards = async (form = null) => {
    // Se inicializa el contenido de la tabla.
    CARDS_FOUND.textContent = '';
    // Se verifica la acción a realizar.
    (form) ? action = 'searchRows' : action = 'readAll';
    // Petición para obtener los registros disponibles.
    const DATA = await fetchData(PRODUCTO_API, action, form);
    CARDS_FOUND.textContent = DATA.message;
    sweetAlert(4, DATA.error, true);
}

const graficoBarrasVentasCantidad = async () => {
    // Petición para obtener los datos del gráfico.
    const DATA = await fetchData(PRODUCTO_API, 'mayorCantidadVentas');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (DATA.status) {
        // Se declaran los arreglos para guardar los datos a graficar.
        let categorias = [];
        let cantidades = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            categorias.push(row.nombre_producto);
            cantidades.push(row.total_vendido);
        });
        // Llamada a la función para generar y mostrar un gráfico de barras. Se encuentra en el archivo components.js
        barGraph('chart1', categorias, cantidades, 'Mayor cantidad de ventas', 'Producto con mayor cantidad de ventas');
    } else {
        document.getElementById('chart1').remove();
        console.log(DATA.error);
    }
}

const graficoClientesFrecuentesPie = async () => {
    const DATA = await fetchData(PRODUCTO_API, 'clientesFrecuentes');
    if (DATA.status) {
        let nombre = [];
        let ventas = [];
        DATA.dataset.forEach(row => {
            nombre.push(row.nombre_cliente);
            ventas.push(row.total_pedidos);
        });
        createChart('chart2', 'pie', nombre, ventas, 'Clientes frecuentes', 'Clientes frecuentes con mayor cantidad de compras', true);
    } else {
        document.getElementById('chart2').remove();
        console.log(DATA.error);
    }
}

 
const graficoDistribucionPedido = async () => {
    const DATA = await fetchData(PRODUCTO_API, 'estadoPedidoGrafico');
    if (DATA.status) {
        let estado = [];
        let total = [];

        // Mapear los estados en la tabla
        const estadoMap = {
            'atrasado': 'Atrasado',
            'en_reparto': 'En Reparto',
            'ausente': 'Ausente',
            'reembolso': 'Reembolso'
        };

        DATA.dataset.forEach(row => {
            // Mapea los valores de estado_pedido a nombres significativos
            estado.push(estadoMap[row.estado_pedido] || row.estado_pedido);
            total.push(row.total_pedidos);
        });

        createChart('chart3', 'bar', estado, total, 'Distribución de los pedidos', 'Muestra la distribución de los estados de los pedidos');
    } else {
        document.getElementById('chart3').remove();
        console.log(DATA.error);
    }
};

 
const graficoValoracionProductos = async () => {
    const DATA = await fetchData(PRODUCTO_API, 'valoracionProductosGrafico');
    if (DATA.status) {
        let producto = [];
        let promedio = [];
        DATA.dataset.forEach(row => {
            producto.push(row.nombre_producto);
            promedio.push(row.calificacion_promedio);
        });
        createChart('chart4', 'doughnut', producto, promedio, 'Promedio de calificación de productos', 'Muestra la calificación promedio de los productos', true);
    } else {
        document.getElementById('chart4').remove();
        console.log(DATA.error);
    }
}

 
const graficoIngresosMensuales = async () => {
    const DATA = await fetchData(PRODUCTO_API, 'ingresosMensualesGrafico');
    if (DATA.status) {
        let mes = [];
        let total = [];
        DATA.dataset.forEach(row => {
            mes.push(row.mes);
            total.push(row.ingresos);
        });
        createChart('chart5', 'line', mes, total, 'Ingresos mensuales', 'Muestra los ingresos mensuales');
    } else {
        document.getElementById('chart5').remove();
        console.log(DATA.error);
    }
}


/*
*   Función asíncrona para mostrar un gráfico de pastel con el porcentaje de productos por categoría.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
/*
const graficoPastelCategorias = async () => {
    // Petición para obtener los datos del gráfico.
    const DATA = await fetchData(PRODUCTO_API, 'porcentajeProductosCategoria');
    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
    if (DATA.status) {
        // Se declaran los arreglos para guardar los datos a gráficar.
        let categorias = [];
        let porcentajes = [];
        // Se recorre el conjunto de registros fila por fila a través del objeto row.
        DATA.dataset.forEach(row => {
            // Se agregan los datos a los arreglos.
            categorias.push(row.nombre_categoria);
            porcentajes.push(row.porcentaje);
        });
        // Llamada a la función para generar y mostrar un gráfico de pastel. Se encuentra en el archivo components.js
        pieGraph('chart2', categorias, porcentajes, 'Porcentaje de productos por categoría');
    } else {
        document.getElementById('chart2').remove();
        console.log(DATA.error);
    }
}
    */