<?php
session_start();
include_once('../Includes/conn.php');

if (isset($_POST["add-btn"])) {
  $courseName = trim(strtoupper($_POST["course-name"]));
  $extention = pathinfo($_FILES['course-img']['name'], PATHINFO_EXTENSION);
  $temp_name = $_FILES['course-img']['tmp_name'];
  $coursePath = "Uploads/Courses/IMG_" . rand(1000000000, 9999999999) . "_" . $courseName . "." . $extention;
  $destination = "../../".$coursePath;

  if (move_uploaded_file($temp_name, $destination)) {
    $insert_course = "INSERT INTO course(img_path, course) VALUES ('$coursePath', '$courseName')";
    if(mysqli_query($conn, $insert_course)){
      $_SESSION['status_message'] = "Course Added Successfully!";
      $_SESSION['status_reaction'] = 'Done!';
      $_SESSION['status'] = 'success';

      header("Location: ../courses.php");
      exit(0);
    }
  } else {
    $_SESSION['status_message'] = "Something went wrong!";
    $_SESSION['status_reaction'] = 'Error!';
    $_SESSION['status'] = 'error';
    header("Location: ../courses.php");
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

  <title>Add New Course</title>
</head>

<body class="bg-eee">
  <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
    <div class="text-center mb-5">
      <h1 class="heading theme-color">Add New Course</h1>
      <p class="sub-title">-Enter new course details</p>
    </div>
    <form action="addNewCoursePage.php" method="post" enctype="multipart/form-data"
      onsubmit="return validiateNewCourse()">
      <div class="form-group mb-2">
        <label for="course-name" class="mb-2">Course Name :</label>
        <input type="text" class="form-control" id="course-name" name="course-name" aria-describedby="emailHelp"
          placeholder="Enter Course Name">
      </div>
      <p class="course-name-err err mb-3"></p>
      <div class="form-group mb-2">
        <label for="course-img" class="mb-2">Choose Image for course thumbnail :</label>
        <input type="file" accept="image/jpeg, image/png" name="course-img" class="form-control-file" id="course-img">
      </div>
      <p class="course-img-err err mb-3"></p>
      <div class="buttons d-flex justify-content-end">
        <button name="cancel-btn" class="btn btn-danger me-4" onclick="window.location.href='../courses.php'">cancel</button>
        <button type="submit" name="add-btn" class="btn btn-primary">Add Course</button>
      </div>
    </form>
  </div>
</body>

</html>

<script>
  const courseName = document.getElementById("course-name");
  const courseNameErr = document.querySelector(".course-name-err");
  const courseImg = document.getElementById("course-img");
  const courseImgErr = document.querySelector(".course-img-err");

  const validiateNewCourse = () => {
    const courseNameValue = courseName.value.trim();
    const checkName = /^[\S+]{2,20}$/;

    console.log(courseImg.value)
    if (courseNameValue === '') {
      courseNameErr.textContent = "**course name is required";
      return false;
    } else if (!checkName.test(courseNameValue)) {
      courseNameErr.textContent = "**invalid course name!";
      return false;
    } else if (courseImg.value === '') {
      courseImgErr.textContent = "**please choose image for course!";
      return false;
    }

    return true;
  }

  const FocusEvent = (input) => {
    courseName.addEventListener("focus", (e) => {
      e.target.parentNode.nextElementSibling.textContent = "";
    });
  };

  FocusEvent(courseName)
  FocusEvent(courseImg)
</script>