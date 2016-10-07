<?php session_start(); ?>


<html>
<body>
    <h1>Paso 4</h1>
    <h2>Pago no exitoso</h2>
    <p>
        <?php echo $_SESSION["purchase_failure_message"];?>
    </p>
    <a href="form_cc_data.php">Probar con otra tarjeta de crédito</a>
</body>
</html>
