<?php

namespace Controllers;

use MVC\Router;
use Model\post;
use Intervention\Image\ImageManagerStatic as image_post;

class PostController {
    public static function crear(Router $router) {
        session_start();
        isAuth();

        $post = new post($_POST);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $post = new post($_POST["post"]);
            
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Realiza un rezize a la imagen con intervention
                $imageP = image_post::make($_FILES["post"]["tmp_name"]["image_post"])->fit(800,600);
                $post->setImagenPost($nombreImagen);


                //Guarda la imagen en el servidor
                $imageP->save(IMAGENES_POSTS . $nombreImagen);

                //Guarda en la base de datos
                $post->guardar();

        }

        $router->render("post/crear", [
            "post" => $post
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();

        $id = validarORedireccionar("/admin");
        $post = post::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //Asignar los valores
            $args = $_POST["post"];
           //Sincronizar objeto
            $post->sincronizar($args);
        

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setear la imagen
            //Realiza un rezize a la imagen con intervention
            if ($_FILES["post"]["tmp_name"]["image_post"]) {
                $imageP = image_post::make($_FILES["post"]["tmp_name"]["image_post"])->fit(800,600);
                $post->setImagenPost($nombreImagen);
            }

                //Guarda la imagen en el servidor
                if ($_FILES["post"]["tmp_name"]["image_post"]) {
                    //Almacenar la imagen
                    $imageP->save(IMAGENES_POSTS . $nombreImagen);
                }

                //Guarda en la base de datos
                $post->guardar();
   
           
        }

        $router->render("post/actualizar", [
            "post" => $post
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
                    $post = post::find($id);
                    $post->eliminar();
                }
        
            }
        }

    }
}