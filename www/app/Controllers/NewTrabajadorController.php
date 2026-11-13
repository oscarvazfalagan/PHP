<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountries;
use Com\Daw2\Models\AuxRolTrabajadores;
use Com\Daw2\Models\TrabajadorModel;

class NewTrabajadorController extends BaseController
{
    public function new(array $errores = []){
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

    public function newTrabajador(){
        $modelTrabajador = new TrabajadorModel();
        $errores = $modelTrabajador->checkTrabajadorFields($_GET);
        $this->new($errores);
    }
}