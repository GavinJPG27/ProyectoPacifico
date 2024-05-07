<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reserva tu habitacion</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/estiloroom.css"> 
</head>
<body>
    <header>
        <nav class="navbr">
            <h1><a href="../otherpages/index.html">Hotel el Pacifico</a></h1>
        </nav>
    </header>
    <div class="reservation-form">
        <h2>Reserva tu habitación</h2>
        <form id="reservationForm" method="post">
            <div class="form-group">
                <label for="checkInDate">Check-in Date:</label>
                <input type="date" id="checkInDate" name="checkInDate">
                <label for="checkInDate">Check-Out Date:</label>
                <input type="date" id="checkOut" name="checkOutDate">
            </div>
            <div class="form-group">
                <label for="roomType">Room Type:</label>
                <select id="roomType" name="roomType">
                    <option value="">Select Room Type</option>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
            <button name="checkava" type="submit" class="button">Check Availability</button>
            <button name="allrooms" type="submit" class="button">See all rooms</button>
        </form>
        <div class="availability">
            <h1>ROOMS</h1>

            <?php
                include("conexion.php");
                session_start();

                $conexion = connection();

                if(isset($_POST["checkava"])){
                    // Procesar formulario para ver la disponibilidad de las habitaciones
                    $checkInDate = $_POST["checkInDate"];
                    $checkOutDate = $_POST["checkOutDate"];
                    $roomType = $_POST["roomType"];

                    $sql = "SELECT * FROM `Habitacion` WHERE tipo = '$roomType' AND disponibilidad = 'disponible'";
                    $result = mysqli_query($conexion, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table class='tabla'>";
                            echo "<tr><th>Room Name</th><th>Room Type</th><th>Room Price</th><th>Room Availability</th><th>Number of persons</th><th>Reservate</th></tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["nombre"] . "</td>";
                                echo "<td>" . $row["tipo"] . "</td>";
                                echo "<td>" . $row["precio"] . "</td>";
                                echo "<td>" . $row["disponibilidad"] . "</td>";
                                echo "<td>" . $row["numero_personas"] . "</td>";
                                echo "<td class='tdbutton'><div class='button-container'><form action='../otherpages/Reservar.php' method='post'><input type='hidden' name='roomName' value='" . $row['nombre'] . "'><input type='hidden' name='roomPrice' value='" . $row['precio'] . "'><input type='hidden' name='roomType' value='" . $row['tipo'] . "'><input type='hidden' name='roomPersons' value='" . $row['numero_personas'] . "'><button class='button' type='submit' name='reservar'>Reservar</button></form></div></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No rooms found";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conexion); // Manejo de errores para la ejecución de la consulta
                    }
                } elseif(isset($_POST["allrooms"])) {
                    // Procesar formulario para ver todas las habitaciones
                    $sql = "SELECT * FROM `Habitacion`";
                    $result = mysqli_query($conexion, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table class='tabla'>";
                            echo "<tr><th>Room Name</th><th>Room Type</th><th>Room Price</th><th>Room Availability</th><th>Number of persons</th><th>Reservate</th></tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["nombre"] . "</td>";
                                echo "<td>" . $row["tipo"] . "</td>";
                                echo "<td>" . $row["precio"] . "</td>";
                                echo "<td>" . $row["disponibilidad"] . "</td>";
                                echo "<td>" . $row["numero_personas"] . "</td>";
                                // Check if room is available
                                if ($row["disponibilidad"] == "disponible") {
                                    echo "<td class='tdbutton'><div class='button-container'><form action='../otherpages/Reservar.php' method='post'><input type='hidden' name='roomName' value='" . $row['nombre'] . "'><input type='hidden' name='roomPrice' value='" . $row['precio'] . "'><input type='hidden' name='roomType' value='" . $row['tipo'] . "'><input type='hidden' name='roomPersons' value='" . $row['numero_personas'] . "'><button class='button' type='submit' name='reservar'>Reservar</button></form></div></td>";
                                } else {
                                    echo "<td>Reservada</td>"; // Empty cell if room is not available
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No rooms found";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conexion); // Manejo de errores para la ejecución de la consulta
                    }
                }
                mysqli_close($conexion);
            ?>
        </div>
    </div>
</body>
</html>



