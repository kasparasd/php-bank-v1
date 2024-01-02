<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employees = file_get_contents(__DIR__ . '/.././data/employees.ser');
    $employees = unserialize($employees);

    foreach ($employees as $key => $employee) {
        if ($employee['email'] == $_POST['email'] && $employee['password'] == sha1($_POST['password'])) {
            $_SESSION['login'] = 1;
            $_SESSION['userLoggedIn'] = $employee;
            header('Location: http://localhost/php-bank-v1/views/accounts.php');
            exit();
        }
    }
    $_SESSION['error'] = 'Username or password is not correct.';
    header('Location: http://localhost/php-bank-v1/views/login.php');
    exit();
}