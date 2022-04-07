<?php

if (isset($_POST['employee']) && isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['password'])) {
    $sql = 'insert into darbuotojai (pareigybe, vardas, el_pastas, slaptazodis) value ("' . $_POST['employee'] . '", "' . $_POST['name'] . '", "' . $_POST['mail'] . '", "' . $_POST['password'] . '")';
    echo 'Darbuotojas sukurtas';
    mysqli_query($database, $sql);
}
$result = mysqli_query($database, 'select * from darbuotojai');
$darbuotojai = mysqli_fetch_all($result, MYSQLI_ASSOC);


if (isset($_POST['mail'])) {
    $employee = $_POST['employee'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $errors = [];

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        if (!'insert into darbuotojai mail') {
            $errors['email'][] = 'Neteisingas el. pastas';
        }
        if ($mail == $password) {
            $errors['password'][] = 'slaptazodis ir emailas negali buti vienodi';
        }
        $checkEmail = mysqli_query($database, 'select * from darbuotojai where el_pastas = "' . $mail . '"');
        $checkEmail = mysqli_fetch_row($checkEmail);
        if ($checkEmail != null) {
            $errors['mail'][] = 'Pastas uzimtas';
        }
    }
}

$_SESSION['code'] = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
?>
<hr>
<hr>

<h1>Priregistruoti darbuotoją</h1>
<form action="index.php?page=register" method="post">
    <table>
        <tr>
            <td>
                Vardas:
            </td>
            <td>
                <input type="text" name="name" value="<?php echo $name ?? null ?>">
            </td>
            <td>
                <?php
                if (isset($errors['name'])) {
                    echo implode(',', $errors['name']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pareigos:
            </td>
            <td>
                <select name="employee">
                    <option value="">-</option>
                    <option value="Sandelio_darbuotojas"
                        <?php if (($employee ?? null) == 'Sandelio_darbuotojas') {
                            echo 'selected';
                        } ?>
                    > Sandelio darbuotojas
                    </option>
                    <option value="Parduotuves_darbuotojas"
                        <?php
                        if (($employee ?? null) == 'Parduotuves_darbuotojas') {
                            echo 'selected';
                        } ?>
                    > Parduotuves darbuotojas
                    </option>
                </select>
            </td>
            <td>
                <?php
                if (isset($errors['employee'])) {
                    echo implode(',', $errors['employee']);
                }
                ?>
            </td>
        </tr>
        <tr>
        <tr>
            <td>
                Paštas:
            </td>
            <td>
                <input type="text" name="mail" value="<?php echo $mail ?? null ?>">
            </td>
            <td>
                <?php
                if (isset($errors['mail'])) {
                    echo implode(',', $errors['mail']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Slaptažodis:
            </td>
            <td>
                <input type="password" name="password">
            </td>
            <td>
                <?php
                if (isset($errors['password'])) {
                    echo implode(',', $errors['password']);
                }
                ?>
            </td>
        </tr>
    </table>
    <button type="submit">Registruotis</button>
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
        </tr>
    <?php } ?>
</table>