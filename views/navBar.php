<?php
session_start();
$employees = file_get_contents(__DIR__ . '/.././data/employees.ser');
$employees = unserialize($employees);


?>
<!DOCTYPE html>
<style>
    .navBar {
        color: white;
        padding: 20px 60px;
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        /* margin-bottom: 20px; */
        background-color: rgba(0, 0, 0, 0.158);
        margin-bottom: 50px;
    }

    .navBar a {
        text-decoration: none;
        color: black;
        padding-right: 10px;
        /* border-bottom: 1px solid #000; */
        padding: 5px;
    }


    .navBar a:hover {
        border-bottom: 1px solid crimson;

    }

    .active {
        border-bottom: 1px solid crimson !important;
    }

    .navBar div:first-child a:first-child {
        color: crimson;
        border-bottom: none;
        font-weight: bold;
    }
</style>
<div class="navBar">
    <div>
        <a href="./accounts.php">UniBanca</a>
        <?php if (isset($_SESSION['userLoggedIn']) && $_SESSION['login'] == 1) : ?>
            <a class="nav-element" href="./accounts.php">Accounts</a>
            <a class="nav-element" href="./createNewAccount.php">Create new account</a>
        <?php endif ?>
    </div>
    <div>

        <?php if (!isset($_SESSION['userLoggedIn']) && $_SESSION['login'] != 1) : ?>
            <a class="nav-element" href="./login.php">Log in</a>
            <a class="nav-element" href="./register.php">Register</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['userLoggedIn']) && $_SESSION['login'] == 1) : ?>
            <div style="display: flex;">
                <a class="nav-element"><?= $_SESSION['userLoggedIn']['email'] ?></a>
                <form action="http://localhost/php-bank-v1/actions/handleLogout.php" method="post">
                    <button type="submit" class="btn btn-outline-dark">Log out </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll(".nav-element").forEach(link => {
        if (link.href === 'http://localhost' + activePage) {
            link.classList.add('active');
        }
    })
</script>