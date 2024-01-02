<?php
session_start();
if (!isset($_SESSION['userLoggedIn']) && $_SESSION['login'] != 1) {
    header('Location: http://localhost/php-bank-v1/views/');
    exit;
}

$accounts = file_get_contents(__DIR__ . '/.././data/accounts.ser');
$accounts = unserialize($accounts);
$newestUser = array_search($_SESSION['accountCreated'], array_column($accounts, 'id'));

function generateAccountNumber($accounts)
{
    $newBankAccountNumber = ['L', 'T'];
    $formatBankAccountNumber = '';

    for ($i = 0; $i < 18; $i++) {
        $newBankAccountNumber[] = rand(0, 9);
    }
    unset($i);

    for ($i = 0; $i < count($newBankAccountNumber); $i++) {
        if ($i % 4 === 0 && $i !== 0) {
            $formatBankAccountNumber = $formatBankAccountNumber . ' ';
        }
        $formatBankAccountNumber = $formatBankAccountNumber . $newBankAccountNumber[$i];
    }
    unset($i);

    if (array_search($formatBankAccountNumber, array_column($accounts, 'accountNumber'))) {
        echo 'saskaita dubliuojasi, kita ';
        return generateAccountNumber($accounts);
    } else {
        return $formatBankAccountNumber;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <?php if ($_SESSION['accountCreated']) : ?>
        <div class="col-6 infoAlert" style="margin: auto;">
            <div style="background-color: rgb(0,255,0,0.6);" class="alert alert-dismissible">
                <button style="float: right;" class="closeBtn">&times;</button>
                <span>

                    <h2>New Account created</h2>
                    <h4>
                        Name: <b><?= $accounts[$newestUser]['name']; ?> </b>
                        Last Name: <b><?= $accounts[$newestUser]['lastName']; ?> </b>
                    </h4>
                    <h4>
                        Account number: <b><?= $accounts[$newestUser]['accountNumber']; ?> </b>
                    </h4>
                </span>

            </div>
            <?php unset($_SESSION['accountCreated']); ?>
        </div>
        </div>
    <?php endif ?>

    <div class="col-6" style="margin: auto;  padding: 2rem; border-radius: 15px; border: 1px solid black;">
        <h2 class="mb-4">Create new bank account</h2>
        <form action="../actions/storeNewAccount.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" value="<?= $_SESSION['name'] ?>">
            </div>
            <div class="form-group">
                <label for="lastName">Last name</label>
                <input class="form-control" type="text" name="lastName" value="<?= $_SESSION['lastName'] ?>">
            </div>

            <div class="form-group">
                <label for="personalNumber">Personal code number</label>
                <input class="form-control" type="text" name="personalNumber" value="<?= $_SESSION['personalCodeNumber'] ?>">
            </div>
            <div class="form-group">
                <label for="bankAccountNumber">Bank account number</label>
                <input class="form-control" readonly type="text" name="bankAccountNumber" value="<?= generateAccountNumber($accounts) ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>

        <?php
        if ($_SESSION['error']) : ?>
            <ul>

                <?php foreach ($_SESSION['error'] as $errorMsg) : ?>
                    <li style="color: red;"><?= $errorMsg ?></li>
                <?php endforeach ?>
            </ul>
        <?php unset($_SESSION['error']);
        endif ?>

    </div>
</body>

</html>
<?php
unset($_SESSION['name']);
unset($_SESSION['lastName']);
unset($_SESSION['personalCodeNumber']);
