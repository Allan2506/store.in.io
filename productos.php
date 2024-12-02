<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jugueteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['itemName'];
    $id_producto = $_POST['productId'];
    $proveedor = $_POST['supplier'];
    $precio = $_POST['price'];
    $cantidad = $_POST['quantity'];
    $descripcion = $_POST['description'];
    $id_categoria = $_POST['category'];

    $sql = "INSERT INTO productos (id_producto, nombre, descripcion, precio, stock, id_categoria, id_proveedor) 
            VALUES ('$id_producto', '$nombre', '$descripcion', '$precio', '$cantidad', '$id_categoria', '$proveedor')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
