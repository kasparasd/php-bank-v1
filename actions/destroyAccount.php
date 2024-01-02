<?php
session_start();
$accounts = file_get_contents(__DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$userId = false;

foreach ($accounts as $id => $account) {
    if($account['id']==$_GET['id']){
        $userId=$id;
        break;
    }
}
if ($userId === false) {
    header('Location: http://localhost/php-bank-v1/views/accounts.php');
    exit();
}

if($accounts[$userId]['balance']){
    $_SESSION['error'] = 'You can\'t delete this account. Account must be empty.';
    header('Location: http://localhost/php-bank-v1/views/accounts.php');
    exit();
}

unset($accounts[$userId]);

file_put_contents(__DIR__ . '/.././data/accounts.ser', serialize($accounts));

$_SESSION['success']='Account deleted';

header('Location: http://localhost/php-bank-v1/views/accounts.php');