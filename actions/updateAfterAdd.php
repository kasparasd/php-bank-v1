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
echo $userId . '<br>';
if ($_POST['amount'] <= 0) {
    $_SESSION['error'] = 'You can\'t add 0 or negative amount';
    header('Location: http://localhost/php-bank-v1/views/addFunds.php?id=' . $_GET['id']);
    exit();
}


$accounts[$userId]['balance'] = (float)$accounts[$userId]['balance'] + (float)$_POST['amount'];
file_put_contents(__DIR__ . '/../data/accounts.ser', serialize($accounts));
$_SESSION['success'] = "You succesfully added € " . $_POST['amount'];
header('Location: http://localhost/php-bank-v1/views/addFunds.php?id=' . $_GET['id']);
