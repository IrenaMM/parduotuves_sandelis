<?php
echo "<h2>Parduotuvės</h2>";

if (isset($_POST['shop_name']) && isset($_POST['address'])) {
    $sql = 'insert into parduotuves (pavadinimas, adresas) value ("' . $_POST['shop_name'] . '", "' . $_POST['address'] . '")';
//    echo 'Parduotuvė sukurta';
     mysqli_query($database, $sql);
}
$result = mysqli_query($database, 'select * from parduotuves');
$parduotuves = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<hr>
<hr>

<?php echo "<b>Pridėti parduotuvę</b>" . '<br><br>'; ?>
<form action="index.php?page=shop" method="post">
    Parduotuvės pavadinimas: <input type="text" name="shop_name"><br/>
    Adresas: <input type="text" name="address"><br/>
    <br/>
    <button type="submit">Išsaugoti</button>
</form>
<hr>
<hr>


<table>
    <?php echo "<b>Parduotuvės</b>" . '<br><br>'; ?>
    <tr>
        <th>Pavadinimas</th>
        <th>Adresas</th>
    </tr>
    <?php foreach ($parduotuves as $parduotuve) { ?>
        <tr>
            <td>
                <?php echo $parduotuve['id'] ?>
            </td>
            <td>
                <?php echo $parduotuve['pavadinimas'] ?>
            </td>
            <td>
                <?php echo $parduotuve['adresas'] ?>
            </td>
        </tr>
    <?php } ?>
</table>
