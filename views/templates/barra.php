<div class="barra">
    <p>Hola: <?php echo $nombre ?? '' ?></p>
    <a href="/logout" class="boton">Cerrar sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) { ?>

    <div class="barra-servicios">
        <a href="/admin" class="boton">Ver Citas</a>
        <a href="/servicios" class="boton">ver Servicios</a>
        <a href="/servicios/crear" class="boton">Nuevo Servicios</a>
    </div>

<?php } 
    
