<?php
// session_start();
include('inc/pdo.php');
include('inc/function.php');
$error = array();
$success = false; 

        if(!empty($_GET['email']) && !empty($_GET['token'])){

            $email = urldecode(trim(strip_tags($_GET['email'])));
            $token = trim(strip_tags($_GET['token']));

            $sql = "SELECT * FROM users WHERE email = :email OR token = :token";
            $query = $pdo->prepare($sql);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':token', $token, PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            if(empty($user)){
                die('404');
            }

        } else {
            // header('Location: 404.php');
            die('404');
        }

        if(!empty($_POST['submitted'])){
            $password1 = trim(strip_tags($_POST['password1']));
            $password2 = trim(strip_tags($_POST['password2']));

            if (!empty($password1) && !empty($password2)){
                if ($password1 != $password2){
                    $error['password'] = 'Les mots de passe doivent être identique';
                }elseif(strlen($password1) < 6){
                    $error['password'] = "Mot de passe court";
                }
            } else {
                $error['password'] = 'Veuillez renseigner ce champ';
            }

            if(count($error) == 0){
                $success = true;
                $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                $newtoken = generateRandomString(50);
                $id_user = $user['id'];
    
                // Update du password
                $sql = "UPDATE users SET password = :newpassword, token = :newtoken WHERE id = $id_user ";
                        $stmt = $pdo->prepare($sql);
                        $stmt ->bindValue(':newpassword',$hashedPassword);                    
                        $stmt ->bindValue(':newtoken',$newtoken);
                        $stmt ->execute();
    
                // Redirection vers connexion.php
                header('Location : connexion.php');
            }
        }
        
?>


<?php
include('inc/header.php');
?>
 <div class="container">
        <h1>Nouveau Mot de passe</h1>

        <form action="" method="post">
        <div class="form-group">
                <label for="password1">Nouveau mot de passe *</label>
                <input type="password1" class="form-control" id="password1" name="password1" >
                <?php errorMessageForm($error,'password') ?>                
            </div>
            <div class="form-group">
                <label for="password2">Confirmer mot de passe *</label>
                <input type="password2" class="form-control" id="password2" name="password2" >
                <?php errorMessageForm($error,'password') ?>                
            </div>
            <input type="submit" class="btn btn-primary" name="submitted" value="Modifier Password">
        </form>

    </div>


<?php
include('inc/footer.php');

?>