<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountries;
use Com\Daw2\Models\AuxRolTrabajadores;
use Com\Daw2\Models\TrabajadorModel;

class edicionTrabajadorController extends BaseController
{
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
}