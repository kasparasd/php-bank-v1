<?php session_start(); 
if (isset($_SESSION['userLoggedIn']) && $_SESSION['login']==1) {
  header('Location: http://localhost/php-bank-v1/views/accounts.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank</title>
  <script src="../app.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
  <?php
  if (file_exists(__DIR__ . '/navBar.php')) {
    require __DIR__ . '/navBar.php';
  }
  ?>

</body>

</html>