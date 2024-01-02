<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
}

if (isset($_SESSION['userLoggedIn']) && $_SESSION['login'] == 1) {
    unset($_SESSION['login']);
    unset($_SESSION['userLoggedIn']);
}
header('Location: http://localhost/php-bank-v1/views/');
exit;
