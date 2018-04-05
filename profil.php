<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');


include('inc/header.php');
?>
    <div class="container">
        <h1>Page de profil de <?php echo $_SESSION['pseudo']; ?></h1>
        <p>Bonjour <?php echo $_SESSION['id']; ?></p>
    </div>

<?php
include('inc/footer.php');

?>