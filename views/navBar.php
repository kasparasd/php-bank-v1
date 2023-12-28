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
        <a href="./">UniBanca</a>
        <a class="nav-element" href="./">Accounts</a>
        <a class="nav-element" href="./createNewAccount.php">Create new account</a>
    </div>
    <div>
        <a class="nav-element" href="./login.php">Sign in</a>
        <a class="nav-element" href="./register.php">Sign up</a>
    </div>
</div>
<script>
    const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll(".nav-element").forEach(link => {
        if(link.href === 'http://localhost'+activePage) {
            link.classList.add('active');
        }
    })
</script>