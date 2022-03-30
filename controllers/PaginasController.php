<?php

namespace Controllers;

use Model\post;
use MVC\Router;
use Model\propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {


    public static function index(Router $router) {
        $propiedades = propiedad::get(3);
        $posts = post::get(2);
        $inicio = true;

        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "posts" => $posts,
            "inicio" => $inicio
        ]);
    }

    public static function nosotros(Router $router) {

        $router->render("paginas/nosotros");
    }

    public static function propiedades(Router $router) {
        $propiedades = propiedad::all();

        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar("/propiedades");

        //Buscar la propiedad por su id
        $propiedad = propiedad::find($id);

        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $posts = post::all();

        // debuguear($posts);
        $router->render("paginas/blog", [
            "posts" => $posts
        ]);
    }

    public static function entrada(Router $router) {

        $id = validarORedireccionar("/blog");

        //Buscar la propiedad por su id
        $post = post::find($id);


        $router->render("paginas/entrada", [
            "post" => $post
        ]);
    }

    public static function contacto(Router $router) {
        $mensaje = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            // Validar 
            $respuestas = $_POST['contacto'];
        
            // create a new object
            $mail = new PHPMailer();
            // configure an SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '49ef2adab51387';
            $mail->Password = '3c6e2ead83d57c';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
        
            $mail->setFrom('admin@bienesraices.com', $respuestas['nombre']);
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Email';
            // Set HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 

            $contenido = '<html>';
            $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Compra: " . $respuestas['opciones'] . "</p>";
            $contenido .= "<p>Presupuesto o Precio: $" . $respuestas['presupuesto'] . "</p>";

            if($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] ." </p>";
            }

            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            

            // send the message
            if(!$mail->send()){
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email enviado Correctamente';
            }

        }

        $router->render("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }

}