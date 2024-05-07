<?php
    include("conexion.php");
    session_start();

    $conexion = connection();

    // Handle user registration form submission
    if (isset($_POST["registerUser"])) {
        // Retrieve user data from the form
        $username = $_POST["username"];
        $password = $_POST["password"]; // You should hash the password for security

        // Insert the user data into the database
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conexion, $sql)) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }

    // Handle room registration form submission
    if (isset($_POST["registerRoom"])) {
        // Retrieve room data from the form
        $roomName = $_POST["roomName"];
        $roomType = $_POST["roomType"];
        $roomPrice = $_POST["roomPrice"];
        $roomAvailability = $_POST["roomAvailability"];
        $roomPersons = $_POST["roomPersons"];

        // Insert the room data into the database
        $sql = "INSERT INTO habitacion (nombre, tipo, precio, disponibilidad, numero_personas) VALUES ('$roomName', '$roomType', '$roomPrice', '$roomAvailability', '$roomPersons')";
        if (mysqli_query($conexion, $sql)) {
            echo "Room registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/adminestilo.css">
    <title>Admin Page</title>
</head>
<body>
    <header>
        <nav class="navbr">
            <h1><a href="../otherpages/index.html">Hotel el Pacifico</a></h1>
            <ul>
                <li>■</li>
                <li>■</li>
                <li>■</li>
            </ul>
        </nav>
    </header>

    <div class="admin-form">
        <h2>Panel de Administrador</h2>

        <h3>Registrar Usuario</h3>
        <form method="post">
            <div>
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username">
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit" name="registerUser">Registrar Usuario</button>
        </form>

        <h3>Registrar una habitacion</h3>
        <form method="post">
            <div>
                <label for="roomName">Nombre de Habitacion:</label>
                <input type="text" id="roomName" name="roomName">
            </div>
            <div>
            <label for="roomType">Tipo de Habitacion:</label>
                <select id="roomType" name="roomType">
                    <option value="">Select Room Type</option>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
            <div>
                <label for="roomPrice">Precio de Habitacion:</label>
                <input type="text" id="roomPrice" name="roomPrice">
            </div>
            <div>
                <label for="roomAvailability">Disponibilidad:</label>
                <input type="text" id="roomAvailability" name="roomAvailability">
            </div>
            <div>
                <label for="roomPersons">Numero de personas:</label>
                <input type="text" id="roomPersons" name="roomPersons">
            </div>
            <button type="submit" name="registerRoom">Registrar Habitacion</button>
        </form>
    </div>
</body>
</html>
