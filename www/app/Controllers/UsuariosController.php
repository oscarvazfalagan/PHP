<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxRol;
use Com\Daw2\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    public function ejercicioUsuariosFiltros()
    {
    $data = array(
                'titulo' => 'Usuarios',
                'breadcrumb' => ['Inicio', 'Usuarios'],
     );
    $modelRoles = new AuxRol();
    $modelUsuarios = new UsuariosModel();
    $data['roles'] = $modelRoles->getAllRoles();
    $data['usuarios'] = $modelUsuarios->getUsuarios($_GET);
    $data['idiomas'] = $modelUsuarios ->getIdiomas();
    $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data['idiomaFiltro'] = $_GET['idioma'] ?? '';
    $data['input'] = $input;
    $this->view->showViews(array('templates/header.view.php', 'ejercicioUsuarios.view.php', 'templates/footer.view.php'), $data);
    }


}