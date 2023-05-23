<?php
// session_start();
include_once('conn.php');
?>

<div id="video-page" class="py-5">
    <h1 class="text-center mb-4 theme-color">All Users</h1>

    <div class="table-container table-responsive">
        <table class="table bg-white table-striped table-hover table-bordered text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Course</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_query = "SELECT users.username,
                                users.email,
                                users.id,
                                course.course
                                FROM users
                                join course on users.course_id = course.id
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
                                <?= $result_array['username'] ?>
                            </td>
                            <td>
                                <?= $result_array['email'] ?>
                            </td>
                            <td>
                                <?= $result_array['course'] ?>
                            </td>
                            <td><a onclick="deleteSubject(<?= $result_array['id'] ?>)" class="btn btn-danger border-0">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <td colspan="8">No Users found</td>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    const deleteSubject = (id) => {
        console.log(id)
        swal({
            title: "Are you sure?",
            text: "Once deleted, User Account will be permanentely deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `./php/deleteUserPage.php?delete-btn=${true}&id=${id}`;
                } else {
                    window.location.href = "index.php"
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