<?php

namespace Controllers;

use MVC\Router;
use Model\propiedad;
use Model\vendedores;
use Model\post;
use Intervention\Image\ImageManagerStatic as image;

class PropiedadController {
    public static function index(Router $router) {
        session_start();
        isAuth();

        $propiedades = propiedad::all();
        $vendedores = vendedores::all();
        $posts = post::all();
        
        //Muestra mensaje condicional
        $resultado = $_GET["resultado"] ?? null;
        
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "posts" => $posts,
            "vendedores" => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();

        $propiedad = new propiedad;
        $vendedores = vendedores::all();
        $errores = propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            //Crea una nueva instancia
            $propiedad = new propiedad($_POST["propiedad"]);
    
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza un rezize a la imagen con intervention
                $image = image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800,600);
                $propiedad->setImagen($nombreImagen);

            $errores = $propiedad->validar();

            //Revisar si el arreglo de errores esta vacio
            if (empty($errores)) {


                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->guardar();
            }
        }

        
        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();
       
        $id = validarORedireccionar("/admin");
        $propiedad = propiedad::find($id);
        $errores = propiedad::getErrores();
        $vendedores = vendedores::all();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //Asignar los argumentos
            $args = $_POST["propiedad"];
        
            $propiedad->sincronizar($args);
        
            //Validacion
           $errores = $propiedad->validar();
        
           //Subida de archivos
        
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
           if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $image = image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
            }
        
            //Revisar si el arreglo de errores esta vacio
            if (empty($errores)) {
                if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    //Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
        
                 $propiedad->guardar();
            }
         }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores
        ]);
    }

    public static function eliminar() {
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //Validar id
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if($id) {
        
                $tipo = $_POST["tipo"];
        
                if (validarTipoCon($tipo)) {
                    $propiedad = propiedad::find($id);
                    $propiedad->eliminar();
                }
        
            }
        }

    }

}
