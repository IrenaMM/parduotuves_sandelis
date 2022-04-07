<?php
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

<?php echo "<b>Produktai</b>" . '<br><br>'; ?>
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
    <tr>
        <th>Pareigos</th>
        <th>Vardas</th>
        <th>El. paštas</th>
        <th>Slaptažodis</th>
    </tr>
    <?php foreach ($darbuotojai as $darbuotoja) { ?>
        <tr>
            <td>
                <?php echo $darbuotoja['pareigybe'] ?>
            </td>
            <td>
                <?php echo $darbuotoja['vardas'] ?>
            </td>
            <td>
                <?php echo $darbuotoja['el_pastas'] ?>
            </td>
            <td>
                <?php echo $darbuotoja['slaptazodis'] ?>
            </td>
            <!--            <td>-->
            <!--                --><?php //echo $darbuotoja['employee_id'] ?>
            <!--            </td>-->
        </tr>
    <?php } ?>
</table>