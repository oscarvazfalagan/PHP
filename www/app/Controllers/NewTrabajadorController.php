<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxCountries;
use Com\Daw2\Models\AuxRolTrabajadores;

class NewTrabajadorController extends BaseController
{
    public function new(){
        $data = array(
            'titulo' => 'NewTrabajador',
            'breadcrumb' => ['Inicio', 'NewTrabajador'],
        );
        $modelRoles = new AuxRolTrabajadores();
        $data['roles'] = $modelRoles->getRoles();
        $modelCountry = new AuxCountries();
        $data['countrys'] = $modelCountry->getCountries();

        $this->view->showViews(array('templates/header.view.php', 'newTrabajador.view.php', 'templates/footer.view.php'), $data);
    }

}