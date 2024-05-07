<?php

function connection(){
    
    $dbhost = "localhost";
    $dbname = "hoteldb";
    $dbuser = "root";
    $dbpass = "";

    $conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Problems with the connection: " . mysqli_connect_error());
    

    return $conexion;

}
?>