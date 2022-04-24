<?php
echo "<h2>Sandėlio valdymas</h2>";

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $produkto_id = $_POST['id'];
    $likutis = $_POST['quantity'] ?? 0;
    $sql = "select * from sandelio_produktai where produkto_id = $produkto_id";
    $sqlResult = mysqli_query($database, $sql);
    $row = mysqli_fetch_row($sqlResult);

    if ($row == null) {
        $sql = 'insert into sandelio_produktai (produkto_id, likutis) value ("' . $_POST['id'] . '", "' . $_POST['quantity'] . '")';
        echo 'Sandėlio produktas sukurtas';
        mysqli_query($database, $sql);
    } else {
        $sql = "update sandelio_produktai set likutis = likutis + $likutis where produkto_id = $produkto_id";
        mysqli_query($database, $sql);
    }
}

$result = mysqli_query($database, 'select * from produktai');
$produktai = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "select produktai.pavadinimas, produktai.galiojimo_dienos, produktai.kategorija, produktai.id, produktai.kaina, sandelio_produktai.likutis from sandelio_produktai
        join produktai on produktai.id = sandelio_produktai.produkto_id";
$result = mysqli_query($database, $sql);
$warehouseproducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<hr>
<hr>

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
        <th>Pavadinimas</th>
        <th>Kategorija</th>
        <th>Kaina</th>
        <th>Likutis</th>
        <th>Galiojimo dienos</th>
    </tr>
    <?php foreach ($warehouseproducts as $warehouseproduct) { ?>
        <tr>
            <td>
                <?php echo $warehouseproduct['id'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['pavadinimas'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['kategorija'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['kaina'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['likutis'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['galiojimo_dienos'] ?>
            </td>
            </td>
        </tr>
    <?php } ?>
</table>
