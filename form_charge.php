<?php session_start(); ?>

<html>
<body>
    <h1>Paso 3</h1>
    <h2>Consumir!!!!</h2>
    <form action="action_purchase.php" method="POST">
        Pagar:<br>
        $100.000<br>
        con la tarjeta <?php echo $_SESSION["user_cc"]["type"];?> **** <?php echo $_SESSION["user_cc"]["lastFour"];?>?<br>
        <input type="hidden" name="amount" value="100000">
        <input type="hidden" name="creditCard" value="<?php echo $_SESSION["user_cc"]["id"];?>">
        <br>
        <input type="submit" value="Submit">
    </form>
<br>
<br>
<br>
</body>
</html>
