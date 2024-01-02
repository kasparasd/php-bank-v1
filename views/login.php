<?php
session_start();
if (isset($_SESSION['userLoggedIn']) && $_SESSION['login'] == 1) {
    header('Location: http://localhost/php-bank-v1/views/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="../app.js" defer></script>
    <title>Sign In</title>
</head>

<body class="text-center flex">
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
    <section class=" bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <main class="form-signin" style="margin: auto;">

                                    <form action="http://localhost/php-bank-v1/actions/handleLogin.php" method="post">
                                        <h1 class="h3 mb-3 fw-normal">SIGN IN</h1>

                                        <div class="form-floating">
                                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating">
                                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body mt-5">Sign in</button>
                                        </div>
                                    </form>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>