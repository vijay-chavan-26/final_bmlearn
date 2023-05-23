<?php
$courseName = '';
$courseId = '';
$semesterName = '';
$subjectId = '';
$subjectName = '';
session_start();
include_once('../Includes/conn.php');
if (isset($_POST['update-btn'])) {
    $courseId = $_POST['course-id'];
    $semesterId = $_POST['semester-id'];
    $subjectId = $_POST['subject-id'];
    $subjectName = trim(strtoupper($_POST["subject-name"]));

    if ($_FILES['subject-img']['name'] == '') {
        $update_query = "UPDATE subject SET subject = '$subjectName', semester_id = '$semesterId' WHERE id = '$subjectId'";
    } else {

        // for deleting images of courses which is been uploaded earlier
        $result_array = mysqli_query($conn, "SELECT * FROM subject WHERE id = '$subjectId'");
        if ($result_array && mysqli_num_rows($result_array) > 0) {
            $row = mysqli_fetch_array($result_array);
            $file_path = $row['img_path'];
            unlink('../../' . $file_path);
        }

        $extention = pathinfo($_FILES['subject-img']['name'], PATHINFO_EXTENSION);
        $temp_name = $_FILES['subject-img']['tmp_name'];
        $subjectPath = "Uploads/Subjects/IMG_" . rand(1000000000, 9999999999) . "_" . $subjectName . "." . $extention;
        $destination = "../../" . $subjectPath;

        move_uploaded_file($temp_name, $destination);

        $update_query = "UPDATE subject SET img_path = '$subjectPath', subject = '$subjectName', semester_id = '$semesterId' WHERE id = '$subjectId'";
    }
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['status_message'] = "Subject Edited Successfully!";
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'success';

        header("Location: ../subjects.php");
        exit(0);
    } else {
        $_SESSION['status_message'] = "Something went wrong!";
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';

        header("Location: ../subjects.php");
        exit(0);
    }
}

if (isset($_GET['id']) && isset($_GET['semester']) && isset($_GET['course']) && isset($_GET['courseId']) && isset($_GET['subject'])) {
    $courseName = $_GET['course'];
    $courseId = $_GET['courseId'];
    $semesterName = $_GET['semester'];
    $subjectId = $_GET['id'];
    $subjectName = $_GET['subject'];
} else {
    header("Location: ../subjects.php");
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
        <form action="editSubjectPage.php" id="addSubjectForm" method="post" enctype="multipart/form-data" onsubmit="return validiateNewCourse()">

            <div class="choose-course mb-2">
                <label for="course-id" class="mb-2">Course Name :</label>
                <select name="course-id" class="py-3 w-100 px-3 form-group" id="course-id"
                    onchange="selectedCourse(event)">
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

            <div class="choose-semester mb-2">
                <label for="semester-id" class="mb-2">Semester Name :</label>
                <select name="semester-id" class="py-3 w-100 px-3 form-group" id="semester-id">
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM `semester` WHERE course_id = '$courseId' ORDER BY semester");
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['semester'] == $semesterName){
                                echo "<option value=" . $row['id'] . " selected='selected'>" . $row['semester'] . "</option>";
                            }else{
                                echo "<option value=" . $row['id'] . ">" . $row['semester'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <p class="semester-id-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="subject-name" class="mb-2">Subject Name :</label>
                <input type="text" class="form-control" id="subject-name" name="subject-name"
                    aria-describedby="emailHelp" placeholder="Enter Subject"
                value="<?= $subjectName; ?>">
            </div>
            <p class="subject-name-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="subject-img" class="mb-2">Choose Image for subject thumbnail :</label>
                <input type="file" accept="image/jpeg, image/png" name="subject-img" class="form-control-file" id="subject-img">
            </div>
            <p class="subject-img-err err mb-3"></p>

            <input type="hidden" name="subject-id" value="<?= $subjectId; ?>">
            <div class="buttons d-flex justify-content-end">
                <button name="cancel-btn" class="btn btn-danger me-4"
                    onclick="window.location.href='../subjects.php'">cancel</button>
                <button type="submit" name="update-btn" id="update-btn" class="btn btn-primary">Update Subject</button>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    const subjectName = document.getElementById("subject-name");
    const subjectNameErr = document.querySelector(".subject-name-err");
    const semesterId = document.getElementById("semester-id");
    const semesterIdErr = document.querySelector(".semester-id-err");

    const validiateNewCourse = () => {
        const subjectNameValue = subjectName.value.trim();
        const semesterNameValue = semesterId.value.trim();

        if (semesterNameValue <= 0) {
            semesterIdErr.textContent = "**semester name is required";
            return false;
        }else if (subjectNameValue === '') {
            subjectNameErr.textContent = "**subject name is required";
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

    ChangeEvent(semesterId)
    FocusEvent(subjectName)


    
    const selectedCourse = (e) => {
        console.log(e.target.value)

        const semesterDropdown = document.getElementById("semester-id");
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `addNewSubjectPage.php?course_id=${e.target.value}`, true);

        // handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // get the subcategory dropdown element
                console.log('success')
                semesterDropdown.innerHTML = '<option disabled="disabled" selected="selected" value="0">Choose Semester</option>'
                const semesters = JSON.parse(xhr.responseText)
                semesters.forEach(semester => {
                    const option = document.createElement("option");
                    option.value = semester.id;
                    option.text = semester.semester;
                    semesterDropdown.appendChild(option);
                    console.log(semester.id)
                });
            } else {
                console.log('failed')
            }
        }
        // send the request
        xhr.send();
    };

</script>