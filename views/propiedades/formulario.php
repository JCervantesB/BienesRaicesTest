<fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?PHP echo s($propiedad->titulo); ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?PHP echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg , image/png" name="propiedad[imagen]">
                    <?php if ($propiedad->imagen) { ?>
                        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="casa" class="imagen-small">
                    <?php } ?>

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?PHP echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?PHP echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 2" min="1" max="9" value="<?PHP echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?PHP echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedores">Vendedor</label>
                <select name="propiedad[vendedorId]" id="vendedores">
                    <option value="">--Seleccione--</option>
                <?php foreach($vendedores as $vendedores) { ?>
                    <option <?php echo $propiedad->vendedorId === $vendedores->id ? "selected" : ""; ?> value="<?php echo s($vendedores->id); ?>"><?php echo s($vendedores->nombre) . " " . s($vendedores->apellido); ?></option>
               <?php } ?>
               </select>
            </fieldset>
