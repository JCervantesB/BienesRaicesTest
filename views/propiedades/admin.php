<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php
            if($resultado) {
                $mensaje = mostrarNoti(intval($resultado));
                if($mensaje) { ?>
                    <p class="alerta exito"><?php echo s($mensaje) ?></p>
              <?php  } 
            } ?>


        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuev@ Vendedor</a>
        <a href="/post/crear" class="boton boton-azul">Nuevo Post</a>

        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!-- Mostar los resuktados -->
                <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td align="center"><?php echo $propiedad->id; ?> </td>
                    <td align="center"><?php echo $propiedad->titulo; ?></td>
                    <td align="center"><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td align="center">$<?php echo $propiedad->precio; ?></td>

                    <td>

                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                        
                        <a href="propiedades/actualizar?id= <?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

<h2>Vendedores</h2>

<table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody><!-- Mostar los resuktados -->
        <?php foreach($vendedores as $vendedores): ?>
        <tr>
            <td align="center"><?php echo $vendedores->id; ?> </td>
            <td align="center"><?php echo $vendedores->nombre . " " . $vendedores->apellido; ?></td>
            <td align="center"><?php echo $vendedores->telefono; ?></td>

            <td>

            <form method="POST" class="w-100" action="/vendedores/eliminar">
                <input type="hidden" name="id" value="<?php echo $vendedores->id; ?>">
                <input type="hidden" name="tipo" value="vendedores">
                <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
                
                <a href="/vendedores/actualizar?id= <?php echo $vendedores->id; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Posts</h2>

<table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagenes</th>
            <th>Titulo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody><!-- Mostar los resuktados -->
        <?php foreach($posts as $post): ?>
        <tr>
            <td align="center"><?php echo $post->id; ?> </td>
            <td align="center"><img src="../imagenes_posts/<?php echo $post->image_post; ?>" class="imagen-tabla"></td>
            <td align="center"><?php echo $post->title; ?></td>

            <td>

            <form method="POST" class="w-100" action="/post/eliminar">
                <input type="hidden" name="id" value="<?php echo $post->id; ?>">
                <input type="hidden" name="tipo" value="post">
                <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
                
                <a href="/post/actualizar?id= <?php echo $post->id; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</main>