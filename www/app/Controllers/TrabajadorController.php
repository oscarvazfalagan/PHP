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

    public function new(array $input = [],array $errores = []){
        $data = array(
            'titulo' => 'NewTrabajador',
            'breadcrumb' => ['Inicio', 'NewTrabajador'],
        );
        $modelRoles = new AuxRolTrabajadores();
        $roles = $modelRoles->getRoles();
        $data['roles'] = $roles;
        $modelCountry = new AuxCountries();
        $countries = $modelCountry->getCountries();
        $data['countrys'] =  $countries;
        $data['errores']= $errores;
        $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['input'] = $input;


        $this->view->showViews(array('templates/header.view.php', 'newTrabajador.view.php', 'templates/footer.view.php'), $data);
    }

    public function newTrabajador():void{
        $errores = $this->checkTrabajadorFields($_POST);
        if ($errores !== []){
            $this -> new(filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS),$errores);
        } else{
            $TrabajadorModel = new TrabajadorModel();
            $res = $TrabajadorModel->crearTrabajador($_POST);
            if ($res !== true) {
                echo 'Error';
            }
        }



    }


    private function checkTrabajadorFields($campos):array{
        $badFields = $this->checkerEmpty($campos);

        if(empty($badFields['username']) && strlen($campos['username'])<4){
            $badFields['username'] = 'Longitud Minima de 4 Caracteres';
        }
        if(empty($badFields['username']) && strlen($campos['username'])>50){
            $badFields['username'] = 'Longitud maxima de 50 Caracteres';
        }
        if(empty($badFields['id_rol'])){
            $modelRol = New AuxRolTrabajadores();
            if(!$modelRol->checkWhereID($campos['id_rol'])){
                $badFields['id_rol'] = 'El rol no existe';
            }
        }

        if(empty($badFields['id_country'])){
            $modelCountries = New AuxCountries();
            if(!$modelCountries->checkWhereID($campos['idCountry'])){
                $badFields['id_country'] = 'El country no existe';
            }
        }


        if(filter_var($campos['salarioBruto'], FILTER_VALIDATE_INT) === false ){
            $badFields['salarioBruto'] = 'Tienes que introducir un valor numerico';
        }else{
            if((int)$campos['salarioBruto']>500){
                $badFields['salarioBruto']= 'El valor del salario tiene que ser mayo a 500 ';
            }
        }

        if(filter_var($campos['retencionIRPF'], FILTER_VALIDATE_INT) === false ){
            $badFields['retencionIRPF'] = 'Tienes que introducir un valor numerico';
        }else{
            if((int)$campos['retencionIRPF']>100){
                $badFields['retencionIRPF'] = 'Tiene que ser un valor menor a 100';
            }
            if((int)$campos['retencionIRPF']<0){
                $badFields['retencionIRPF'] = 'Tiene que ser un valor mayor que 0';
            }
        }

        return $badFields;
    }

    private function checkerEmpty($valor):array{
        $emptyFields = [];
        foreach ($valor as $key => $value) {
            if (empty($value)) {
                $emptyFields[] = [$key => 'campo vacio']; ;
            }
        }
        return $emptyFields;
    }


    public function edicionTrabajador(String $username){
        $data = array(
            'titulo' => 'Edicion de Trabajadores',
            'breadcrumb' => ['Inicio', 'edicionTrabajadores'],
        );
        $modelRoles = new AuxRolTrabajadores();
        $roles = $modelRoles->getRoles();
        $data['roles'] = $roles;
        $modelCountry = new AuxCountries();
        $countries = $modelCountry->getCountries();
        $data['countrys'] =  $countries;
        $modelTrabajador = new TrabajadorModel();
        $input = $modelTrabajador->whereName($username);
        $data['input'] = $input;

        $this->view->showViews(array('templates/header.view.php', 'edicionTrabajador.view.php', 'templates/footer.view.php'), $data);
    }

    public function edicionTrabajadorDO(){
        $errores = $this->checkTrabajadorForm($_POST);
        if ($errores !== []) {
            $this->new(
                filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                $errores
            );
        } else {
            $trabajadoresModel = new TrabajadorModel();
            $res = $trabajadoresModel->updateTrabajador($_POST);
            if ($res !== true) {
                echo 'Error';
            }
        }
    }



}