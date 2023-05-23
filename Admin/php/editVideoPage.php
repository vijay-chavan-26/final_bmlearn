<?php
$courseName = '';
$courseId = '';
$semesterId = '';
$semesterName = '';
$subjectId = '';
$subjectName = '';
$videoId = '';
$videoName = '';
$desc = '';

session_start();

include_once('../Includes/conn.php');
if (isset($_POST['update-btn'])) {
    $courseId = $_POST["course-id"];
    $semesterId = $_POST["semester-id"];
    $subjectId = $_POST["subject-id"];
    $videoId = $_POST["video-id"];
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

    if ($_FILES['video-img']['name'] == '' && $_FILES['video']['name'] == '') {
        $update_query = "UPDATE video SET video = '$videoName', description = '$videoDesc', subject_id = '$subjectId' WHERE id = '$videoId'";
    }else if($_FILES['video-img']['name'] != '' && $_FILES['video']['name'] == '') {
        
        // for deleting images of courses which is been uploaded earlier
        $result_array = mysqli_query($conn, "SELECT * FROM video WHERE id = '$videoId'");
        if ($result_array && mysqli_num_rows($result_array) > 0) {
            $row = mysqli_fetch_array($result_array);
            $file_path = $row['img_path'];
            unlink('../../' . $file_path);
        }

        $extention = pathinfo($_FILES['video-img']['name'], PATHINFO_EXTENSION);
        $temp_name = $_FILES['video-img']['tmp_name'];
        $videoImgPath = "Uploads/Videos/IMG_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention;
        $destination = "../../" . $videoImgPath;

        move_uploaded_file($temp_name, $destination);

        $update_query = "UPDATE video SET img_path = '$videoImgPath', video = '$videoName', description = '$videoDesc', subject_id = '$subjectId' WHERE id = '$videoId'";

    }else if($_FILES['video-img']['name'] == '' && $_FILES['video']['name'] != '') {
        
        // for deleting images of courses which is been uploaded earlier
        $result_array = mysqli_query($conn, "SELECT * FROM video WHERE id = '$videoId'");
        if ($result_array && mysqli_num_rows($result_array) > 0) {
            $row = mysqli_fetch_array($result_array);
            $file_path = $row['video_path'];
            unlink('../../' . $file_path);
        }

        $extention = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
        $temp_name = $_FILES['video']['tmp_name'];
        $videoPath = "Uploads/Videos/VID_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention;
        $destination = "../../" . $videoPath;

        move_uploaded_file($temp_name, $destination);

        $update_query = "UPDATE video SET video_path = '$videoPath', video = '$videoName', description = '$videoDesc', subject_id = '$subjectId' WHERE id = '$videoId'";
    }else {    

        // for deleting images of courses which is been uploaded earlier
        $result_array = mysqli_query($conn, "SELECT * FROM video WHERE id = '$videoId'");
        if ($result_array && mysqli_num_rows($result_array) > 0) {
            $row = mysqli_fetch_array($result_array);
            $file_path1 = $row['img_path'];
            $file_path2 = $row['video_path'];
            unlink('../../' . $file_path1);
            unlink('../../' . $file_path2);
        }

        
    $extention = pathinfo($_FILES['video-img']['name'], PATHINFO_EXTENSION);
    $extention1 = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
    $temp_name = $_FILES['video-img']['tmp_name'];
    $temp_video_name = $_FILES['video']['tmp_name'];

    $videoImgPath = "Uploads/Videos/IMG_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention;
    $videoPath = "Uploads/Videos/VID_" . rand(1000000000, 9999999999) . "_" . $videoName . "." . $extention1;

    $imgDestination = "../../" . $videoImgPath;
    $videoDestination = "../../" . $videoPath;

        move_uploaded_file($temp_name, $imgDestination);
        move_uploaded_file($temp_video_name, $videoDestination);

        $update_query = "UPDATE video SET img_path = '$videoImgPath', video_path = '$videoPath', video = '$videoName', description = '$videoDesc', subject_id = '$subjectId' WHERE id = '$videoId'";

    }
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['status_message'] = "Video Edited Successfully!";
        $_SESSION['status_reaction'] = 'Done!';
        $_SESSION['status'] = 'success';

        // header("Location: ../videos.php");
        // exit(0);
    } else {
        $_SESSION['status_message'] = "Something went wrong!";
        $_SESSION['status_reaction'] = 'Error!';
        $_SESSION['status'] = 'error';

        // header("Location: ../videos.php");
        // exit(0);
    }
}

