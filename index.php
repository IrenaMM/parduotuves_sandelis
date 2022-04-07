<?php
include_once 'config.php';

?>
<hr>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parduotuvės sandėlis</title>
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
            <a href="index.php">Home</a>
        </td>
        <td>
            <a href="index.php?page=parduotuves">Parduotuves</a>
        </td>
        <td>
            <a href="index.php?page=pirkejai">Pirkėjai</a>
        </td>
        <td>
            <a href="index.php?page=parduotuves_prekes">Parduotuvės prekės</a>
        </td>
        <?php if (isLoged() === false) { ?>
            <td>
                <a href="index.php?page=login">Prisijungti</a>
            </td>
            <td>
                <a href="index.php?page=register">Registracija</a>
            </td>

        <?php } else { ?>
        <td>
            <a href="index.php?page=sandelio_produktai">Sandėlio produktai</a>
        </td>
        <td>
            <a href="index.php?page=logout">Atsijungti</a>
        </td>
        <?php } ?>
    </tr>
</table>

<?php
if ($page === null) {
    include 'pages/home.php';
} elseif ($page === 'register') {
    include 'pages/registration.php';
} elseif ($page === 'warehouse') {
    include 'pages/warehouse.php';
} elseif ($page === 'login') {
    include 'pages/login.php';
} elseif ($page === 'logout') {
    include 'pages/logout.php';
}
?>

<br/><br/>
<?php
echo date('Y-m-d H:i:s');
?>
</body>
</html>

