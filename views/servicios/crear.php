<h1 class="nombre-pagina">Nuevo Servicios</h1>

<p class="descripcion-pagina">Llena todos los campos para añedir nuevos Servicios</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/servicios/crear" method="POST">

    <?php
    include_once __DIR__ . '/formulario.php';
    ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>