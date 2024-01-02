<?php
session_start();
if(isset($_SESSION['userLoggedIn']) && $_SESSION['login']==1){
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
    <title>Register</title>
</head>

<body>
    <?php
    if (file_exists(__DIR__ . '/navBar.php')) {
        require __DIR__ . '/navBar.php';
    }
    ?>
    <section class=" bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-2">Create an account</h2>

                                <form>
                                    <div class="form-floating">
                                        <input type="email" id="floatingInput" class="form-control form-control-lg" placeholder=""/>
                                        <label class="form-label" for="floatingInput">Your Email</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="password" id="floatingInput" class="form-control form-control-lg" placeholder="Password"/>
                                        <label class="form-label" for="floatingInput">Password</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="password" id="floatingInput" class="form-control form-control-lg" placeholder="Password"/>
                                        <label class="form-label" for="floatingInput">Repeat your password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>