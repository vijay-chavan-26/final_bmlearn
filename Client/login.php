<?php 
session_start(); 

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: index.php");
    exit(0);
}
?>

<?php include_once('./Components/Header.html') ?>

<?php include_once('./Components/LoginAndSignupForm.php')?>

<?php include_once('./Components/Footer.html') ?>

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

<script>

</script>