<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Verificar si el formulario fue enviado por POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "sql206.infinityfree.com";
$username = "if0_38917775";
$password = "DPtJJ4ovJmg6";
$dbname = "if0_38917775_basededatos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Recoger datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['mail'] ?? '';
    $telefono = $_POST['Num'] ?? '';
    $consulta = $_POST['consulta'] ?? '';

    // Insertar datos en la tabla
    $sql = "INSERT INTO consultas (nombre, apellido, correo, telefono, consulta) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $correo, $telefono, $consulta);

    if ($stmt->execute()) {
        echo "✅ Consulta guardada correctamente. Gracias por contactarnos.";
    } else {
        echo "❌ Error al guardar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "⚠️ Acceso no permitido. Este archivo solo debe usarse al enviar el formulario.";
}
?>
