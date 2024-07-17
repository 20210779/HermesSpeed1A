<?php
// Se incluye la clase del modelo.
require_once('../../modelos/data/color_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {

    // Se instancia la clase correspondiente.
    $color = new ColorData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'dataset' => null, 'error' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.

    // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
    switch ($_GET['action']) {
        
        case 'readAll':
            if ($result['dataset'] = $color->readAll()) {
                $result['status'] = 1;
                $result['message'] = 'Existen ' . count($result['dataset']) . ' registros';
            } else {
                $result['error'] = 'No existen colores registrados';
            }
            break;
        case 'readOne':
            if (!$color->setId($_POST['idColor'])) {
                $result['error'] = $color->getDataError();
            } elseif ($result['dataset'] = $color->readOne()) {
                $result['status'] = 1;
            } else {
                $result['error'] = 'Color nexistente';
            }
            break;
        case 'updateRow':
            $_POST = Validator::validateForm($_POST);
            if (
                !$color->setId($_POST['idColor']) or
                !$color->setNombre($_POST['colorZapato'])
            ) {
                $result['error'] = $color->getDataError();
            } elseif ($color->updateRow()) {
                $result['status'] = 1;
                $result['message'] = 'Color modificado correctamente';
            } else {
                $result['error'] = 'Ocurrió un problema al modificar el color';
            }
            break;
        default:
            $result['error'] = 'Acción no disponible';
    }
    // Se obtiene la excepción del servidor de base de datos por si ocurrió un problema.
    $result['exception'] = Database::getException();
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('Content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
