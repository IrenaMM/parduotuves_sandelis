<?php
echo "<h2>Prekių papildymas į parduotuves</h2>";

if (isset($_POST['parduotuves_id']) && isset($_POST['kiekis']) && isset($_POST['sandelio_produkto_id'])) {
    $product_id = $_POST['sandelio_produkto_id'];
    $shop_id = $_POST['parduotuves_id'];
    $kiekis = $_POST['kiekis'];

    $sqlForMargin = "select * from parduotuves_marzos where parduotuves_id = $shop_id";
    $resultForMargin = mysqli_query($database, $sqlForMargin);
    $margins = mysqli_fetch_all($resultForMargin, MYSQLI_ASSOC);

    $sql = "select * from produktai where id = $product_id";
    $result = mysqli_query($database, $sql);
    $produktai = mysqli_fetch_row($result);

    $price = $produktai[3];
    $category = $produktai[1];

    foreach ($margins as $margin) {
        if ($category == 'Vaisiai' and $margin['tipas'] == 'vaisiu') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
            break;
        } elseif ($category == 'Pieno produktai' and $margin['tipas'] == 'pieno') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
            break;
        } elseif ($margin['tipas'] == 'bendras') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
        }
    }
    $dateToday = date('Y-m-d');
    $dateSql = "select * from parduotuves_prekes where galioja_iki = '$dateToday'";

    $galiojaIki = date('Y-m-d', strtotime('+ ' . $produktai[4] . ' days'));
    if ($dateToday == $galiojaIki) {
        $result['tipas'] == 'baigiasi galiojimas';
    }
//    $sql = "select pp.kaina, pm.marza from parduotuves_prekes pp join parduotuves_marzos pm on pp.parduotuve_id = pm.parduotuves_id where pp.galioja_iki = '$dateToday' and pp.utilizuota = 0";
//    $result5 = mysqli_query($database, $sql);
//

    if ($produktai == null) {
        $sql = 'insert into parduotuves_prekes (parduotuve_id, produkto_id, kiekis, kaina, galioja_iki) value ("' . $_POST['parduotuves_id'] . '", "' . $_POST['sandelio_produkto_id'] . '", "' . $_POST['kiekis'] . '", "' . $price . '", "' . $galiojaIki . '")';
        echo 'Prekė iš sandėlio pridėta į parduotuvę';
        mysqli_query($database, $sql);
    } else {
        $sql = "update parduotuves_prekes set kiekis = kiekis + $kiekis where produkto_id = $product_id and parduotuve_id = $shop_id";
        mysqli_query($database, $sql);
    }

//    $sql = 'insert into parduotuves_prekes (parduotuve_id, produkto_id, kiekis, kaina, galioja_iki) value ("' . $_POST['parduotuves_id'] . '", "' . $_POST['sandelio_produkto_id'] . '", "' . $_POST['kiekis'] . '", "' . $price . '", "' . $galiojaIki . '")';
//    echo 'Prekė iš sandėlio pridėta į parduotuvę';
//    mysqli_query($database, $sql);

    $sql = "update sandelio_produktai set likutis = likutis - $kiekis where produkto_id = '$product_id'";
    mysqli_query($database, $sql);


}

$result = mysqli_query($database, 'select * from sandelio_produktai');
$sandelio_produktai = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result = mysqli_query($database, 'select * from parduotuves');
$parduotuves = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "select produktai.pavadinimas, produktai.kategorija, parduotuves_prekes.kaina, parduotuves_prekes.galioja_iki, parduotuves_prekes.kiekis, parduotuves_prekes.parduotuve_id from produktai join parduotuves_prekes on produktai.id = parduotuves_prekes.produkto_id";
$result = mysqli_query($database, $sql);
$warehouseproducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "select sp.likutis, p.pavadinimas, p.id from sandelio_produktai sp join produktai p where sp.produkto_id = p.id";
$result2 = mysqli_query($database, $sql); //objektas
$sandelysIrProduktai = mysqli_fetch_all($result2, MYSQLI_ASSOC); //pasidarau masyvą, nes noriu foreach'int.

?>
<hr>
<hr>
<?php echo "<b>Pridėti prekes iš sandėlio į parduotuvę</b>" . '<br><br>'; ?>
<form action="index.php?page=shop_products" method="post">
    Pasirinkite parduotuvę:
    <select name="parduotuves_id">
        <?php foreach ($parduotuves as $parduotuve) { ?>
            <option value="<?php echo $parduotuve['id'] ?>"><?php echo $parduotuve['pavadinimas'] ?></option>
        <?php } ?>
    </select><br/>
    Pasirinkite prekę:
    <select name="sandelio_produkto_id">
        <?php foreach ($sandelysIrProduktai as $sandelysIrProduktas) { ?>
            <option value="<?php echo $sandelysIrProduktas['id'] ?>"><?php echo $sandelysIrProduktas['pavadinimas'] ?>(
                likutis sandėlyje: <?php echo $sandelysIrProduktas['likutis'] ?>)
            </option>
        <?php } ?>
    </select><br/>
    Įvesti kiekį:
    <input type="number" name="kiekis"><br/>
    <br/>
    <button type="submit">Pridėti</button>
</form>
<hr>
<hr>


<table>
    <tr>
        <th>Prekė</th>
        <th>Kategorija</th>
        <th>Kaina</th>
        <th>Galiojimo dienos</th>
        <th>Kiekis parduotuvėje</th>
        <th>Parduotuvė</th>
    </tr>
    <?php foreach ($warehouseproducts as $warehouseproduct) { ?>
        <tr>
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
                <?php echo $warehouseproduct['galioja_iki'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['kiekis'] ?>
            </td>
            <td>
                <?php echo $warehouseproduct['parduotuve_id'] ?>
            </td>
        </tr>
    <?php } ?>
</table>