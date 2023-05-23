<?php
// session_start();
include_once('conn.php');
?>

<div id="semester-page" class="py-5">
    <h1 class="text-center mb-4 theme-color">Semesters</h1>
    <a href="./php/addNewSemesterPage.php" class="btn btn-primary bg-theme-color border-0 mb-4">Add New Semester</a>

    <div class="table-container table-responsive">

        <table class="table bg-white table-striped table-hover table-bordered text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Course</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_query = "SELECT semester.id,
                            semester.img_path,
                            semester.semester,
                            course.course
                            from semester INNER JOIN
                            course ON semester.course_id = course.id
                            ORDER by semester.id DESC
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
                                <img class="semester-img table-img" src="../<?= $result_array['img_path'] ?>"
                                    alt="<?= $result_array['semester'] ?>">
                            </td>
                            <td>
                                <?= $result_array['semester'] ?>
                            </td>
                            <td>
                                <?= $result_array['course'] ?>
                            </td>
                            <td>
                                <a href="./php/editSemesterPage.php?id=<?= $result_array['id'] ?>&semester=<?= $result_array['semester'] ?>&course=<?= $result_array['course'] ?>"
                                    name="edit-btn" class="btn btn-primary border-0">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><a onclick="deleteSemester(<?= $result_array['id'] ?>)" class="btn btn-danger border-0">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <td colspan="6">No semesters found</td>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    const deleteSemester = (id) => {
        console.log(id)
        swal({
            title: "Are you sure?",
            text: "Once deleted, All videos, subjects will be permanentely deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `./php/deleteSemesterPage.php?delete-btn=${true}&id=${id}`;
                } else {
                    window.location.href = "semesters.php"
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