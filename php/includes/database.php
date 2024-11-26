<?php

$db = mysqli_connect('localhost', 'root', '', 'bd_prueba');

if(!$db) {
    echo "Hubo un error al conectarse a la base de datos";
    exit;
}