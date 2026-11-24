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
                'js' => ['assets/js/pages/usuarios-sistema.js']
     );

    $modelRoles = new AuxRol();
    $modelUsuarios = new UsuariosModel();
    $usuarios = $modelUsuarios->getUsuarios($_GET);
    $data['roles'] = $modelRoles->getAllRoles();
    $data['usuarios'] = $usuarios['usuarios'];
    $data['lastPage'] = $usuarios['lastPage'];
    $data['idiomas'] = $modelUsuarios ->getIdiomas();
    $data['order'] = $modelUsuarios ->getOrder($_GET);
    $data['currentPage'] = $modelUsuarios ->getPage($_GET);
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
    $data['js'] = ['assets/js/pages/usuarios-sistema.js'];
    $this->view->showViews(array('templates/header.view.php', 'ejercicioUsuarios.view.php', 'templates/footer.view.php'), $data);
    }


    public function showLogin(string $error = ''): void
    {
        $data = array(
            'titulo' => '',
            'breadcrumb' => ['Inicio', 'login'],
            'error' => $error,
        );

        $this->view->showViews(array('templates/header.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
    }

    public function doLogin():void
    {
        $UsuariosModel = new UsuariosModel();
        $user = $UsuariosModel ->getUsuarioByEmail($_POST["email"]);
        if($user && password_verify($_POST["pass"], $user["pass"])){
            session_regenerate_id();
            $_SESSION['usuario'] = $user;
            header("Location: /");
        }else{
            $error = 'Email o Contraseña Incorrecta';
            $this->showLogin($error);
        }
    }


    public function doLogout():void{
        session_destroy();
        header("Location: /");
    }








}