<?php

namespace Controllers;

use MVC\Router;
use Model\vendedores;

class VendedorController {

    public static function crear(Router $router) {

        $errores = vendedores::getErrores();
        $vendedores = new vendedores;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //Crea una nueva instancia
            $vendedores = new vendedores($_POST["vendedores"]);
        
            //Validar campos vacios
            $errores = $vendedores->validar();
        
            //No hay errores
            if (empty($errores)) {
                $vendedores->guardar();
            }
        }
        
        $router->render("vendedores/crear", [
            "errores" => $errores,
            "vendedores" => $vendedores
        ]);
    }

    public static function actualizar(Router $router) {

        $errores = vendedores::getErrores();
        $id = validarORedireccionar("/admin");
        //Obtener el arreglo del vendedor
        $vendedores = vendedores::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //Asignar los valores
            $args = $_POST["vendedores"];
           //Sincronizar objeto
            $vendedores->sincronizar($args);
            //validacion
            $errores = $vendedores->validar();
           
            if (empty($errores)) {
                $vendedores->guardar();
            }
           
        }
        
        $router->render("vendedores/actualizar", [
            "errores" => $errores,
            "vendedores" => $vendedores
        ]);
    }

    public static function eliminar() {
       
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            //Valida el id
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                //Valida el tipo a eliminar
                $tipo = $_POST["tipo"];

                if(validarTipoCon($tipo)) {
                    $vendedores = vendedores::find($id);
                    $vendedores->eliminar();
                }
            }
        }
    }
}