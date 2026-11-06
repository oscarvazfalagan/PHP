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
    $usuarios = $modelUsuarios->getUsuarios($_GET);
    $data['roles'] = $modelRoles->getAllRoles();
    $data['usuarios'] = $usuarios['usuarios'];
    $data['lastPage'] = $usuarios['lastPage'];
    $data['idiomas'] = $modelUsuarios ->getIdiomas();
    $data['order'] = $modelUsuarios ->getOrder($_GET);
    $data['currentPage'] = $modelUsuarios ->getPage();
    $input = filter_var_array($_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data['idiomaFiltro'] = $_GET['idioma'] ?? '';
    $data['input'] = $input;
    $getOrder = $_GET;
    $getPage = $_GET;
    unset($getOrder['order']);
    unset($getOrder['sentido']);
    unset($getPage['page']);
    $data['queryParams'] = http_build_query($getOrder);
    $data['queryParamsPage'] = http_build_query($getPage);
    $this->view->showViews(array('templates/header.view.php', 'ejercicioUsuarios.view.php', 'templates/footer.view.php'), $data);
    }


}