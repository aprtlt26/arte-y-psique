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

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Verificar si el email ya existe
$sql = "SELECT id FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Este correo electrónico ya está registrado.";
} else {
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header('Location: success.html'); // Redirige a una página de éxito.
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
