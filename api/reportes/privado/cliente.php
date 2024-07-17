<?php
// Headers para poder operar con el reporte
require_once('../../auxiliar/report.php');
require_once('../../modelos/data/cliente_data.php');

//Iniciar la clase reporte
$pdf = new Report();

// Iniciar reporte con titulo
$pdf->startReport('Cliente por Estado');

// Instancia de la clase cliente data
$cliente = new ClienteData();

// Fetch data
$dataClientes = $cliente->readClientesPorEstado();

if ($dataClientes) {
    // Estilos de encabezados
    $pdf->setFillColor(200);
    $pdf->setFont('Arial', 'B', 11);

    // Imprimir encabezados
    $pdf->cell(90, 10, 'Nombre', 1, 0, 'C', 1);
    $pdf->cell(50, 10, 'DUI', 1, 0, 'C', 1);
    $pdf->cell(30, 10, 'Estado', 1, 1, 'C', 1);

    //Estilos
    $pdf->setFillColor(240);
    $pdf->setFont('Arial', '', 11);

    //Informacion
    foreach ($dataClientes as $rowCliente) {
        $estado = $rowCliente['estado_cliente'] ? 'Activo' : 'Inactivo';

        $pdf->cell(90, 10, $pdf->encodeString($rowCliente['nombre']), 1, 0);
        $pdf->cell(50, 10, $pdf->encodeString($rowCliente['dui_cliente']), 1, 0);
        $pdf->cell(30, 10, $estado, 1, 1);
    }
} else {
    $pdf->cell(0, 10, $pdf->encodeString('No hay clientes para mostrar'), 1, 1);
}
 
$pdf->output('I', 'cliente.pdf');

