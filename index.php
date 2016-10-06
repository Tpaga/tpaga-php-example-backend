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
    <h1>Step 1</h1>
    <h2>Register yourself</h2>
    <form method="POST" action="customer_registration.php">
        First name:<br>
        <input type="text" name="firstName" value="Numa"><br>
        Last name:<br>
        <input type="text" name="lastName" value="Nigerio"><br>
        Gender:<br>
        <select name="gender">
          <option value="M">M</option>
          <option value="F">F</option>
          <option value="N/A">N/A</option>
        </select><br>
        Email:<br>
        <input type="text" name="email" value="pericodelospalotes@nowhere.org"><br>
        Phone:<br>
        <input type="text" name="phone" value="304567891"><br>
<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
