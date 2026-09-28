<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

class IterativasController extends \Com\Daw2\Core\BaseController
{
    public function ejercicio1(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicio1-iterativos.view.php', 'templates/footer.view.php'), $data);
    }

    public function doEjercicio1(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $numeros = $_POST['numeros'];
        $check = $this->checkEjercicio1($numeros);
        if($check === true) {
            $arrayNumeros = explode(',', $numeros);
            $data['mayor']=max($arrayNumeros);
            $data['menor']=min($arrayNumeros);
            $this->view->showViews(array('templates/header.view.php', 'ejercicio1-iterativos.view.php', 'templates/footer.view.php'), $data);
        }else {
            echo 'Sin implentos';die;
        }
    }
    private function checkEjercicio1(string $numeros): string|true
    {
        if($numeros === ''){
            return 'Debe ingresar numeros';
        }
        $arrayNumeros = explode(',', $numeros);
        foreach ($arrayNumeros as $numero) {
            if(!is_numeric($numero)){
                return 'Debe ingresar numeros separados por comas';
            }
        }
        return true;
    }


}