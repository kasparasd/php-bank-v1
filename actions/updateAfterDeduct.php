<?php 
session_start();
$accounts = file_get_contents( __DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$userId = array_search($_GET['id'], array_column($accounts, 'id'));
$userDetails = $accounts[$userId];

if( (float) $userDetails['balance']< (float) $_POST['amount']){
    $_SESSION['error'] = 'Not enough money in bank.';
} else if ((float) $_POST['amount'] <=0){
    $_SESSION['error'] = 'You can\'t withdraw 0 or negative amount';
}
else {
    $userDetails['balance'] = (float) $userDetails['balance'] - (float) $_POST['amount'];
    $accounts[$userId] = $userDetails;
    $_SESSION['success'] = "You succesfully withdrawed € " . $_POST['amount'];
    file_put_contents(__DIR__ . '/../data/accounts.ser', serialize($accounts));
}
header("Location: http://localhost/php-bank-v1/views/deductFunds.php?id=".$_GET['id']);