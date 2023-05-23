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

<?php
include_once('./Includes/conn.php');
$select_course = "SELECT * FROM course";
$course = mysqli_query($conn, $select_course);
$select_semester = "SELECT * FROM semester";
$semester = mysqli_query($conn, $select_semester);
$select_subject = "SELECT * FROM subject";
$subject = mysqli_query($conn, $select_subject);
$select_video = "SELECT * FROM video";
$video = mysqli_query($conn, $select_video);
?>

<main class="mt-5 pt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4 class="theme-color mb-3">Dashboard</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
          <div class="card-body py-5">
            <?php if (mysqli_num_rows($course) >= 0) { ?>
              <h4>Total Courses
                <?= mysqli_num_rows($course) ?>
              </h4>
            <?php
            } ?>
          </div>
          <a class="card-footer d-flex text-white text-decoration-none" href="courses.php">
            View Details
          </a>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white h-100">
          <div class="card-body py-5">
            <?php if (mysqli_num_rows($semester) >= 0) { ?>
              <h4>Total Semesters
                <?= mysqli_num_rows($semester) ?>
              </h4>
            <?php
            } ?>
          </div>
          <a class="card-footer d-flex text-white text-decoration-none" href="semesters.php">
            View Details
          </a>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
          <div class="card-body py-5">
            <?php if (mysqli_num_rows($subject) >= 0) { ?>
              <h4>Total Subjects
                <?= mysqli_num_rows($subject) ?>
              </h4>
            <?php
            } ?>
          </div>
          <a class="card-footer d-flex text-white text-decoration-none" href="subjects.php">
            View Details
          </a>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
          <div class="card-body py-5">
            <?php if (mysqli_num_rows($video) >= 0) { ?>
              <h4>Total Videos
                <?= mysqli_num_rows($video) ?>
              </h4>
            <?php
            } ?>
          </div>
          <a class="card-footer d-flex text-white text-decoration-none" href="videos.php">
            View Details
          </a>
        </div>
      </div>
    </div>
    
    <?php include_once('./Includes/userPage.inc.php') ?>
  </div>
</main>

<?php include_once('./Includes/footer.inc.php') ?>