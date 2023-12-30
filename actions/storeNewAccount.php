<?php
// error_reporting(~0);
// ini_set('display_errors', 1);
session_start();

$accounts = file_get_contents(__DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$userId = $accounts['userId'];

if ($_POST) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['personalCodeNumber'] = $_POST['personalNumber'];
    $_SESSION['error'] = [];

    if (array_search($_POST['personalNumber'], array_column($accounts, 'personalCodeNumber'))) {
        $_SESSION['error'][] = 'Please check your personal code number. It\'s already registered in our system.';
    }
    if (strlen($_POST['name']) <= 3) {
        $_SESSION['error'][] = 'Name is too short. Minimum 3 symbols required.';
    }
    if (strlen($_POST['lastName']) <= 3) {
        $_SESSION['error'][] = 'Last name is too short. Minimum 3 symbols required.';
    }
 
    if($_SESSION['error']){
        header('Location: .././views/createNewAccount.php');
        exit();
    }

    if (!$_SESSION['error']) {
        $currentUserId = $_SESSION['currentUserId'] + 1;
        $newAccount = [
            'id' => $userId+1,
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
            $accountsAdd['userId'] +=1;

            file_put_contents(__DIR__ . '/../data/accounts.ser', serialize($accountsAdd));
        };
        addItem($newAccount);
        unset($_SESSION['name']);
        unset($_SESSION['lastName']);
        unset($_SESSION['personalCodeNumber']);
        $_SESSION['accountCreated'] = $userId+1;
        header('Location: .././views/createNewAccount.php');
        exit();
        
    }
}
?>