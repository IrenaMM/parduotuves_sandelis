<?php
include_once 'config.php';

?>
<hr>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prekių valdymo sistema</title>
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
        <?php if (isLoged() === false) { ?>
            <td>
                <a href="index.php?page=login">Prisijungti darbuotojui</a>
            </td>
            <td>
                <a href="index.php?page=register">Registruotis į darbuotojų lentelę</a>
            </td>
            <td>
                <a href="index.php?page=customer">Pirkėjai</a>
            </td>
        <?php } else { ?>
            <?php
            switch (getUser($database, $_SESSION['mail'])[1]) {
                case 'sandelio_darbuotojas';
                    ?>
                    <td>
                        <a href="index.php?page=warehouse">Sandėlio produktai</a>
                    </td>
                    <td>
                        <a href="index.php?page=products">Produktai</a>
                    </td>

                    <?php
                    break;
                case 'parduotuves_darbuotojas';
                    ?>
                    <td>
                        <a href="index.php?page=shop">Parduotuves</a>
                    </td>
                    <td>
                        <a href="index.php?page=shop_products">Parduotuvės prekės</a>
                    </td>
                    <?php break;
            } ?>
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
} elseif ($page === 'products') {
    include 'pages/products.php';
} elseif ($page === 'shop') {
    include 'pages/shop.php';
} elseif ($page === 'shop_products') {
    include 'pages/shop_products.php';
}elseif ($page === 'customer') {
    include 'pages/customer.php';
}
?>

<br/><br/>
<?php
echo date('Y-m-d H:i:s');
?>
</body>
</html>

