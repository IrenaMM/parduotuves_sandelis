<?php
echo "<h2>Pirkėjo krepšelis</h2>";

$action = $_GET['action'] ?? null;
if ($action == 'save_reservation') {
    $parduotuves_id = $_POST['parduotuves_id'];
}

?>

<hr>
<hr>
<?php

$result = mysqli_query($database, 'select * from parduotuves');
$parduotuves = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "select sp.likutis, p.pavadinimas, p.id from sandelio_produktai sp join produktai p where sp.produkto_id = p.id";
$result2 = mysqli_query($database, $sql); //objektas
$sandelysIrProduktai = mysqli_fetch_all($result2, MYSQLI_ASSOC); //pasidarau masyvą, nes noriu foreach'int.
//
//$sql = "select produktai.pavadinimas, produktai.kategorija, parduotuves_prekes.kaina, parduotuves_prekes.galioja_iki, parduotuves_prekes.kiekis, parduotuves_prekes.parduotuve_id from produktai join parduotuves_prekes on produktai.id = parduotuves_prekes.produkto_id";
//$result = mysqli_query($database, $sql);
//$warehouseproducts = mysqli_fetch_all($result, MYSQLI_ASSOC);
$result = mysqli_query($database, 'select * from parduotuves_prekes');
$parduotuves_prekes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php echo "<b>Pirkėjo krepšelis</b>" . '<br><br>'; ?>
<form action="index.php?page=customer?action=save_reservation" method="post">
    Pasirinkite parduotuvę:
    <select name="parduotuves_id">
        <?php foreach ($parduotuves as $parduotuve) { ?>
            <option value="<?php echo $parduotuve['id'] ?>"><?php echo $parduotuve['pavadinimas'] ?></option>
        <?php } ?>
    </select><br/>
    Pasirinkite prekę:
    <select name="parduotuves_prekes_id">
        <?php foreach ($parduotuves_prekes as $parduotuves_preke) { ?>
            <option value="<?php echo $parduotuves_preke['id'] ?>"><?php echo $parduotuves_preke['pavadinimas'] ?>(
                likutis sandėlyje: <?php echo $parduotuves_preke['likutis'] ?>)
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
<!--    --><?php //foreach ($warehouseproducts as $warehouseproduct) { ?>
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['pavadinimas'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['kategorija'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['kaina'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['galioja_iki'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['kiekis'] ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //echo $warehouseproduct['parduotuve_id'] ?>
<!--            </td>-->
<!--        </tr>-->
<!--    --><?php //} ?>
</table>