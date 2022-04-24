<?php
echo "<h2>Prekių valdymo sistema</h2>";

session_start();

$database = mysqli_connect('localhost', 'root', '', 'parduotuves');
//
//if (!$database) {
//    die("Connection failed: " . mysqli_connect_error());
//} else {
//    echo 'Pavyko prisijungti' . '<hr>';
//}

$page = $_REQUEST['page'] ?? null;
function isLoged(): bool
{
    if (isset($_SESSION['mail'])) {
        return true;
    } else {
        return false;
    }
}
function getUser($database, $mail) {
    $user = mysqli_query($database, 'select * from darbuotojai where el_pastas = "' . $mail . '"');
    $user = mysqli_fetch_row($user);
    return $user;
}

/**
* prisijungimas
* registracija su rolemis (sandelio darbuotojas, parduotuves darbuotojas)
*
* //sandelio darbuotojas
* prekiu kategorijos (duona, pieno produktai, kaceliarija ... )
* prekiu valdymas (prideti, atnaujinti, istrinti) - prekės yra priskirtos prie parduotuvės
* sandėlis - jame saugomos visos prekiu sarasas ir yra maksimalus vienetu skaicius
*
* parduotuviu uzsakymai is sandelio (sandelio istorija)
*
* //parduotuves darbuotojas
* parduotuviu valdymas (prideti, atnaujinti, istrinti) (bendra marzas, papildomos marzos pagal kategorijas arba akcijos)
* parduotuves prekiu informacija (galiojimo laikas, kiekis/vienetai, kaina
* prekes kurias reikejo ismesti (kuriu galiojimas baigiasi) parduotuve
*
* pirkejas ir jo krepselis(kur ir ka pirko ir kiek sumokejo)
*
* statistika (kiek parduotuves uzdirbo, kokios prekes populiariausios)
*/
?>