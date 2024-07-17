<?php
// Se incluye la clase del modelo.
require_once('../../modelos/data/talla_data.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    $talla = new TallaData;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'dataset' => null, 'error' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $talla->readAll()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'No existen tallas registradas';
                }
                break;
            case 'readOne':
                if (!$talla->setId($_POST['idTalla'])) {
                    $result['error'] = $talla->getDataError();
                } elseif ($result['dataset'] = $talla->readOne()) {
                    $result['status'] = 1;
                } else {
                    $result['error'] = 'Talla inexistente';
                }
                break;
            case 'updateRow':
                $_POST = Validator::validateForm($_POST);
                if (
                    !$talla->setId($_POST['idTalla']) or
                    !$talla->setTalla($_POST['tamanoTalla'])
                ) {
                    $result['error'] = $talla->getDataError();
                } elseif ($talla->updateRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Talla modificada correctamente';
                } else {
                    $result['error'] = 'Ocurrió un problema al modificar la talla';
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

