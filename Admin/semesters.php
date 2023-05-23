<?php
session_start();

if (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true)) {
  header("Location: ../Client/login.php");
  exit(0);
}

?>

<!-- html header -->
<?php include_once('./Includes/header.inc.php') ?>

<!-- top navigation bar -->
<?php include_once('./Includes/topNavbar.inc.php') ?>

<!-- offcanvas -->
<?php include_once('./Includes/offCanvas.inc.php') ?>

<main class="mt-5 pt-3">
  <div class="container-fluid">
    <!-- coursePage -->
    <?php include_once('./Includes/semesterPage.inc.php') ?>
  </div>
</main>

<!-- footer js files -->
<?php include_once('./Includes/footer.inc.php') ?>
