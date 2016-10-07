<?php session_start(); ?>


<html>
<body>
    <h1>Paso 4</h1>
    <h2>Gracias por su compra</h2>
    <p>
        <b>Monto:</b> <?php echo $_SESSION["purchase"]["amount"];?><br>
        <b>ID del pago:</b> <?php echo $_SESSION["purchase"]["id"];?><br>
    </p>
</body>
</html>
