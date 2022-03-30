<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
            <input type="text" placeholder="Titulo" id="titulo" name="post[title]" value="<?PHP echo s($post->title); ?>" required>

            <label for="image_post">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg , image/png" name="post[image_post]" required>
                <?php if ($post->image_post) { ?>
                        <img src="/imagenes_posts/<?php echo $post->image_post ?>" alt="casa" class="imagen-small">
                    <?php } ?>

    <label for="body">Cuerpo</label>
                <textarea id="body" name="post[bodys]" cols="30" rows="10" required><?PHP echo s($post->bodys); ?></textarea>
            </fieldset>

</fieldset>