<?php include_once('./Components/Header.html') ?>

<?php include_once('./Components/Navbar.php') ?>
<?php include_once('./Components/ContactUs.php') ?>   

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

<?php include_once('./Components/Footer.html') ?>   