<main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>
        <?php foreach($posts as $post) {?>

        <article class="entrada-blog">
            <div class="imagen">
                <img src="../imagenes_posts/<?php echo $post->image_post; ?>">
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $post->id; ?>">
                    <h4><?php echo $post->title; ?></h4>
                    <p>Escrito el: <span><?php echo $post->create_at; ?></span> por: <span>Admin</span> </p>

                    <p>
                        <?php echo $post->bodys; ?>
                    </p>
                </a>
            </div>
        </article>
        <?php } ?>

    </main>