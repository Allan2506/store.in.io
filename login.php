<?php
$servername = "localhost";  // Corregido
$username = "root";
$password = "";
$dbname = "bd_empleados";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Evitar inyección SQL
    $correo = $conn->real_escape_string($correo);
    $contraseña = $conn->real_escape_string($contraseña);

    // Consulta preparada para mayor seguridad
    $sql = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?");
    $sql->bind_param("ss", $correo, $contraseña);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        header("Location: supervisor.html");
        exit();
    } else {
        // Error en inicio de sesión
        echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='inicio.html';</script>";
    }
}

$conn->close();
?>