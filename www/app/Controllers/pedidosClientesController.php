<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class pedidosClientesController extends BaseController
{
    public function ejercicioPedidosClientes(string $json = '', array $errores = [], array $resultado = [], array $suspensos = []): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Cálculo de notas'],
        );
        $data['errores'] = $errores;
        $data['json'] = $json;
        $data['resultado'] = $resultado;
        $data['suspensos'] = $suspensos;
        $this->view->showViews(array('templates/header.view.php', 'ejercicioPedidosClientes.view.php', 'templates/footer.view.php'), $data);
    }

    public function doPedidosClientes(): void
    {
        $jsonPedidos = $_POST['jsonPedido'] ?? '';
        $jsonClientes = $_POST['jsonCliente'] ?? '';

        $errores = $this->checkJsons($jsonPedidos);
        $errores = $this->checkJsons($jsonClientes);
        if ($errores === []) {
            $resultado = $this->procesarEjercicio8(json_decode($json, true));
            $suspensos = $this->cursoEjercicio8(json_decode($json, true));
            $this->ejercicio8(filter_var($json, FILTER_SANITIZE_FULL_SPECIAL_CHARS), $errores, $resultado,$suspensos);
        } else {
            $this->ejercicio8(filter_var($json, FILTER_SANITIZE_FULL_SPECIAL_CHARS), $errores);
        }
    }
    private function checkJsons(string $json)
    {
        $errores = [];
        if ($json === '') {
            $errores['json'][] = 'Campo obligatorio';
        } else {
            if (json_validate($json)) {
                $datos = json_decode($json, true);
                if (is_array($datos)) {
                    foreach($datos as $asignatura => $alumnos) {
                        if (!is_string($asignatura)) {
                            $errores['json'][] = "El valor $asignatura no es una string";
                        } else {
                            if (!is_array($alumnos)) {
                                $errores['json'][] = "No tenemos un array de alumnos en la asignatura: $asignatura ";
                            } else {
                                foreach($alumnos as $nombre => $nota) {
                                    if (!is_string($nombre)) {
                                        $errores['json'][] = "En la asignatura $asignatura existe un alumno cuyo nombre no es una string";
                                    } elseif (!is_numeric($nota)) {
                                        $errores['json'][] = "En la asignatura $asignatura, el alumno $nombre no tiene una nota numérica";
                                    } elseif ($nota > 10 || $nota < 0) {
                                        $errores['json'][] = "En la asignatura $asignatura, el alumno $nombre no tiene una nota entre 0 y 10";
                                    }
                                }
                            }
                        }
                    }
                } else{
                    $errores['json'][] = 'El json no tiene el formato esperado';
                }
            } else {
                $errores['json'][] = 'Inserte un json válido';
            }
        }
        return $errores;
    }
}