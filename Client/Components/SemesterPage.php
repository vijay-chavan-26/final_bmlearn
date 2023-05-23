<?php

if (isset($_SESSION['course_id']) && $_SESSION['course_id'] != '') {
    include_once('./php/conn.php');
    $courseId = $_SESSION['course_id'];
    $select_query = "SELECT semester.id,
                    semester.img_path,
                    semester.semester,
                    course.course
                    from semester INNER JOIN
                    course ON semester.course_id = course.id
                    WHERE semester.course_id = '$courseId'";
    $select_query_run = mysqli_query($conn, $select_query);

} else {
    header("Location: login.php");
    exit(0);
}
?>

<div id="semester-page" class="position-relative d-flex align-items-center min-h-90">
    <div class="card-container container py-5 w-100 d-grid text-center">
        <h1 class=" mb-5">Select <span class="theme-color">Semester</span></h1>
        <div class="row g-5 w-100 mx-auto">


            <?php
            if ($select_query_run && mysqli_num_rows($select_query_run) > 0) {

                while ($row = mysqli_fetch_assoc($select_query_run)) { ?>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card shadow rounded border-0 cursor-pointer"
                            onclick="window.location.href = './subject.php?semester_id=<?= $row['id'] ?>'">
                            <div class="img-conatiner">
                                <img class="card-img-top card-img rounded-0" src="../<?= $row['img_path'] ?>"
                                    alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <p class="card-text mb-1">
                                    <?= $row['semester'] ?>
                                </p>
                                <h6>
                                    <?= $row['course'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else { ?>
                <p class='text-555 h4'>No Semesters Found in this course</p>

                <?php
            } ?>
        </div>
    </div>
</div>