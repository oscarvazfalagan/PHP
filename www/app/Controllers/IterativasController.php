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

    public function ejercicio2(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );

        $this->view->showViews(array('templates/header.view.php', 'ejercicio2-iterativas.view.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicioIterativas2(): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $numeros = $_POST['numeros'];
        $check = $this->checkEjercicio2($numeros);
        if($check === true) {
            $arrayNumeros = explode(',', $numeros);
            sort($arrayNumeros);
            $data['arrayNumeros']=$arrayNumeros;
            $data['check']=$check;
            $this->view->showViews(array('templates/header.view.php', 'ejercicio2-iterativas.view.php', 'templates/footer.view.php'), $data);
        }else {
            echo 'Sin implentos';die;
        }
    }

    private function checkEjercicio2(string $numeros): string|true
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

    public function ejercicio3(string $numeros = '', array $errores = [], array $resultado = []): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar matriz'],
        );
        $data['errores'] = $errores;
        $data['numeros'] = $numeros;
        $data['resultado'] = $resultado;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio3-iterativas.view.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicioIterativas3(): void
    {
        $errores = $this->checkEjercicio3($_POST);
        $inputNumeros = filter_var($_POST['numeros'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errores === []) {
            //Hacemos el trabajo
            $aux = explode('|', $_POST['numeros']);

            $numeros = [];
            foreach ($aux as $ns) {
                $arrayNumeros = explode(',', $ns);
                if(!isset($numColumnas)) {
                    $numColumnas = count($arrayNumeros);
                }
                $numeros = array_merge($numeros, $arrayNumeros);
            }
            sort($numeros);
            $matriz = $this->montarMatriz($numeros, $numColumnas);
            $this->ejercicio3($inputNumeros, [], $matriz);

        } else {
            $this->ejercicio3($inputNumeros, $errores);
        }
    }

    private function montarMatriz(array $plano, int $numColumnas): array
    {
        $matriz = [];
        $aux = [];
        foreach($plano as $numero) {
            $aux[] = $numero;
            if (count($aux) === $numColumnas) {
                $matriz[] = $aux;
                $aux = [];
            }
        }
        return $matriz;
    }

    private function checkEjercicio3(array $data): array
    {
        $errores = [];
        if (empty($data['numeros'])) {
            $errores['numeros'] = 'Campo obligatorio';
        } else {
            $aux = explode('|', $data['numeros']);
            //Primero comprobamos que todas las filas tengan el mismo número de elementos
            foreach ($aux as $array) {
                if (!isset($numColumnas)) {
                    $numColumnas = count(explode(',', $array));
                } else if ($numColumnas !== count(explode(',', $array))) {
                    $errores['numeros'] = 'Las filas deben tener el mismo número de columnas.';
                }
            }
            $numeros = [];
            //Aplanamos y comprobamos que son números
            foreach ($aux as $ns) {
                $numeros = array_merge($numeros,  explode(',', $ns));
            }
            foreach ($numeros as $numero) {
                if (!is_numeric($numero)) {
                    $errores['numeros'] = "El valor '$numero' no es un número";
                }
            }
        }
        return $errores;
    }

    public function ejercicio4(array $errores = [],array $matches =[]): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $data['errores'] = $errores;
        $data['matches'] = $matches;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio4-iterativas.view.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicioIterativas4(): void
    {
       $errores = $this->checkEjercicio4($_POST['texto']);
       $array_with_matches = [];
        if($errores===[]){
            $array_with_matches = $this->calculadoraDeMatches($_POST['texto']);
        }


        $this->ejercicio4($errores,$array_with_matches);
    }


    private function checkEjercicio4(string $data): array
    {
        $errores = [];
        if (empty($data)) {
            $errores['letras'] = 'Campo obligatorio';
        } else {
                if(!preg_match("/[A-Z]/i",$data)){
                    $errores['texto'] = 'Debes introducir letras';
                }
        }
        return $errores;
    }

    private function calculadoraDeMatches(string $data): array
    {
        $abecedario = [
            'a' => 0,
            'b' => 0,
            'c' => 0,
            'd' => 0,
            'e' => 0,
            'f' => 0,
            'g' => 0,
            'h' => 0,
            'i' => 0,
            'j' => 0,
            'k' => 0,
            'l' => 0,
            'm' => 0,
            'n' => 0,
            'ñ' => 0,
            'o' => 0,
            'p' => 0,
            'q' => 0,
            'r' => 0,
            's' => 0,
            't' => 0,
            'u' => 0,
            'v' => 0,
            'w' => 0,
            'x' => 0,
            'y' => 0,
            'z' => 0
        ];

        foreach ($abecedario as $letra => $cantidad) {
            $number_of_matches = preg_match_all("/$letra/", $data, $matches);

            if ($number_of_matches > 0) {
                $abecedario[$letra] = $number_of_matches;
            } else {
                unset($abecedario[$letra]);
            }
        }
        arsort($abecedario);
        return $abecedario;

    }

    public function ejercicio5(array $errores = [],array $matches =[]): void
    {
        $data = array(
            'titulo' => 'Ejercicios iterativas',
            'breadcrumb' => ['Inicio', 'Ordenar'],
        );
        $data['errores'] = $errores;
        $data['matches'] = $matches;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio5-iterativas.view.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicioIterativas5(): void
    {
        $errores = $this->checkEjercicio5($_POST['texto']);
        $array_with_matches = [];
        if($errores===[]){
            $words = preg_split("/[^A-Z]/i",$_POST['texto']);
            $array_with_matches = $this->calculadora_de_palabras($words);
        }


        $this->ejercicio5($errores,$array_with_matches);
    }

    private function checkEjercicio5(string $data): array
    {
        $errores = [];
        if (empty($data)) {
            $errores['letras'] = 'Campo obligatorio';
        } else {
            if(!preg_match("/[A-Z]/i",$data)){
                $errores['texto'] = 'Debes introducir texto';
            }
        }
        return $errores;
    }
    private function calculadora_de_palabras(array|false $data): array
    {

        foreach ($data as $palabra=>$valor) {
            if(isset($data[$palabra])){
                $valor;
            }else{
                $valor = 1;
            }
        }
        return $data;
    }


}