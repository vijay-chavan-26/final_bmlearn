<?php
// session_start();
include_once('conn.php');
?>

<div id="video-page" class="py-5">
    <h1 class="text-center mb-4 theme-color">Videos</h1>
    <a href="./php/addNewVideoPage.php" class="btn btn-primary bg-theme-color border-0 mb-4">Add New Video</a>

    <div class="table-container table-responsive">
        <table class="table bg-white table-striped table-hover table-bordered text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Course</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_query = "SELECT video.id, 
                                video.video, 
                                video.description, 
                                video.subject_id,
                                subject.subject,
                                subject.semester_id,
                                semester.semester,
                                semester.course_id,
                                course.course
                                FROM video
                                JOIN subject ON video.subject_id = subject.id
                                JOIN semester ON subject.semester_id = semester.id
                                JOIN course ON course.id = semester.course_id
                                ORDER by subject.id DESC
                            ";
                $select_query_run = mysqli_query($conn, $select_query);
                if (mysqli_num_rows($select_query_run) > 0) {
                    $cnt = 1;
                    while ($result_array = mysqli_fetch_assoc($select_query_run)) {
                        ?>
                        <tr>
                            <td>
                                <?= $cnt++ ?>
                            </td>
                            <td>
                                <?= $result_array['video'] ?>
                            </td>
                            <td>
                                <?= $result_array['description'] ?>
                            </td>
                            <td>
                                <?= $result_array['subject'] ?>
                            </td>
                            <td>
                                <?= $result_array['semester'] ?>
                            </td>
                            <td>
                                <?= $result_array['course'] ?>
                            </td>
                            <td>
                                <a href="./php/editVideoPage.php?video=<?= $result_array['video'] ?>&desc=<?= $result_array['description'] ?>&videoId=<?= $result_array['id'] ?>&subject=<?= $result_array['subject'] ?>&subjectId=<?= $result_array['subject_id'] ?>&semester=<?= $result_array['semester'] ?>&semesterId=<?= $result_array['semester_id'] ?>&course=<?= $result_array['course'] ?>&courseId=<?= $result_array['course_id'] ?>"
                                    name="edit-btn" class="btn btn-primary border-0">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><a onclick="deleteVideo(<?= $result_array['id'] ?>)" class="btn btn-danger border-0">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <td colspan="8">No Videos found</td>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    const deleteVideo = (id) => {
        console.log(id)
        swal({
            title: "Are you sure?",
            text: "Once deleted, video will be permanentely deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `./php/deleteVideoPage.php?delete-btn=${true}&id=${id}`;
                } else {
                    window.location.href = "videos.php"
                }
            });
    }
</script>


<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <script>
        console.log('<?php echo $_SESSION['status_reaction']; ?>', '<?php echo $_SESSION['status_message']; ?>', '<?php echo $_SESSION['status']; ?>')
        swal('<?php echo $_SESSION['status_reaction']; ?>', '<?php echo $_SESSION['status_message']; ?>', '<?php echo $_SESSION['status']; ?>');
    </script>
    <?php
    unset($_SESSION['status']);
}
?>