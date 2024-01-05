<?php
// error_reporting(~0);
// ini_set('display_errors', 1);
session_start();
// https://www.runa.lt/useful/asmens_kodas

$accounts = file_get_contents(__DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$userId = $accounts['userId'];

function validPersonalCode($code): bool
{
    // Tikriname, ar įvestas kodas yra skaičiai ir turi teisingą ilgį
    if (!is_numeric($code) || strlen($code) != 11) {
        return false;
    }

    // Išskiriame gimimo metus, mėnesį, dieną
    $metai = substr($code, 1, 2);
    $menuo = substr($code, 3, 2);
    $diena = substr($code, 5, 2);
    // Tikriname gimimo datos validumą
    if (!checkdate($menuo, $diena, $metai)) {
        return false;
    }

    // Tikriname paskutinį skaičių (kontrolinį)
    $kontrolinisSk = substr($code, -1);
    // 33908118566
    // Skaičiuojame kontrolinį skaičių
    $suma = 0;
    for ($i = 0; $i < 10; $i++) {
        $suma += $code[$i] * ($i % 9 + 1);
    }

    $liekana = $suma % 11;
    $liekana = ($liekana == 10) ? 0 : $liekana;

    // Patikriname, ar kontrolinis skaičius atitinka skaičių, gautą skaičiavimuose
    if ($liekana != $kontrolinisSk) {
        return false;
    }

    return true;
}


if ($_POST) {
    $_SESSION['newAccount'] = $_POST;
    $_SESSION['error'] = [];

    if (array_search($_POST['personalNumber'], array_column($accounts, 'personalCodeNumber'))) {
        $_SESSION['error'][] = 'Please check your personal code number. It\'s already registered in our system.';
    }
    if (!validPersonalCode($_POST['personalNumber'])) {
        $_SESSION['error'][] = 'Personal code is not correct';
    }
    if (strlen($_POST['name']) <= 3) {
        $_SESSION['error'][] = 'Name is too short. Minimum 3 symbols required.';
    }
    if (strlen($_POST['lastName']) <= 3) {
        $_SESSION['error'][] = 'Last name is too short. Minimum 3 symbols required.';
    }

    if ($_SESSION['error']) {
        header('Location: .././views/createNewAccount.php');
        exit();
    }

    if (!$_SESSION['error']) {
        $currentUserId = $_SESSION['currentUserId'] + 1;
        $newAccount = [
            'id' => $userId + 1,
            'name' => $_POST['name'],
            'lastName' => $_POST['lastName'],
            'accountNumber' => $_POST['bankAccountNumber'],
            'personalCodeNumber' => $_POST['personalNumber'],
            'balance' => 0,
        ];


        function addItem($newAccount)
        {
            $accountsAdd = file_get_contents(__DIR__ . '/../data/accounts.ser');
            $accountsAdd = unserialize($accountsAdd);
            $accountsAdd[] = $newAccount;
            $accountsAdd['userId'] += 1;

            file_put_contents(__DIR__ . '/../data/accounts.ser', serialize($accountsAdd));
        };
        addItem($newAccount);
        $_SESSION['accountCreated'] = 1;
        header('Location: .././views/createNewAccount.php');
        exit();
    }
}
