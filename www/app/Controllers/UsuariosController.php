<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxRol;
use Com\Daw2\Models\TrabajadorModel;
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
            'titulo' => 'Login',
            'breadcrumb' => ['Inicio', 'login'],
            'error' => $error,
        );

        $this->view->show('login.view.php', $data);
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

    public function edicionUsuario(string $id ,array $errores=[],): void{
        $data = array(
            'titulo' => 'Edicion de Trabajadores',
            'breadcrumb' => ['Inicio', 'edicionTrabajadores'],
            'errores' => $errores
        );
        $modelRol = new AuxRol();
        $data['roles'] = $modelRol->getAllRoles();
        $modelUsuarios = new UsuariosModel();
        $input = $modelUsuarios->getUsuarioById($id);
        if($input === false){
            header('Location: /trabajadorControllerFiltros');
            exit;
        }
        if($errores !== []){

        }
        $data['input'] = $input;
        $this->view->showViews(array('templates/header.view.php', 'edicionUsuario.view.php', 'templates/footer.view.php'), $data);
    }


    public function edicionUsuarioDo(string $id): void{
        $errores = $this->checkUsuariosFields($_POST);
        $this->edicionUsuarioDo($id,$errores);
    }


    public function checkUsuariosFields(array $fields){
        $errores = $this->checkerEmpty($fields);

        if(empty($errores['nombre'])  && strlen($fields['nombre'])>=5 ){
                $errores['nombre'] = ['Nombre debe ser mayor a 5 caracteres'];
        }

        if(empty($errores['nombre'])  && strlen($fields['nombre'])<=20 ){
            $errores['nombre'] = ['Nombre debe ser menor a 20 caracteres'];
        }

        if(empty($errores['nombre']) && (preg_match('^[A-Za-z0-9_]+$',$fields['nombre']))){
            $errores['nombre'] = ['Nombre con caracteres incorrectos'];
        }
        $modelUsuarios = new UsuariosModel();

        if(empty($errores['nombre']) && ($modelUsuarios->getUsuarioByName($fields["nombre"]) === false  )){
            $errores['nombre'] = ['Este nombre ya existe'];
        }



        if(empty($errores['password']) && (!preg_match('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}',$fields['password']))){
            $errores['password'] = ['Longitud mínima: 8
                                    Debe contener al menos una mayúscula.
                                    Debe contener al menos una minúscula.
                                    Debe contener al menos un número.'];
        }

        if(empty($errores['password'] && $fields['password'] !== $fields['password2'])){
            $errores['password'] = 'Contraseñas y contraseña de confirmacion distintas';
        }


        if(empty($errores['rol'])  && ($this->checkRoles($fields['rol']) === false) ){
            $errores['rol'] = ['El rol no existe en la base de datos.'];
        }

        if(empty($errores['idioma'])  && ($this->checkIdioma($fields['idioma']) === false) ){
            $errores['idioma'] = ['El rol no existe en la base de datos.'];
        }


        if(empty($errores['email'])  && (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $fields['email']))){
            $errores['email'] = ['El email no es valido'];
        }

        if(empty($errores['email']) && ($modelUsuarios->checkByEmail($fields["email"]))){
            $errores['email'] = ['Este email esta en uso'];
        }


        return $errores;

    }


    private function checkerEmpty($valor):array{
        $emptyFields = [];
        foreach ($valor as $key => $value) {
            if (empty($value)&& $value !== 0) {
                $emptyFields[$key] = 'campo vacio' ;
            }
        }
        return $emptyFields;
    }

    private function checkRoles($valor):bool
    {
        $auxRol = new AuxRol();
        $roles = $auxRol->getAllRoles();
        foreach ($roles as $rol) {
            if($rol['id_rol'] === $valor){
                return true;
            }
        }
        return false;
    }

    private function checkIdioma($valor):bool{
        $idiomas = ['es', 'en', 'gl'];
        foreach ($idiomas as $idioma) {
            if($valor === $idioma){
                return true;
            }
        }
        return false;
    }














}