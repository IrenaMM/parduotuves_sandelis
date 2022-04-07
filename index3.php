<?php

echo "<h2>Parduotuvės</h2>";
$database = mysqli_connect('localhost', 'root', '', 'parduotuves');

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo 'Pavyko prisijungti' . '<hr>';
}
?>

<hr>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
</head>
<body>
<style>
    table {
        padding: 10px;
    }

    td {
        padding: 10px;
    }
</style>

<table>
    <tr>
        <td>
            <a href="index3.php">Home</a>
        </td>
        <td>
            <a href="index3.php?page=parduotuves">Parduotuves</a>
        </td>
        <td>
            <a href="index3.php?page=Logout2">Atsijungti</a>
        </td>
        <td>
            <a href="index3.php?page=login2">Prisijungti</a>
        </td>
<!--        --><?php //if (isLoged() === false) { ?>
<!--            <td>-->
<!--                <a href="index3.php?page=login">Login</a>-->
<!--            </td>-->
<!--            <td>-->
<!--                <a href="index3.php.php?page=register">Register</a>-->
<!--            </td>-->
<!---->
<!--        --><?php //} ?>
<!--        --><?php //if (isLoged() === true) { ?>
<!--            <td>-->
<!--                <a href="index3.php?page=settings">Nustatymai</a>-->
<!--            </td>-->
<!--            <td>-->
<!--                <a href="index3.php?page=logout">Atsijungti</a>-->
<!--            </td>-->
<!--        --><?php //} ?>
    </tr>
</table>


<?php
if (isset($_POST['employee']) && isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['password'])) {
$sql = 'insert into darbuotojai (pareigybe, vardas, el_pastas, slaptazodis) value ("' . $_POST['employee'] . '", "' . $_POST['name'] . '", "' . $_POST['mail'] . '", "' . $_POST['password'] . '")';
var_dump($sql);
mysqli_query($database, $sql);
}
$result = mysqli_query($database, 'select * from darbuotojai');
$darbuotojai = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<?php echo "<b>Prisijungimas</b>" . '<br><br>'; ?>
<form action="index3.php" method="post">
    El. paštas: <input type="text" name="mail"><br/>
    Slaptažodis: <input type="text" name="password"><br/>
    <br/>
    <button type="submit">Prisijungti</button>
</form>
<hr>
<hr>

<?php echo "<b>Registracija / Darbuotojai</b>" . '<br><br>'; ?>
<form action="index3.php" method="post">
    Pareigybė: <input type="text" name="employee"><br/>
    Vardas: <input type="text" name="name"><br/>
    El. paštas: <input type="text" name="mail"><br/>
    Slaptažodis: <input type="text" name="password"><br/>
    <br/>
    <button type="submit">Issaugoti</button>
</form>
<hr>
<hr>
