<?php session_start(); ?>


<html>
<body>
    <h1>Paso 4</h1>
    <h2>Gracias por su compra</h2>
    <p>
        <b>Monto:</b> <?php echo $_SESSION["purchase"]["amount"];?><br>
        <b>ID del pago:</b> <?php echo $_SESSION["purchase"]["id"];?><br>
        <b>Cuotas: </b> <?php echo $_SESSION["purchase"]["installments"];?><br>
    </p>
    <a href="form_cc_data.php">Probar con otra tarjeta de crédito</a>
</body>
</html>
