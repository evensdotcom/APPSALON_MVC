<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php 
  include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/crear-cuenta" method="POST" class="fomulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="campo-texto"
         placeholder="Tu Nombre" value="<?php echo s($usuario->nombre) ?>"/>
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido"
         class="campo-texto" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido) ?>" />
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" 
        class="campo-texto" placeholder="Tu Telefono" value="<?php echo s($usuario->telefono) ?>" />
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" 
        class="campo-texto" placeholder="Tu E-mail" value="<?php echo s($usuario->email) ?>" />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"
         class="campo-texto" placeholder="Tu Password" />

    </div>
    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olviaste tu password?</a>
</div>