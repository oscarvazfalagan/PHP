<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class preferenciasController extends BaseController
{

    public function showPrefrencias()
    {
        $data = array(
                    'titulo' => 'Preferencias',
                    'breadcrumb' => ['Inicio', 'preferencias'],
        );
         $this->view->showViews(array('templates/header.view.php', 'preferencias.view.php', 'templates/footer.view.php'), $data);
    }

    public function savePrefrencias(){
        $darmode = (!empty($_POST['tema']) && $_POST['tema'] == 'dark');
        setcookie('dark_mode',(string)$darmode, time() + 3600);
        $_COOKIE['dark_mode'] = $darmode;
        $this->showPrefrencias();
    }



}