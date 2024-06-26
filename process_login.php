<?php
$servername = "localhost";
$username = "users"; // Asegúrate de que este sea el nombre de usuario correcto de tu DB.
$password = "tu_contraseña"; // La contraseña de tu base de datos.
$dbname = "tu_nombre_de_base_de_datos"; // El nombre de tu base de datos.

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

// Verificar si el email existe y obtener la contraseña hash
$sql = "SELECT password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Login exitoso
        header('Location: welcome.html'); // Redirige al usuario a una página de bienvenida
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

$conn->close();
?>