if (isset($_GET['video']) && isset($_GET['videoId']) && isset($_GET['semester']) && isset($_GET['semesterId']) && isset($_GET['course']) && isset($_GET['courseId']) && isset($_GET['subject']) && isset($_GET['subjectId'])) {
    $courseName = $_GET['course'];
    $courseId = $_GET['courseId'];
    $semesterId = $_GET['semesterId'];
    $semesterName = $_GET['semester'];
    $subjectId = $_GET['subjectId'];
    $subjectName = $_GET['subject'];
    $videoId = $_GET['videoId'];
    $videoName = $_GET['video'];
    $desc = $_GET['desc'];

    echo $courseName;
    echo $courseId;
    echo $semesterId;
    echo $semesterName;
    echo $subjectId;
    echo $subjectName;
    echo $videoId;
    echo $videoName;
    echo $desc;
} else {
    header("Location: ../videos.php");
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

    <title>Edit Videos</title>
</head>

<body class="bg-eee">
    <div class="form-wrapper-width bg-white mx-auto p-4 p-lg-5 mt-5">
        <div class="text-center mb-5">
            <h1 class="heading theme-color">Edit Videos</h1>
            <p class="sub-title">-Enter video details</p>
        </div>
        <form action="editVideoPage.php" id="addVideoForm" method="post" enctype="multipart/form-data"
            onsubmit="return validiateNewCourse()">

            <div class="choose-course mb-2">
                <label for="course-id" class="mb-2">Course Name :</label>
                <select name="course-id" class="py-3 w-100 px-3 form-control" id="course-id"
                    onchange="selectedCourse(event)">
                    <option disabled="disabled" selected="selected" value="0">Choose Course</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `course` ORDER BY course");
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['course'] == $courseName) {
                            echo "<option value=" . $row['id'] . " selected='selected'>" . $row['course'] . "</option>";
                        } else {
                            echo "<option value=" . $row['id'] . ">" . $row['course'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p class="course-id-err err mb-3"></p>

            <div class="choose-semester mb-2">
                <label for="semester-id" class="mb-2">Semester Name :</label>
                <select name="semester-id" class="py-3 w-100 px-3 form-control" id="semester-id"
                onchange="selectedSemester(this)">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `semester` WHERE course_id = '$courseId' ORDER BY semester");
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['semester'] == $semesterName) {
                            echo "<option value=" . $row['id'] . " selected='selected'>" . $row['semester'] . "</option>";
                        } else {
                            echo "<option value=" . $row['id'] . ">" . $row['semester'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p class="semester-id-err err mb-3"></p>

            <div class="choose-subject mb-2">
                <label for="subject-id" class="mb-2">Subject Name :</label>
                <select name="subject-id" class="py-3 w-100 px-3 form-control" id="subject-id">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `subject` WHERE semester_id = '$semesterId' ORDER BY subject");
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['subject'] == $subjectName) {
                            echo "<option value=" . $row['id'] . " selected='selected'>" . $row['subject'] . "</option>";
                        } else {
                            echo "<option value=" . $row['id'] . ">" . $row['subject'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p class="subject-id-err err mb-3"></p>

            
            <div class="form-group mb-2">
                <label for="video-name" class="mb-2">Video Name :</label>
                <input type="text" class="form-control" id="video-name" name="video-name" aria-describedby="emailHelp" value="<?= $videoName; ?>"
                    placeholder="Enter Video Title">
            </div>
            <p class="video-name-err err mb-3"></p>

            <div class="form-group mb-2">
                <label for="video-desc" class="mb-2">Video Description :</label>
                <textarea class="form-control" id="video-desc" name="video-desc" aria-describedby="emailHelp"
                    placeholder="Enter Video Description" rows="3"><?= $desc; ?></textarea>
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


            <input type="hidden" name="video-id" value="<?= $videoId; ?>">
            <div class="buttons d-flex justify-content-end">
                <button name="cancel-btn" class="btn btn-danger me-4"
                    onclick="window.location.href='../videos.php'">cancel</button>
                <button type="submit" name="update-btn" id="update-btn" class="btn btn-primary">Update Subject</button>
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
    FocusEvent(videoDesc)


    const selectedCourse = (e) => {
        console.log(e.target.value)

        const semesterDropdown = document.getElementById("semester-id");
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `addNewVideoPage.php?course_id=${e.target.value}`, true);

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
                selectedSemester(semesterDropdown);
            } else {
                console.log('failed')
            }
        }
        // send the request
        xhr.send();
    };

    
    const selectedSemester = (e) => {
        console.log(e.value)

        const subjectDropdown = document.getElementById("subject-id");
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `addNewVideoPage.php?semester_id=${e.value}`, true);

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
