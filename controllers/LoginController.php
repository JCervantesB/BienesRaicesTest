<?php

namespace Controllers;
use MVC\Router;
use Model\admin;
class LoginController {

    public static function login(Router $router) {
        $errores = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $auth = new admin($_POST);
        $errores = $auth->validar();

        if(empty($errores)) {
            //Verificar si el usuario existe
            $resultado = $auth->existeUsuario();

            if(!$resultado) {
                $errores = admin::getErrores();
            }else {
            //Verificar el password
            $autenticado = $auth->comprobarPassword($resultado);

            if($autenticado) {
            //Verificar al usuario
                $auth->autenticar();
            }else {
                $errores = admin::getErrores();
            }
        }
    }
    }

    $router->render("auth/login", [
        "errores" => $errores
    ]);

}

    public static function logout() {
        session_start();

        $_SESSION = [];

        header("Location: /");
    }
}