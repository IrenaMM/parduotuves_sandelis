<?php
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($mail) || empty($password)) {
        $errors[] = 'Yra tusciu lauku';
    }

    $checkUser = mysqli_query($database, 'select * from darbuotojai where el_pastas = "' . $mail . '" and slaptazodis = "' . $password . '"');
    $checkUser = mysqli_fetch_row($checkUser);

    if ($checkUser == null) {
        $errors[] = 'Blogi prisijungimo duomenys';
    }

    if (empty($errors)) {
        $_SESSION['mail'] = $mail;
        header('Location: index.php');
    }
}
?>
<h1>Login</h1>
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
<form action="index.php?page=login" method="post">
    <table>
        <tr>
            <td>
                Paštas:
            </td>
            <td>
                <input type="text" name="mail" value="<?php echo $_GET['mail'] ?? null ?>">
            </td>
        </tr>
        <tr>
            <td>
                Slaptažodis:
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
    </table>
    <br/><br/>
    <button type="submit">Prisijungti</button>
</form>
