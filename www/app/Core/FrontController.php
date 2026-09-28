<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\CategoriaController;
use Com\Daw2\Controllers\EjerciciosController;
use Com\Daw2\Controllers\PreferenciasController;
use Com\Daw2\Controllers\UsuarioSistemaController;
use Steampixel\Route;

class FrontController
{
    public static function main()
    {
        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );
        Route::add(
            '/ejercicio1-strings',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio1Strings();

            },
            'get'
        );

        Route::add(
            '/ejercicio1-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio1operadores();

            },
            'get'
        );
        Route::add(
            '/ejercicio2-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio2operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio3-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio3operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio4-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio4operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio5-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio5operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio6-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio6operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio7-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio7operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio8-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio8operadores();
            },
            'get'
        );
        Route::add(
            '/ejercicio9-operadores',
            function () {
                $controlador = new \Com\Daw2\Controllers\EjerciciosController();
                $controlador->ejercicio9operadores();
            },
            'get'
        ); Route::add(
        '/ejercicio1-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio1decisiones();
        },
    ); Route::add(
        '/ejercicio2-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio2decisiones();
        },
    ); Route::add(
        '/ejercicio3-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio3decisiones();
        },
    ); Route::add(
        '/ejercicio4-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio4decisiones();
        },
    ); Route::add(
        '/ejercicio5-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio5decisiones();
        },
    ); Route::add(
        '/ejercicio6-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio6decisiones();
        },
    ); Route::add(
        '/ejercicio7-decisiones',
        function () {
            $controlador = new \Com\Daw2\Controllers\EjerciciosDecisionController();
            $controlador->ejercicio7decisiones();
        },
    ); Route::add(
        '/ejercicio1-iterativo',
        function () {
            $controlador = new \Com\Daw2\Controllers\IterativasController();
            $controlador->doEjercicio1();
        },
        'post'
    ); Route::add(
        '/ejercicio1-iterativo',
        function () {
            $controlador = new \Com\Daw2\Controllers\IterativasController();
            $controlador->ejercicio1();
        },
    );



        Route::add(
            '/demo-proveedores',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demo();
            },
            'get'
        );
        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );
        Route::methodNotAllowed(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}
