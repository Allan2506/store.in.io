<?php
$servername = "localhost";
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
    $codigo = $_POST['Codigo'];

    // Evitar inyección SQL
    $codigo = $conn->real_escape_string($codigo);

    // Consulta preparada para mayor seguridad
    $sql = $conn->prepare("SELECT * FROM empleados WHERE Codigo = ?");
    $sql->bind_param("i", $codigo);  // 'i' para enteros
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Redirigir a proveedores.html si el código es correcto
        header("Location: proveedores.html");
        exit();
    } else {
        // Mostrar mensaje de error si el código es incorrecto
        echo "<script>alert('Código incorrecto.'); window.location.href='codigoe.html';</script>";
    }
}

$conn->close();
?>
