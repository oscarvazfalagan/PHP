<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountries;
use Com\Daw2\Models\AuxRolTrabajadores;
use Com\Daw2\Models\TrabajadorModel;

class TrabajadorController extends BaseController
{

    public function ejercicioTrabajadores(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $data['trabajadores'] = $this ->conectar();
        $this->view->showViews(array('templates/header.view.php', 'ejercicioTrabajadores.view.php', 'templates/footer.view.php'), $data);
    }

    private function conectar():array
    {
        $trabajadorModel = new TrabajadorModel();
        $trabajadores = $trabajadorModel -> getTrabajadores();
        return $trabajadores;
    }


    public function ejercicioTrabajadoresOrd(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $data['trabajadores'] = $this ->conectarOrd();
        $this->view->showViews(array('templates/header.view.php', 'ejercicioTrabajadoresOrd.view.php', 'templates/footer.view.php'), $data);
    }

    private function conectarOrd():array
    {
        $trabajadorModel = new TrabajadorModel();
        $trabajadores = $trabajadorModel -> getTrabajadores();
        $salarioBruto = array_column($trabajadores, 'salarioBruto');
        array_multisort($salarioBruto, SORT_DESC, $trabajadores);
        return $trabajadores;
    }


    public function ejercicioTrabajadoresStan(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $data['trabajadores'] = $this ->conectarStan();
        $this->view->showViews(array('templates/header.view.php', 'ejercicioTrabajadoresSta.view.php', 'templates/footer.view.php'), $data);
    }

    private function conectarStan():array
    {
        $trabajadorModel = new TrabajadorModel();
        $trabajadores = $trabajadorModel -> getTrabajadores();
        foreach($trabajadores as $trabajador => $dato) {
            if($dato['id_rol']!=5){
                unset($trabajadores[$trabajador]);
            }
        }
        return $trabajadores;
    }


    public function ejercicioTrabajadoresNombre(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );
        $data['trabajadores'] = $this ->conectarNombre();
        $this->view->showViews(array('templates/header.view.php', 'ejercicioTrabajadoreNombre.view.php', 'templates/footer.view.php'), $data);
    }

    private function conectarNombre():array
    {
        $trabajadorModel = new TrabajadorModel();
        $trabajadores = $trabajadorModel -> getTrabajadores();
        foreach($trabajadores as $trabajador => $dato) {
            if(!preg_match("/^Carlos/",$dato['username'])){
                unset($trabajadores[$trabajador]);
            }
        }
        return $trabajadores;
    }


    public function ejercicioTrabajadoresFiltros(): void
    {
        $data = array(
            'titulo' => 'Ejercicio Tabajadores',
            'breadcrumb' => ['Inicio', 'Trabajadores'],
        );


        $idRol = $_GET ['rol'] ?? '';



        $modelTrabajador = new TrabajadorModel();
        $modelRoles = new AuxRolTrabajadores();
        $modelCountry = new AuxCountries();

        $data['countrys'] = $modelCountry->getCountries();
        $data['roles'] = $modelRoles->getRoles();
        $data['rolFiltro'] = $idRol;
        $data['order'] = $modelTrabajador->getOrderIndex($_GET);


        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            $modelPages = $modelTrabajador->getPages($_GET);
            $data['trabajadores'] = $modelTrabajador->getFilterby($_GET);
            $data['currentPage'] = $modelPages['currentPage'];
            $data['lastPage'] = $modelPages['lastPage'];

        $data['input'] = $input;
        $getOrder = $_GET;
        $getPage = $_GET;
        unset($getOrder['order']);
        unset($getOrder['sentido']);
        $data['queryParams'] = http_build_query($getOrder);
        unset($getPage['page']);
        $data['queryParamsPage'] = http_build_query($getPage);

        $this->view->showViews(array('templates/header.view.php', 'ejercicioTrabajadoreFiltros.view.php', 'templates/footer.view.php'), $data);
    }



}