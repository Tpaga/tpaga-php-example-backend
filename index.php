<?php
session_start();
?>

<html>
<body>
<?php
if ($_SESSION["error_msg"]) {
    echo "<h3>Errors</h3>";
    echo "<p>" . $_SESSION["error_msg"] . "</p>";
    $_SESSION["error_msg"] = null;
}
?>
    <h1>Paso 1</h1>
    <h2>Regístrate</h2>
    <form method="POST" action="action_customer_registration.php">
        Nombres:<br>
        <input type="text" name="firstName" value="Numa"><br>
        Apellidos:<br>
        <input type="text" name="lastName" value="Nigerio"><br>
        Sexo:<br>
        <select name="gender">
          <option value="M">M</option>
          <option value="F">F</option>
          <option value="N/A">N/A</option>
        </select><br>
        Correo electrónico:<br>
        <input type="text" name="email" value="pericodelospalotes@nowhere.org"><br>
        Número de teléfono:<br>
        <input type="text" name="phone" value="304567891"><br>
<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
