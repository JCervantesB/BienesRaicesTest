<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $post->title; ?></h1>

   
    <img loading="lazy" src="/imagenes_posts/<?php echo $post->image_post; ?>" alt="imagen del post"  height="500">

        <p class="informacion-meta">Escrito el: <span><?php echo $post->create_at; ?></span> por: <span>Admin</span> </p>


        <div class="resumen-propiedad">
            <p><?php echo $post->bodys ?></p>
        </div>
    </main>