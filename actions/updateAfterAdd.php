<?php
session_start();

print_r($_GET);
print_r($_POST);

$accounts = file_get_contents(__DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$userId = array_search($_GET['id'], array_column($accounts, 'id'));

if ($_POST['amount'] <= 0) {
    $_SESSION['error'] = 'You can\'t add 0 or negative amount';
    header('Location: http://localhost/php-bank-v1/views/addFunds.php?id=' . $_GET['id']);
    exit();
}


$accounts[$userId]['balance'] = (float)$accounts[$userId]['balance'] + (float)$_POST['amount'];

file_put_contents(__DIR__ . '/../data/accounts.ser', serialize($accounts));
$_SESSION['success'] = "You succesfully added € " . $_POST['amount'];
header('Location: http://localhost/php-bank-v1/views/addFunds.php?id=' . $_GET['id']);
