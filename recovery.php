<?php
// session_start();
include('inc/pdo.php');
include('inc/function.php');
$error = array();
$success = false;

// Validation Form
//////////////////////////////////

if(!empty($_POST['submitted'])){

    //Faille xxs
    $email = clean($_POST['email']);

    // Validation des champs
    if(!empty($email)){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] =  "Votre E-mail est invalide.";
        }else {
            $sql = "SELECT * FROM users
                    WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query ->bindValue(':email',$email,PDO::PARAM_STR);
            $query ->execute();
            $user = $query->fetch();

            if(empty($user)){
                $error['email'] = 'E-mail inconnu';
            }
        }
    }
    else {
        $error['email'] = 'Veuillez renseigner ce champ';
    }

    // Si pas d'erreur
    if(count($error) == 0){

        $link = "";
        $emailencode = urlencode($email);
        $link .= 'recovery2.php?email='.$emailencode;
        $link.= '&token=' .$user['token'];
    }
}

include('inc/header.php');
?>
 <div class="container">
        <h1>Réinitilisation Mot de passe</h1>
        <?php 
        if(!empty($link)) { ?>
            <a href="<?php echo $link; ?>">Go</a>
        <?php } else{ ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="email">E-mail *</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Votre E-mail" value="<?php if(!empty($_POST['email'])) { echo $_POST['email'];} ?>">
                <?php errorMessageForm($error,'email') ?>
            </div>
            <input type="submit" class="btn btn-danger" name="submitted" value="Modifier Password">
        </form>
    
     <?php } ?>

    </div>


<?php
include('inc/footer.php');

?>