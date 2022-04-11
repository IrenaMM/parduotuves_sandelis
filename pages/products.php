<?php
echo "<h2>Produktai</h2>";
if (isset($_POST['category']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['valid'])) {
    $sql = 'insert into produktai (kategorija, pavadinimas, kaina, galiojimo_dienos) value ("' . $_POST['category'] . '", "' . $_POST['name'] . '", "' . $_POST['price'] . '", "' . $_POST['valid'] . '")';
    echo 'Produktas sukurtas';
    mysqli_query($database, $sql);
}
$result = mysqli_query($database, 'select * from produktai');
$produktai = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<hr>
<hr>

<?php echo "<b>Pridėti produktą</b>" . '<br><br>'; ?>
<form action="index.php?page=products" method="post">
    Kategorija: <input type="text" name="category"><br/>
    Pavadinimas: <input type="text" name="name"><br/>
    Kaina: <input type="number" name="price"><br/>
    Galiojimo dienos: <input type="number" name="valid"><br/>
    <br/>
    <button type="submit">Issaugoti</button>
</form>
<hr>
<hr>


<table>
    <?php echo "<b>Produktai</b>" . '<br><br>'; ?>
    <tr>
        <th>Pavadinimas</th>
        <th>Kategorija</th>
        <th>Kaina</th>
        <th>Galiojimo dienos</th>
    </tr>
    <?php foreach ($produktai as $produkta) { ?>
        <tr>
            <td>
                <?php echo $produkta['pavadinimas'] ?>
            </td>
            <td>
                <?php echo $produkta['kategorija'] ?>
            </td>
            <td>
                <?php echo $produkta['kaina'] ?>
            </td>
            <td>
                <?php echo $produkta['galiojimo_dienos'] ?>
            </td>
            <!--            <td>-->
            <!--                --><?php //echo $darbuotoja['employee_id'] ?>
            <!--            </td>-->
        </tr>
    <?php } ?>
</table>