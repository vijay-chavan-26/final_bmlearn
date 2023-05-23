<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();
?>

<nav id="navbar" class="bg-white shadow ">
    <div class="px-3 px-md-5 d-flex justify-content-between align-items-center">
        <div class="nav-logo">
            <a href="./index.php" class="link">
                <h1 class="log text-dark my-3"><img src="./img/logo.png" alt="" style="object-fit:cover" height="50px;"></h1>
            </a>
        </div>

        <div class="nav-menu py-5 py-lg-0">
            <a href="./index.php" class="nav-link1 py-3 nav-links link nav-color text-uppercase font-weight-500">
                <span>Home</span>
            </a>
            <a href="./semester.php" class="nav-link3 py-3 nav-links link nav-color text-uppercase font-weight-500">
                <span>Semester</span>
            </a>
            <a href="./comment/videopage.php" class="nav-link2 py-3 nav-links link nav-color text-uppercase font-weight-500">
                <span>Faq</span>
            </a>
            <a href="./contact.php" class="nav-link4 py-3 nav-links link nav-color text-uppercase font-weight-500">
                <span>Contact</span>
            </a>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                ?>
                <a href="./logout.php" class="nav-link5 nav-links link mt-2">
                    <button
                        class="btn btn-danger border-0 px-4 font-weight-500 text-uppercase">Logout</button>
                </a>
            <?php
            } else {
                ?>
                <a href="./login.php" class="nav-link5 nav-links link mt-2">
                    <button
                        class="btn btn-primary bg-theme-color border-0 px-4 font-weight-500 text-uppercase">Login</button>
                </a>
            <?php
            }
            ?>

        </div>
        <div class="nav-icons d-lg-none">
            <i class="fa-solid fa-bars fa-2x fa-flip"></i>
            <i class="fa-solid fa-xmark fa-2x d-none text-white fa-flip"></i>
        </div>
    </div>
</nav>