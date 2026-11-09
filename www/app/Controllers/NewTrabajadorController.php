<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class NewTrabajadorController extends BaseController
{
    public function new(){
        $data = array(
            'titulo' => 'NewTrabajador',
            'breadcrumb' => ['Inicio', 'NewTrabajador'],
        );

        $this->view->showViews(array('templates/header.view.php', 'newTrabajador.view.php', 'templates/footer.view.php'), $data);
    }

}