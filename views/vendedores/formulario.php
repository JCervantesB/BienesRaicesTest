<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="vendedores[nombre]" placeholder="Nombre Vendedor(a)" value="<?PHP echo s($vendedores->nombre); ?>">

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="vendedores[apellido]" placeholder="Apellido Vendedor(a)" value="<?PHP echo s($vendedores->apellido); ?>">

    <label for="telefono">Telefono</label>
    <input type="text" id="telefono" name="vendedores[telefono]" placeholder="Telefono Vendedor(a)" value="<?PHP echo s($vendedores->telefono); ?>">

</fieldset>