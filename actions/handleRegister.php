<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employees = file_get_contents(__DIR__ . '/.././data/employees.ser');
    $employees = unserialize($employees);

    $_SESSION['error'] = [];
    $_SESSION['email'] = $_POST['email'];

    foreach ($employees as $id => $employee) {
        if ($employee['email'] == $_POST['email']) {
            $_SESSION['error'][] = 'This email is already taken.';
        }
    }

    if ($_POST['password1'] !== $_POST['password2']) {
        $_SESSION['error'][] = 'Passwords do not match.';
    }

    if (strlen($_POST['password1']) < 8) {
        $_SESSION['error'][] = 'Password must be at least 8 characters long.';
    }

    if (count($_SESSION['error'])) {
        header('Location: http://localhost/php-bank-v1/views/register.php');
        exit;
    }


    $newEmployee = [
        'id' => (int) $employees['employeeId'] + 1,
        'email' => $_POST['email'],
        'password' => sha1($_POST['password1']),
    ];
    $employees['employeeId'] += 1;

    $employees[] = $newEmployee;
    file_put_contents(__DIR__ . '/.././data/employees.ser', serialize($employees));
    $_SESSION['success'] = "New employee registered: " . $newEmployee['email'];
    header('Location: http://localhost/php-bank-v1/views/login.php');
    exit;
}
header('Location: http://localhost/php-bank-v1/views/register.php');
