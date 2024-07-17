<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../auxiliar/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../modelos/data/pedido_data.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Ingresos mensuales del año actual');

// Se instancia el modelo Pedido para obtener los datos.
$pedido = new PedidoData;

// Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
if ($dataPedido = $pedido->ingresosFechaActual()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(200, 200, 200);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(100, 10, 'Mes', 1, 0, 'C', 1);
    $pdf->cell(90, 10, 'Total de ingresos', 1, 1, 'C', 1);

    // Se establece un color de relleno para las filas de datos.
    $pdf->setFillColor(240, 240, 240);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Arial', '', 11);

    // Variable para alternar el color de fondo de las filas.
    $fill = 0;

    // Se recorren los registros fila por fila.
    foreach ($dataPedido as $rowPedido) {
        // Se imprime una celda con los ingresos por mes
        $pdf->cell(100, 10, $rowPedido['mes'], 1, 0, 'C', $fill);
        $pdf->cell(90, 10, '$' . number_format($rowPedido['total_ingresos'], 2), 1, 1, 'C', $fill);
        
        // Alternar el color de fondo
        $fill = !$fill;
    }
} else {
    // Si no hay registros, se imprime un mensaje.
    $pdf->cell(0, 10, $pdf->encodeString('No hay ingresos para mostrar'), 1, 1);
}

// Se llama implícitamente al método footer() y se envía el documento al navegador web.
$pdf->output('I', 'ingresos.pdf');
?>
