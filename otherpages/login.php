<?php
include("conexion.php");
$conexion = connection();

session_start();

$nomUser =  $_POST["nom_user"]; 
$password = $_POST["password"];
$date = date("Y-m-d");

if (isset($_POST["login"])) {
    // Handle Login

    $sql = "SELECT * FROM `usuarios` WHERE `nom_user` = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nomUser);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row["password"]) {
                header("Location: ./adminpage.php");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    } else {
        echo "Error: " . mysqli_error($conexion); // Error handling for query execution
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
// } else if (isset($_POST["signup"])) {

//     // Handle Sign Up
//     $sql = "INSERT INTO `usuarios` (`id`, `nom_user`, `password`, `fecha_creacion`) VALUES (NULL, ?, ?, ?)";
//     $stmt = mysqli_prepare($conexion, $sql);
//     mysqli_stmt_bind_param($stmt, "sss", $nomUser, $password, $date);

//     if (mysqli_stmt_execute($stmt)) {
//         echo "User created successfully!";
//     } else {
//         echo "Error: " . mysqli_error($conexion); // Error handling for query execution
//     }

//     mysqli_stmt_close($stmt);
//     mysqli_close($conexion);

} else {
    // No button was clicked
    $message = "No action specified!";
}

include "login.html";
?>
