<?php
echo "<h2>Sandėlio valdymas</h2>";

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $sql = 'insert into sandelio_produktai (produkto_id, likutis) value ("' . $_POST['id'] . '", "' . $_POST['quantity'] . '")';
    echo 'Sandėlio produktas sukurtas';
    mysqli_query($database, $sql);
}
$result = mysqli_query($database, 'select * from sandelio_produktai');
$sandelio_produktai = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result = mysqli_query($database, 'select * from produktai');
$produktai = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<hr>
<hr>
<!--//-->
<!--//    if (empty($name) || empty($quantity)) {-->
<!--//        $errors[] = 'Yra tusciu lauku';-->
<!--//    }-->
<!---->
<!--//    $checkUser = mysqli_query($database, 'select * from darbuotojai where el_pastas = "' . $name . '" and slaptazodis = "' . $quantity . '"');-->
<!--//    $checkUser = mysqli_fetch_row($checkUser);-->
<!---->
<!--//    if ($checkUser == null) {-->
<!--//        $errors[] = 'Blogi prisijungimo duomenys';-->
<!--//    }-->
<!---->
<!--    if (empty($errors)) {-->
<!--        $_SESSION['name'] = $name;-->
<!--        header('Location: index.php');-->
<!--    }-->
<!--}-->
<!--?>-->
<h4>Pridėti prekę į sandėlį</h4>

<form action="index.php?page=warehouse" method="post">
    <table>
        <tr>
            <td>
                Pasirinkite prekę:
            </td>
            <td>
                <select name="id">
                    <?php foreach ($produktai as $produktas) { ?>
                        <option value="<?php echo $produktas['id'] ?>"><?php echo $produktas['pavadinimas'] ?></option>
                    <?php } ?>
                </select><br/>
            </td>
        </tr>
        <tr>
            <td>
                Įveskite likutį:
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
        <th>Produkto_id</th>
        <th>Likutis</th>
        <th>Kategorija</th>
        <th>Pavadinimas</th>
        <th>Darbuotojas</th>
    </tr>
    <?php foreach ($sandelio_produktai as $sandelio_produktas) { ?>
        <tr>
            <td>
                <?php echo $sandelio_produktas['produkto_id'] ?>
            </td>
            <td>
                <?php echo $sandelio_produktas['likutis'] ?>
            </td>

    <?php } ?>
</table>
