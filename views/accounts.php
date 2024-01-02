<?php session_start();
if(!isset($_SESSION['userLoggedIn']) && $_SESSION['login']!=1){
  header('Location: http://localhost/php-bank-v1/views/');
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
  <style>
    .closeBtn {
      background: none;
      border: none;
      font-size: 20px;
      color: red;
    }
  </style>
</head>

<body>
  <?php
  if (file_exists(__DIR__ . '/navBar.php')) {
    require __DIR__ . '/navBar.php';
  }
  ?>
  <?php if ($_SESSION['error']) : ?>
    <div class="container mt-5 infoAlert">
      <div class="row">
        <div class="col-12 justify-content-center">
          <div class="alert alert-danger" role="alert">
            <button style="float: right;" class="closeBtn">&times;</button>
            <?php echo $_SESSION['error'] ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif;
  unset($_SESSION['error']) ?>
  <?php if ($_SESSION['success']) : ?>
    <div class="container mt-5 infoAlert">
      <div class="row">
        <div class="col-12 justify-content-center">
          <div class="alert alert-success" role="alert">
            <button style="float: right;" class="closeBtn">&times;</button>
            <?php echo $_SESSION['success'] ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif;
  unset($_SESSION['success']) ?>
  <div style="width: 90%; margin: auto;">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Personal code number</th>
          <th scope="col">Bank account number</th>
          <th scope="col">Balance</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $accounts = file_get_contents(__DIR__ . '../../data/accounts.ser');
        $accounts = unserialize($accounts);
        usort($accounts, function ($a, $b) {
          if ($a['lastName'] == $b['lastName']) {
            return 0;
          } else return ($a['lastName'] < $b['lastName'] ? -1 : 1);
        });
        foreach ($accounts as $id => $account) : ?>
          <?php if ($id !== 0) : ?>
            <tr onMouseOver="style.borderBottom='1px solid crimson'" onMouseOut="style.borderBottom='1px solid rgb(222, 226, 230)'">
              <td><?= $account['name'] ?></td>
              <td><?= $account['lastName'] ?></td>
              <td><?= $account['personalCodeNumber'] ?></td>
              <td><?= $account['accountNumber'] ?></td>
              <td><?= '€ ' . number_format($account['balance'], 2, ',', '.') ?></td>
              <td><a href="./addFunds.php?id=<?= $account['id'] ?>" class="btn btn-success btn-sm"> Add funds </a></td>
              <td><a href="./deductFunds.php?id=<?= $account['id'] ?>" class="btn btn-warning btn-sm"> Withdraw funds </a></td>
              <td><a href="./deleteAccount.php?id=<?= $account['id'] ?>" class="btn btn-danger btn-sm"> Delete </a></td>
            </tr>
          <?php endif ?>
        <?php endforeach ?>
      </tbody>
    </table>

  </div>
</body>

</html>