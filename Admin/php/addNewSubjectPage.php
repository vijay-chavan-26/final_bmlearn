<?php
session_start();
include_once('../Includes/conn.php');

if (isset($_POST["add-btn"])) {
    $courseId = $_POST["course-id"];
    $semesterId = $_POST["semester-id"];
    $subjectName = trim(strtoupper($_POST["subject-name"]));
    $extention = pathinfo($_FILES['subject-img']['name'], PATHINFO_EXTENSION);
    $temp_name = $_FILES['subject-img']['tmp_name'];
    $subjectPath = "Uploads/Subjects/IMG_" . rand(1000000000, 9999999999) . "_" . $subjectName . "." . $extention;
    $destination = "../../" . $subjectPath;

    if (move_uploaded_file($temp_name, $destination)) {
        $insert_subject = "INSERT INTO subject(img_path, subject, semester_id) VALUES ('$subjectPath', '$subjectName', '$semesterId')";
        if (mysqli_query($conn, $insert_subject)) {
            $_SESSION['status_message'] = "Subject Added Successfully!";
            $_SESSION['status_reaction'] = 'Done!';
            $_SESSION['status'] = 'success';

            header("Location: ../subjects.php");
            exit(0);
        }
    } else {
        $_SESSION['status_message'] = "Something went wrong!";
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';
        header("Location: ../subjects.php");
        exit(0);
    }
}


if (isset($_GET['course_id']) && $_GET['course_id'] > 0) {
    $courseId = $_GET['course_id'];
    $select_semester_query = "SELECT * FROM semester WHERE course_id = '$courseId'";
    $result = mysqli_query($conn, $select_semester_query);
    $data = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header("Content-Type: application/json");
        echo json_encode($data);
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

    <title>Add New Subject</title>
</head>

<body class="bg-eee">
    <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="heading theme-color">Add New Subject</h1>
            <p class="sub-title">-Enter new subject details</p>
        </div>
        <form action="addNewSubjectPage.php" id="addSubjectForm" method="post" enctype="multipart/form-data"
            onsubmit="return validiateNewCourse()">

            <div class="choose-course mb-2">
                <label for="course-id" class="mb-2">Course Name :</label>
                <select name="course-id" class="py-3 w-100 px-3 form-group" id="course-id"
                    onchange="selectedCourse(event)">
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

            <div class="choose-semester mb-2">
                <label for="semester-id" class="mb-2">Semester Name :</label>
                <select name="semester-id" class="py-3 w-100 px-3 form-group" id="semester-id">
                    <option disabled="disabled" selected="selected" value="0">Choose Semester</option>
                </select>
            </div>
            <p class="semester-id-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="subject-name" class="mb-2">Subject Name :</label>
                <input type="text" class="form-control" id="subject-name" name="subject-name"
                    aria-describedby="emailHelp" placeholder="Enter Subject">
            </div>
            <p class="subject-name-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="subject-img" class="mb-2">Choose Image for subject thumbnail :</label>
                <input type="file" accept="image/jpeg, image/png" name="subject-img" class="form-control-file"
                    id="subject-img">
            </div>
            <p class="subject-img-err err mb-3"></p>

            <div class="buttons d-flex justify-content-end">
                <button name="cancel-btn" class="btn btn-danger me-4"
                    onclick="window.location.href='../subjects.php'">cancel</button>
                <button type="submit" name="add-btn" id="add-btn" class="btn btn-primary">Add Subject</button>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    const courseId = document.getElementById("course-id");
    const courseIdErr = document.querySelector(".course-id-err");
    const semesterId = document.getElementById("semester-id");
    const semesterIdErr = document.querySelector(".semester-id-err");
    const subjectName = document.getElementById("subject-name");
    const subjectNameErr = document.querySelector(".subject-name-err");
    const subjectImg = document.getElementById("subject-img");
    const subjectImgErr = document.querySelector(".subject-img-err");

    const validiateNewCourse = () => {
        const courseNameValue = courseId.value.trim();
        const semesterNameValue = semesterId.value.trim();
        const subjectNameValue = subjectName.value.trim();

        console.log(subjectImg.value)
        if (courseNameValue <= 0) {
            courseIdErr.textContent = "**course name is required";
            return false;
        }else if (semesterNameValue <= 0) {
            semesterIdErr.textContent = "**semester name is required";
            return false;
        } else if (subjectNameValue === '') {
            subjectNameErr.textContent = "**subject name is required";
            return false;
        } else if (subjectImg.value === '') {
            subjectImgErr.textContent = "**please choose image for subject!";
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
    ChangeEvent(semesterId)
    FocusEvent(subjectName)
    FocusEvent(subjectImg)


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