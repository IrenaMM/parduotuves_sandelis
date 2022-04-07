<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    $errors = [];
//
//    if (empty($name) || empty($quantity)) {
//        $errors[] = 'Yra tusciu lauku';
//    }

//    $checkUser = mysqli_query($database, 'select * from darbuotojai where el_pastas = "' . $name . '" and slaptazodis = "' . $quantity . '"');
//    $checkUser = mysqli_fetch_row($checkUser);

//    if ($checkUser == null) {
//        $errors[] = 'Blogi prisijungimo duomenys';
//    }

    if (empty($errors)) {
        $_SESSION['name'] = $name;
        header('Location: index.php');
    }
}
?>
<h1>Sandėlio prekės</h1>
<ul>
    <?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            ?>
            <li>
                <?php echo $error ?>
            </li>
        <?php }
    } ?>
</ul>
<form action="index.php?page=warehouse" method="post">
    <table>
        <tr>
            <td>
                Prekė:
            </td>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <td>
                Likutis:
            </td>
            <td>
                <input type="number" name="quantity">
            </td>
        </tr>
    </table>
    <br/><br/>
    <button type="submit">Žiūrėti prekės likutį</button>
</form>

<table>
    <tr>
        <th>Kategorija</th>
        <th>Pavadinimas</th>
        <th>Vardas</th>
        <th>Paslauga</th>
        <th>Darbuotojas</th>
    </tr>
    <?php foreach ($name as $nam) { ?>
        <tr>
            <td>
                <?php echo $nam['produkto_id'] ?>
            </td>
            <td>
                <?php echo $nam['likutis'] ?>
            </td>
<!--            <td>-->
<!--                --><?php //echo $nam['client_name'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $nam['service_id'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $nam['employee_id'] ?>
<!--            </td>-->
        </tr>
    <?php } ?>
</table>