<?php
session_start();

// Configuración de conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "usuarios"; // Cambia al nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar que los datos hayan sido enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        header("Location: register.html?error=Las contraseñas no coinciden.");
        exit();
    }

    // Encriptar la contraseña
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Validar que el email no esté registrado
    $sql_validar = "SELECT * FROM registros WHERE email = ?";
    $stmt = $conn->prepare($sql_validar);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.html?error=El correo electrónico ya está registrado.");
        exit();
    }

    // Insertar los datos en la tabla "registros"
    $sql_insertar = "INSERT INTO registros (nombre, email, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insertar);
    $stmt->bind_param("sss", $nombre, $email, $password_hashed);

    if ($stmt->execute()) {
        // Guardar la información del usuario en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;
        header("Location: index.html?success=Registro exitoso.");
        exit();
    } else {
        header("Location: register.html?error=Error al registrar: " . $stmt->error);
        exit();
    }

    $stmt->close();
}

$conn->close();
?>