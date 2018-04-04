<?php
// session_start();
include('inc/pdo.php');
include('inc/function.php');

/* Validation du FORM
====================== */
$error = array();
$success = false;

//
if(!empty($_POST['submitted'])){
    // Protection faille XXS
    ///////////////////////////////

    $pseudo = clean($_POST['pseudo']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $password_confirm = clean($_POST['password_confirm']);

    // Validation des champs
    /////////////////////////////////
        // pseudo
        if (!empty($pseudo)){
            if (strlen($pseudo) < 3){
                $error['pseudo'] = 'Minimum 3 caractères';
            }elseif(strlen($pseudo) > 100){
                $error['pseudo'] = "Maximum 20 carctères";
            }else {

                $sql = "SELECT * FROM users
                        WHERE pseudo = :pseudo";
                $query = $pdo->prepare($sql);
                $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
                $query->execute();
                $pseudoexist = $query->fetch();

                if(!empty($pseudoexist)){
                    $error['pseudo'] = 'Cet identifiant existe déja';
                }
            }
        } else {
            $error['pseudo'] = 'Veuillez renseigner ce champ';
        }

        // email
        if(!empty($email)){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] =  "Votre E-mail est invalide.";
            }else {
                $sql = "SELECT * FROM users
                        WHERE email = :email";
                $query = $pdo->prepare($sql);
                $query ->bindValue(':email',$email,PDO::PARAM_STR);
                $query ->execute();
                $emailExist = $query->fetch();

                if(!empty($emailExist)){
                    $error['email'] = 'Cet E-mail éxiste déja';
                }
            }
        }
        else {
            $error['email'] = 'Veuillez renseigner ce champ';
        }

        // Password
        if (!empty($password) && !empty($password_confirm)){
            if ($password != $password_confirm){
                $error['password'] = 'Les mots de passe doivent être identique';
            }elseif(strlen($password) < 6){
                $error['password'] = "Mot de passe court";
            }
        } else {
            $error['password'] = 'Veuillez renseigner ce champ';
        }


    // if pas d'erreur
    if(count($error) == 0){
        $success = true;
        $passwordhash= password_hash($password, PASSWORD_DEFAULT);
        $token = generateRandomString(50);

        // On insert dans la based e donnée
        $sql = "INSERT INTO users (pseudo, email, password, token, created_at, role)
                VALUES (:pseudo, :email, :password, :token, NOW(), 'abonne')";

                $query = $pdo->prepare($sql);
                // Protection injection sql
                $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
                $query->bindValue(':email',$email,PDO::PARAM_STR);
                $query->bindValue(':password',$passwordhash,PDO::PARAM_STR);
                $query->bindValue(':token',$token,PDO::PARAM_STR);
                $query->execute();

                // Redirection vers connexion
                header('Location: connexion.php');


    }

}

include('inc/header.php');
?>

    <div class="container">
        <h1>Inscription</h1>

        <!-- Formulaire Incscription -->
        <form action="" method="post">
            <div class="form-group">
                <label for="pseudo">Identifiant *</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre identifiant" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo'];} ?>">
                <?php errorMessageForm($error,'pseudo') ?>
            </div>
            <div class="form-group">
                <label for="email">E-mail *</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre E-mail" value="<?php if(!empty($_POST['email'])) { echo $_POST['email'];} ?>">
                <?php errorMessageForm ($error,'email') ?>

            </div>
            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                <?php errorMessageForm($error,'password') ?>
            </div>
            <div class="form-group">
                <label for="password_confirm">Répeter mot de passe *</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirmer votre mot de passe">
                <?php errorMessageForm($error,'password_confirm') ?>
            </div>

            <input type="submit" class="btn btn-primary" name="submitted" value="Inscription">
        </form>
    </div>



<?php
include('inc/footer.php');

?>
