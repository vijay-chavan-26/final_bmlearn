<?php

if(isset($_GET['subject_id'])){
    $subjectId =  $_GET['subject_id'];
    include_once('./php/conn.php');

    $select_query = "SELECT video.id,
                    video.img_path,
                    video.video,
                    video.description,
                    subject.subject
                    from video INNER JOIN
                    subject ON video.subject_id = subject.id
                    WHERE video.subject_id = $subjectId";
    $select_query_run = mysqli_query($conn, $select_query);
}else{
    header("Location: subject.php");
    exit(0);
}


?>

<div id="video-page" class="position-relative d-flex align-items-center min-h-90">
    <div class="card-container container py-5 w-100 d-grid text-center">
        <h1 class=" mb-5">Select <span class="theme-color">Videos</span></h1>
        <div class="row g-5 w-100 mx-auto">


            <?php
            if ($select_query_run && mysqli_num_rows($select_query_run) > 0) {

                while ($row = mysqli_fetch_assoc($select_query_run)) { ?>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card shadow rounded border-0 cursor-pointer"
                            onclick="window.location.href = './watchVideo.php?video_id=<?= $row['id'] ?>'">
                            <div class="img-conatiner">
                                <img class="card-img-top card-img rounded-0" src="../<?= $row['img_path'] ?>"
                                    alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-text mb-1 text-uppercase">
                                    <?= $row['video'] ?>
                                </h5>
                                <p class="card-text text-muted mb-1 text-lowercase">
                                    <?= substr($row['description'], 0, 20).'...' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else { ?>
                <p class='text-555 h4'>No Videos Found in this Subject</p>

                <?php
            } ?>
        </div>
    </div>
</div>