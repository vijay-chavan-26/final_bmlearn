<?php
$courseName = '';
$semesterName = '';
session_start();
include_once('../Includes/conn.php');
if (isset($_POST['update-btn'])) {
    $semesterId = $_POST['semester-id'];
    $courseId = $_POST['course-id'];
    $semesterName = trim(strtoupper($_POST["semester-name"]));

    if ($_FILES['semester-img']['name'] == '') {
        $update_query = "UPDATE semester SET semester = '$semesterName', course_id = '$courseId' WHERE id = '$semesterId'";
    } else {

        // for deleting images of courses which is been uploaded earlier
        $result_array = mysqli_query($conn, "SELECT * FROM semester WHERE id = '$semesterId'");
        if ($result_array && mysqli_num_rows($result_array) > 0) {
            $row = mysqli_fetch_array($result_array);
            $file_path = $row['img_path'];
            unlink('../../' . $file_path);
        }

        $extention = pathinfo($_FILES['semester-img']['name'], PATHINFO_EXTENSION);
        $temp_name = $_FILES['semester-img']['tmp_name'];
        $semesterPath = "Uploads/Semesters/IMG_" . rand(1000000000, 9999999999) . "_" . $semesterName . "." . $extention;
        $destination = "../../" . $semesterPath;

        move_uploaded_file($temp_name, $destination);

        $update_query = "UPDATE semester SET img_path = '$semesterPath', semester = '$semesterName', course_id = '$courseId' WHERE id = '$semesterId'";
    }
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['status_message'] = "Semester Edited Successfully!";
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'success';

        header("Location: ../semesters.php");
        exit(0);
    } else {
        $_SESSION['status_message'] = "Something went wrong!";
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';

        header("Location: ../semesters.php");
        exit(0);
    }
}

if (isset($_GET['id']) && isset($_GET['semester']) && isset($_GET['course'])) {
    $courseName = $_GET['course'];
    $semesterName = $_GET['semester'];
    $semesterId = $_GET['id'];
} else {
    header("Location: ../semesters.php");
    exit(0);
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

    <title>Edit Semester</title>
</head>

<body class="bg-eee">
    <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="heading theme-color">Edit Semester</h1>
            <p class="sub-title">-Enter semester details</p>
        </div>
        <form action="editSemesterPage.php" method="post" enctype="multipart/form-data"
            onsubmit="return validiateNewCourse()">

            <div class="choose-course mb-2">
                <label for="course-name" class="mb-2">Course Name :</label>
                <select name="course-id" class="py-3 w-100 px-3 form-group" id="course-id">
                    <option disabled="disabled" selected="selected" value="0">Choose Course</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `course` ORDER BY course");
                    while ($row = mysqli_fetch_array($result)) {
                        if($row['course'] == $courseName){
                            echo "<option value=" . $row['id'] . " selected='selected'>" . $row['course'] . "</option>";
                        }else{
                            echo "<option value=" . $row['id'] . ">" . $row['course'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p class="course-id-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="semester-name" class="mb-2">Semester Name :</label>
                <input type="text" class="form-control" id="semester-name" name="semester-name"
                    aria-describedby="emailHelp" placeholder="Enter Semester"
                    value="<?= $semesterName; ?>">
            </div>
            <p class="semester-name-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="semester-img" class="mb-2">Choose Image for semester thumbnail :</label>
                <input type="file" accept="image/jpeg, image/png" name="semester-img" class="form-control-file"
                    id="semester-img">
            </div>
            <p class="semester-img-err err mb-3"></p>

            <input type="hidden" name="semester-id" value="<?= $semesterId; ?>">
            <div class="buttons d-flex justify-content-end">
                <button name="cancel-btn" class="btn btn-danger me-4"
                    onclick="window.location.href='../semesters.php'">cancel</button>
                <button type="submit" name="update-btn" class="btn btn-primary">Update Semester</button>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    const semesterName = document.getElementById("semester-name");
    const semesterNameErr = document.querySelector(".semester-name-err");

    const validiateNewCourse = () => {
        const semesterNameValue = semesterName.value.trim();
        const checkName = /^[\S+]{2,20}$/;

        if (semesterNameValue === '') {
            semesterNameErr.textContent = "**semester name is required";
            return false;
        } else if (!checkName.test(semesterNameValue)) {
            semesterNameErr.textContent = "**invalid semester name!";
            return false;
        }

        return true;
    }

    const FocusEvent = (input) => {
        input.addEventListener("focus", (e) => {
            e.target.parentNode.nextElementSibling.textContent = "";
        });
    };

    FocusEvent(semesterName)
</script>