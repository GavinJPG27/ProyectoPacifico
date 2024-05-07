<?php
    include("conexion.php");
    session_start();

    $conexion = connection();

    if(isset($_POST['roomName']) && isset($_POST['roomType']) && isset($_POST['roomPrice']) && isset($_POST['roomPersons'])) {
        $selectedRoomName = $_POST['roomName'];
        $selectedRoomType = $_POST['roomType'];
        $selectedRoomPrice = $_POST['roomPrice'];
        $selectedRoomNumPeople = $_POST['roomPersons'];
        
        // You can also store them in session for future use
        $_SESSION['roomName'] = $selectedRoomName;
        $_SESSION['roomType'] = $selectedRoomType;
        $_SESSION['roomPrice'] = $selectedRoomPrice;
        $_SESSION['roomPersons'] = $selectedRoomNumPeople;
    } else {
        header("Location: ../otherpages/index.html");
        exit();
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/ReservarEstilo.css"> 
</head>
<body>
    <header>
        <nav class="navbr">
            <h1><a href="../otherpages/index.html">Hotel el Pacifico</a></h1>
        </nav>
    </header>

    <div class="reservation-form">
        <h2>Payment</h2>
        <div class="availability">
            <h1>ROOMS</h1>

            <?php
                // Displaying the selected room details
                echo "<p>Tu has seleccionado: $selectedRoomName ($selectedRoomType) for $selectedRoomPrice.</p>";
                echo "<p>Pago Realizado!</p>";
                echo "<p>Gracias por reservar en el Hotel el Pacifico.</p>";
            ?>
            <div id="paypal-button-container"></div>
            <a class="btn btn-success mt-3" target="_blank" href="../fpdf/PruebaV.php" >Generar Recibo</a> <!-- Add a button to generate receipt -->
        </div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=AeYsvjgof6x8SI4n-sFQfDmRUapzzDaxcJ2CKEGF32liw4j9McQoJJ_pppgCRpPOIR0EtNhJh84om3JU"></script>
    <script>
        // Render the PayPal button
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $selectedRoomPrice; ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Redirect to a success page or perform any other action
                    window.location.href = "success.php";
                });
            }
        }).render('#paypal-button-container');

        // Add event listener for the generate receipt button
        /*document.getElementById("generateReceipt").addEventListener("click", function() {
            window.location.href = "generate_receipt.php";
        });*/
    </script>

</body>
</html>
