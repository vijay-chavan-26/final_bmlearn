<?php
session_start();
include_once('../Includes/conn.php');

if (isset($_POST["add-btn"])) {
    $courseId = $_POST["course-id"];
    $semesterId = $_POST["semester-id"];
    $subjectId = $_POST["subject-id"];
    $videoName = trim(strtoupper($_POST["video-name"]));
    $videoDesc = trim(strtolower($_POST["video-desc"]));

    $extention = pathinfo($_FILES['video-img']['name'], PATHINFO_EXTENSION);
    $extention1 = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
    $temp_name = $_FILES['video-img']['tmp_name'];
    $temp_video_name = $_FILES['video']['tmp_name'];

    $videoImgPath = "Uploads/Videos/IMG_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention;
    $videoPath = "Uploads/Videos/VID_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention1;

    $imgDestination = "../../" . $videoImgPath;
    $videoDestination = "../../" . $videoPath;

    if (move_uploaded_file($temp_name, $imgDestination) && move_uploaded_file($temp_video_name, $videoDestination)) {
        $insert_video = "INSERT INTO video(img_path,video_path, video, description, subject_id) VALUES ('$videoImgPath','$videoPath', '$videoName', '$videoDesc', '$subjectId')";
        if (mysqli_query($conn, $insert_video)) {
            $_SESSION['status_message'] = "Video Added Successfully!";
            $_SESSION['status_reaction'] = 'Done!';
            $_SESSION['status'] = 'success';

            header("Location: ../videos.php");
            exit(0);
        }
    } else {
        $_SESSION['status_message'] = "Something went wrong!";
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';
        header("Location: ../videos.php");
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

if (isset($_GET['semester_id']) && $_GET['semester_id'] > 0) {
    $semesterId = $_GET['semester_id'];
    $select_subject_query = "SELECT * FROM subject WHERE semester_id = '$semesterId'";
    $result = mysqli_query($conn, $select_subject_query);
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

    <title>Add New Video</title>
</head>

<body class="bg-eee">
    <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="heading theme-color">Upload New Video</h1>
            <p class="sub-title">-Enter new video details</p>
        </div>
        <form action="addNewVideoPage.php" id="addVideoForm" method="post" enctype="multipart/form-data"
            onsubmit="return validiateNewCourse()">

            <div class="choose-course mb-2">
                <label for="course-id" class="mb-2">Course Name :</label>
                <select name="course-id" class="py-3 w-100 px-3 form-control" id="course-id"
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
                <select name="semester-id" class="py-3 w-100 px-3 form-control" id="semester-id"
                    onchange="selectedSemester(event)">
                    <option disabled="disabled" selected="selected" value="0">Choose Semester</option>
                </select>
            </div>
            <p class="semester-id-err err mb-3"></p>

            <div class="choose-subject mb-2">
                <label for="subject-id" class="mb-2">Subject Name :</label>
                <select name="subject-id" class="py-3 w-100 px-3 form-control" id="subject-id">
                    <option disabled="disabled" selected="selected" value="0">Choose Subject</option>
                </select>
            </div>
            <p class="subject-id-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="video-name" class="mb-2">Video Name :</label>
                <input type="text" class="form-control" id="video-name" name="video-name" aria-describedby="emailHelp"
                    placeholder="Enter Video Title">
            </div>
            <p class="video-name-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="video-desc" class="mb-2">Video Description :</label>
                <textarea class="form-control" id="video-desc" name="video-desc" aria-describedby="emailHelp"
                    placeholder="Enter Video Description" rows="3"></textarea>
            </div>
            <p class="video-desc-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="video-img" class="mb-2">Choose Image for video thumbnail :</label>
                <br>
                <input type="file" accept="image/jpeg, image/png" name="video-img" class="form-control-file"
                    id="video-img">
            </div>
            <p class="video-img-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="video" class="mb-2">Choose Video :</label>
                <br>
                <input type="file" accept="video/mp4, video/x-m4v, video/mov, video/mkv, video/*" name="video"
                    class="form-control-file" id="video">
            </div>
            <p class="video-err err mb-3"></p>

            <div class="buttons d-flex justify-content-end">
                <button name="cancel-btn" class="btn btn-danger me-4"
                    onclick="window.location.href='../videos.php'">cancel</button>
                <button type="submit" name="add-btn" id="add-btn" class="btn btn-primary">Upload Video</button>
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
    const subjectId = document.getElementById("subject-id");
    const subjectIdErr = document.querySelector(".subject-id-err");
    const videoName = document.getElementById("video-name");
    const videoNameErr = document.querySelector(".video-name-err");
    const videoDesc = document.getElementById("video-desc");
    const videoDescErr = document.querySelector(".video-desc-err");
    const videoImg = document.getElementById("video-img");
    const videoImgErr = document.querySelector(".video-img-err");
    const video = document.getElementById("video");
    const videoErr = document.querySelector(".video-err");

    const validiateNewCourse = () => {
        const courseNameValue = courseId.value.trim();
        const semesterNameValue = semesterId.value.trim();
        const subjectNameValue = subjectId.value.trim();
        const videoNameValue = videoName.value.trim();
        const videoDescValue = videoDesc.value.trim();

        // console.log(subjectImg.value)
        if (courseNameValue <= 0) {
            courseIdErr.textContent = "**course name is required";
            return false;
        } else if (semesterNameValue <= 0) {
            semesterIdErr.textContent = "**semester name is required";
            return false;
        } else if (subjectNameValue <= 0) {
            subjectIdErr.textContent = "**subject name is required";
            return false;
        } else if (videoNameValue === '') {
            videoNameErr.textContent = "**video name is required";
            return false;
        } else if (videoDescValue === '') {
            videoDescErr.textContent = "**video Description is required";
            return false;
        } else if (videoImg.value === '') {
            videoImgErr.textContent = "**please choose thumbnail image for video!";
            return false;
        } else if (video.value === '') {
            videoErr.textContent = "**please choose video to be upload!";
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
    ChangeEvent(subjectId)
    FocusEvent(videoName)
    FocusEvent(videoImg)
    FocusEvent(video)


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


    const selectedSemester = (e) => {
        console.log(e.target.value)

        const subjectDropdown = document.getElementById("subject-id");
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `addNewVideoPage.php?semester_id=${e.target.value}`, true);

        // handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // get the subcategory dropdown element
                console.log('success')
                subjectDropdown.innerHTML = '<option disabled="disabled" selected="selected" value="0">Choose Subject</option>'
                const subjects = JSON.parse(xhr.responseText)
                subjects.forEach(subject => {
                    const option = document.createElement("option");
                    option.value = subject.id;
                    option.text = subject.subject;
                    subjectDropdown.appendChild(option);
                    console.log(subject.id)
                });
            } else {
                console.log('failed')
            }
        }
        // send the request
        xhr.send();
    };

</script>