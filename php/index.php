<?php
    require __DIR__ . '/includes/funciones.php';    
    $consulta = obtener_servicios();
?>



<?php include 'includes/header.php'; ?>

<?php

echo "hola bienvenido a nuestro backend";

?>

<h2> Listado de Usuarios de la Base de datos </h2>

<?php
                        while($usuario = mysqli_fetch_assoc($consulta)) { ?>
                        <div class="servicio">
                            <p class="nombre-servicio"><?php echo $usuario['usuario']; ?></p>
                            <p class="precio-servicio"><?php echo $usuario['password']; ?></p>
                        </div>
                        <?php } ?>

<?php include 'includes/footer.php'; ?>
