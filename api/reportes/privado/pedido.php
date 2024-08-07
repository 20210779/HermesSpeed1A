<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../auxiliar/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../modelos/data/pedido_data.php');
//require_once('../../modelos/data/categoria_data.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Pedidos por estado');

// Se instancia el modelo Pedido para obtener los datos.
$pedido = new PedidoData;

// Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
if ($dataPedido = $pedido->pedidoPorEstado()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(200);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(126, 10, 'Estado', 1, 0, 'C', 1);
    $pdf->cell(30, 10, 'Cantidad', 1, 1, 'C', 1);
    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(240);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Arial', '', 11);

    // Se recorren los registros fila por fila.
    foreach ($dataPedido as $rowPedido) {
        // Reemplaza el guion bajo por un espacio en el texto del estado
        $estado = str_replace('_', ' ', $rowPedido['estado_pedido']);

        // Se imprime una celda con el nombre del estado del pedido.
        $pdf->cell(126, 10, $pdf->encodeString($estado), 1, 0, 'C', 1);
        $pdf->cell(30, 10, $rowPedido['total_pedidos'], 1, 1, 'C', 1);
    }
} else {
    // Si no hay registros, se imprime un mensaje.
    $pdf->cell(0, 10, $pdf->encodeString('No hay estados para mostrar'), 1, 1);
}

// Se llama implícitamente al método footer() y se envía el documento al navegador web.
$pdf->output('I', 'pedido.pdf');
