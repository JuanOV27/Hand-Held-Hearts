<?php

function obtener_servicios() {
    try {
        // Importar las credenciales

        echo "Entró a funciones";
        require 'database.php';

        // Consulta SQL
        $sql = "SELECT * FROM acceso_sistema;";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

obtener_servicios();