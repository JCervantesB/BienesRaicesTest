<main class="contenedor seccion contenido-centrado">
        <h1>Inciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form method="POST" class="formulario" action="/login">
        <fieldset>
                <legend>Emai y Contraseña</legend>

                <label for="email">E-mail</label>
                <input name="email" type="email" placeholder="Tu Email" id="email" >

                <label for="password">Contraseña</label>
                <input name="password" type="password" placeholder="Tu Contraseña" id="password" > 

            </fieldset>
            <input type="submit" value="Inciar Sesion" class="boton boton-verde">
        </form>
    </main>