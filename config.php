<?php
echo "<h2>Parduotuvės sandėlis</h2>";

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

?>
