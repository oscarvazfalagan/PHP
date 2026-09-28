<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class EjerciciosDecisionController extends BaseController
{
    public function ejercicio1decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $x = 10;
        $y = 5;
        $divisible = false;
        if($x%$y== 0){
            $divisible = true;
        }
        $data['x'] = $x;
        $data['y'] = $y;
        $data['divisible'] = $divisible;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio1-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio2decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $x = 7;
        $y = 2;
        $z = 8;

        $data['x'] = $x;
        $data['y'] = $y;
        $data['z'] = $z;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio2-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio3decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $numeroSec = 7000;
        $horas = intval($numeroSec/3600);
        $minutos = intval($numeroSec%3600/60);
        $segundos = intval($numeroSec%3600%60);

        $data['numeroSec'] = $numeroSec;
        $data['horas'] = $horas;
        $data['minutos'] = $minutos;
        $data['segundos'] = $segundos;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio3-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio4decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $año = 1900;
        $bisiesto = false;
        if(($año%4==0 && $año%100!=0 )||$año%400==0){
            $bisiesto = true;
        }


        $data['año'] = $año;
        $data['bisiesto'] = $bisiesto;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio4-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio5decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $sueldoBase = 3000;
        $sueldoFinal = 0;
        if($sueldoBase<=1000){
            $sueldoFinal=$sueldoBase-($sueldoBase*10/100);
        }elseif ($sueldoBase>1000 && $sueldoBase<2000){
            $sueldoFinal=$sueldoBase-(($sueldoBase-1000)*15/100)-100;
        }elseif ($sueldoBase>=2000){
            $sueldoFinal=$sueldoBase-(($sueldoBase-2000)*18/100)-250;
        }


        $data['sueldoBase'] = $sueldoBase;
        $data['sueldoFinal'] = $sueldoFinal;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio5-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio6decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $nota = 4.99;

        $data['nota'] = $nota;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio6-decisiones.view.php', 'templates/footer.view.php'), $data);
    }
    public function ejercicio7decisiones(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Decisiones',
            'breadcrumb' => ['Inicio', 'Ejercicio Decisiones'],
        );
        $bebida = "Coca-cola";

        $tipo = match(strtolower($bebida)){
            "marcilla","monka" => "Cafe",
            "coca-cola","kas","pepsi" => "Refresco",
            "mondariz","cabreiroá","sousas" => "Agua"
        };

        $data['tipo'] = $tipo;
        $data['bebida'] = $bebida;
        $this->view->showViews(array('templates/header.view.php', 'ejercicio7-decisiones.view.php', 'templates/footer.view.php'), $data);
    }





}