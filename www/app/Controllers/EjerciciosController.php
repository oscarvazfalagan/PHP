<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class EjerciciosController extends \Com\Daw2\Core\BaseController
{
    public function ejercicio1strings(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Strings',
            'breadcrumb' => ['Inicio', 'Ejercicio Strings'],
            //'variableNueva' => 'Tengo valor'
        );
        $this->view->showViews(array('templates/header.view.php', 'ejercicios1-strings.view.php', 'templates/footer.view.php'), $data);
    }

    public function ejercicio1operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $x = 10;
        $y = $x**2;
        $data['x'] = $x;
        $data['y'] = $y;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio1-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio2operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $x = 10.75;
        $y = 7;
        $z = $x*$y;
        $data['x'] = $x;
        $data['y'] = $y;
        $data['z'] = $z;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio2-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio3operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $x = 10;
        $y = 8;
        $z = $x*$y;
        $p= 2*($x+$y);
        $data['x'] = $x;
        $data['y'] = $y;
        $data['z'] = $z;
        $data['p'] = $p;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio3-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio4operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $nombre = 'Manuel';
        $edad= 14;
        $media = 6.5;
        $data['nombre'] = $nombre;
        $data['edad'] = $edad;
        $data['media'] = $media;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio4-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio5operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $precioA = 100;
        $precioB = 70;
        $nochesA = 5;
        $nochesB = 6;

        $totalA = $precioA * $nochesA;
        $totalB = $precioB * $nochesB;
        $total = $totalA + $totalB;

        $data['precioA'] = $precioA;
        $data['precioB'] = $precioB;
        $data['nochesA'] = $nochesA;
        $data['nochesB'] = $nochesB;
        $data['totalA'] = $totalA;
        $data['totalB'] = $totalB;
        $data['total'] = $total;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio5-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio6operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $radio = 5;
        $area = pi()*($radio**2);
        $perimetro = 2*pi()*$radio;



        $data['radio'] = $radio;
        $data['area'] = $area;
        $data['perimetro'] = $perimetro;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio6-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio7operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $kilometros = 5;
        $horas = 2;
        $kmH = $kilometros / $horas;
        $mS = $kmH / 3.6;

        $data['kilometros'] = $kilometros;
        $data['horas'] = $horas;
        $data['kmH'] = $kmH;
        $data['mS'] = $mS;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio7-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio8operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $number = 342;
        $cen = intval($number/100);
        $den = intval($number%100/10);
        $und = intval($number%10);

        $data['number'] = $number;
        $data['cen'] = $cen;
        $data['den'] = $den;
        $data['und'] = $und;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio8-operadores.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio9operadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Operadores',
            'breadcrumb' => ['Inicio', 'Ejercicio Operadores'],
        );
        $cadena = "La cadena de Texto";
        $letras = mb_strlen($cadena, 'UTF-8');
        $palabras = str_word_count($cadena);
        $data['letras'] = $letras;
        $data['palabras'] = $palabras;
        $data['cadena'] = $cadena;

        $this->view->showViews(array('templates/header.view.php', 'ejercicio9-operadores.view.php', 'templates/footer.view.php'), $data);
    }

    function addNumbers(int|float $a, int|float $b, int|float $c = 0, int|float|string $d = 0): int|false
    {
        return $a + $b + $c + $d;
    }



}
