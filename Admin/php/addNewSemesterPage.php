<?php
session_start();
include_once('../Includes/conn.php');

if (isset($_POST["add-btn"])) {
  $courseId = $_POST["course-id"];
  $semesterName = trim(strtoupper($_POST["semester-name"]));
  $extention = pathinfo($_FILES['semester-img']['name'], PATHINFO_EXTENSION);
  $temp_name = $_FILES['semester-img']['tmp_name'];
  $semesterPath = "Uploads/Semesters/IMG_" . rand(1000000000, 9999999999) . "_" . $semesterName . "." . $extention;
  $destination = "../../" . $semesterPath;

  if (move_uploaded_file($temp_name, $destination)) {
    $insert_semester = "INSERT INTO semester(img_path, semester, course_id) VALUES ('$semesterPath', '$semesterName', '$courseId')";
    if (mysqli_query($conn, $insert_semester)) {
      $_SESSION['status_message'] = "Semester Added Successfully!";
      $_SESSION['status_reaction'] = 'Done!';
      $_SESSION['status'] = 'success';

      header("Location: ../semesters.php");
      exit(0);
    }
  } else {
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Error!';
    $_SESSION['status'] = 'error';
    header("Location: ../semesters.php");
    exit(0);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- bootstrap link -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />

  <!-- font awesome link -->
  <link rel="stylesheet" href="../css/all.css">
  <link rel="stylesheet" href="../css/utility_classes.css">

  <!-- custom css link -->
  <link rel="stylesheet" href="../css/style.css" />
  <script src="../js/SweetAlert.js"></script>

  <title>Add New Semester</title>
</head>

<body class="bg-eee">
  <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
    <div class="text-center mb-5">
      <h1 class="heading theme-color">Add New Semester</h1>
      <p class="sub-title">-Enter new semester details</p>
    </div>
    <form action="addNewSemesterPage.php" method="post" enctype="multipart/form-data"
      onsubmit="return validiateNewCourse()">

      <div class="choose-course mb-2">
        <label for="course-id" class="mb-2">Course Name :</label>
        <select name="course-id" class="py-3 w-100 px-3 form-group" id="course-id">
          <option disabled="disabled" selected="selected" value="0">Choose Course</option>
          <?php
          $result = mysqli_query($conn, "SELECT * FROM `course` ORDER BY course");
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value=" . $row['id'] . ">" . $row['course'] . "</option>";
          }
          ?>
        </select>
      </div>
      <p class="course-id-err err mb-3"></p>

      <div class="form-group mb-2">
        <label for="semester-name" class="mb-2">Semester Name :</label>
        <input type="text" class="form-control" id="semester-name" name="semester-name" aria-describedby="emailHelp"
          placeholder="Enter Semester">
      </div>
      <p class="semester-name-err err mb-3"></p>

      <div class="form-group mb-2">
        <label for="semester-img" class="mb-2">Choose Image for semester thumbnail :</label>
        <input type="file" accept="image/jpeg, image/png" name="semester-img" class="form-control-file"
          id="semester-img">
      </div>
      <p class="semester-img-err err mb-3"></p>

      <div class="buttons d-flex justify-content-end">
        <button name="cancel-btn" class="btn btn-danger me-4"
          onclick="window.location.href='../semesters.php'">cancel</button>
        <button type="submit" name="add-btn" class="btn btn-primary">Add Semester</button>
      </div>
    </form>
  </div>
</body>

</html>

<script>
  const courseId = document.getElementById("course-id");
  const courseIdErr = document.querySelector(".course-id-err");
  const semesterName = document.getElementById("semester-name");
  const semesterNameErr = document.querySelector(".semester-name-err");
  const semesterImg = document.getElementById("semester-img");
  const semesterImgErr = document.querySelector(".semester-img-err");

  const validiateNewCourse = () => {
    const courseNameValue = courseId.value.trim();
    const semesterNameValue = semesterName.value.trim();
    const checkName = /^[\S+]{2,20}$/;

    console.log(semesterImg.value)
    if (courseNameValue <= 0) {
      courseIdErr.textContent = "**course name is required";
      return false;
    } else if (semesterNameValue === '') {
      semesterNameErr.textContent = "**semester name is required";
      return false;
    } else if (!checkName.test(semesterNameValue)) {
      semesterNameErr.textContent = "**invalid semester name!";
      return false;
    } else if (semesterImg.value === '') {
      semesterImgErr.textContent = "**please choose image for semester!";
      return false;
    }

    return true;
  }

  const ChangeEvent = (input) => {
    input.addEventListener("change", (e) => {
      e.target.parentNode.nextElementSibling.textContent = "";
    });
  };
  const FocusEvent = (input) => {
    input.addEventListener("focus", (e) => {
      e.target.parentNode.nextElementSibling.textContent = "";
    });
  };

  ChangeEvent(courseId)
  FocusEvent(semesterName)
  FocusEvent(semesterImg)
</script>