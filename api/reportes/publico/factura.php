<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../auxiliar/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new ReportPublic;

// Se verifica si existe un valor para el cliente, de lo contrario se muestra un mensaje.
if (isset($_GET['idCliente'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../modelos/data/pedido_data.php');
    // Se instancia la entidad correspondiente.
    $pedido = new PedidoData;
    // Se establece el valor del cliente, de lo contrario se muestra un mensaje.
    if ($pedido->setCliente($_GET['idCliente'])) {
        // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
        if ($dataFacturas = $pedido->generarFacturas()) {
        
            // Se inicia el reporte con el encabezado del documento.
            $firstFactura = $dataFacturas[0];
            $pdf->startReport('Factura del cliente ' . $firstFactura['nombre_cliente']);
            
            // Variables para controlar la impresión de encabezados.
            $currentDate = '';
            $subtotal = 0;
            $widths = [80, 30, 40, 40]; // Anchos de columnas para las celdas
            $totalWidth = array_sum($widths); // Ancho total de la tabla

            foreach ($dataFacturas as $rowFactura) {
                // Se verifica si la fecha o el cliente ha cambiado para iniciar una nueva factura.
                if ($currentDate != $rowFactura['fecha']) {
                    if ($currentDate != '') {
                        // Imprimir subtotal al final de la tabla anterior.
                        $pdf->Ln(5); // Espacio antes del subtotal
                        $pdf->setFont('Arial', 'B', 11);
                        $pdf->Cell($totalWidth, 10, 'Subtotal: ' . number_format($subtotal, 2), 0, 1, 'R');

                        // Añadir un espacio antes de la siguiente factura
                        $pdf->Ln(10);
                    }

                    // Se establece el encabezado de la factura.
                    $pdf->setFont('Arial', 'B', 12);
                    $pdf->Cell(0, 10, 'Factura del ' . $rowFactura['fecha'], 0, 1, 'L');
                    $pdf->Cell(0, 10, 'Direccion: ' . $rowFactura['direccion_pedido'], 0, 1, 'L');
                    $pdf->Ln(5);

                    // Se establecen los encabezados de la tabla de productos.
                    $pdf->setFillColor(225);
                    $pdf->setFont('Arial', 'B', 11);
                    $pdf->Cell($widths[0], 10, 'Producto', 1, 0, 'C', 1);
                    $pdf->Cell($widths[1], 10, 'Cantidad', 1, 0, 'C', 1);
                    $pdf->Cell($widths[2], 10, 'Precio Unitario', 1, 0, 'C', 1);
                    $pdf->Cell($widths[3], 10, 'Costo Total', 1, 1, 'C', 1);

                    // Se establece la fuente para los datos de los productos.
                    $pdf->setFont('Arial', '', 11);

                    // Reiniciar subtotal para la nueva factura.
                    $subtotal = 0;
                    
                    // Actualizar variables de control.
                    $currentDate = $rowFactura['fecha'];
                }

                // Se imprimen las celdas con los datos de los productos.
                $pdf->Cell($widths[0], 10, $rowFactura['nombre_producto'], 1, 0);
                $pdf->Cell($widths[1], 10, $rowFactura['cantidad_producto'], 1, 0);
                $pdf->Cell($widths[2], 10, number_format($rowFactura['precio_producto'], 2), 1, 0);
                $pdf->Cell($widths[3], 10, number_format($rowFactura['costo_total_producto'], 2), 1, 1);

                // Acumulando el subtotal.
                $subtotal += $rowFactura['costo_total_producto'];
            }

            // Imprimir el subtotal para la última factura.
            $pdf->Ln(5); // Espacio antes del subtotal
            $pdf->setFont('Arial', 'B', 11);
            $pdf->Cell($totalWidth, 10, 'Subtotal: ' . number_format($subtotal, 2), 0, 1, 'R');
            
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->Output('I', 'facturas_cliente.pdf');
        } else {
            print('No hay facturas para el cliente seleccionado.');
        }
    } else {
        print('Cliente incorrecto.');
    }
} else {
    print('Debe seleccionar un cliente.');
}
?>
