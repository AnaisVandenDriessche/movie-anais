<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

/* Validation du FORM 
====================== */
$error = array();
$success = false;

if (!empty($_POST['submitted'])){
    // Protection faille XXS
    $pseudo = clean($_POST['pseudo']);
    $password = clean($_POST['password']);



    //Validation des champs
    //////////////////////////////////

    if(empty($pseudo) OR empty($password)){ 
        $error['pseudo'] = "Veuillez renseignez les deux champs";
    }
    else{

        // requete pour verifier si un utilisateur a ce mail ou ce pseudo 
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo OR email = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if(!empty($user)){
            if(password_verify($password, $user['password'])){

                $_SESSION['user'] = array(
                    'id' => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'role' => $user['role'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    // $_SERVER permet de localiser le serveur ou on se connecte
                    
                );

                header('Location: index.php');

            } else {
                $error ['password'] = "Mauvais mot de passe";
            }
        } else {
            $error['pseudo'] = 'Identifiant inconnu';

        }
    
    }

    // if pas d'erreur
    if(count($error) == 0){
        $success = true;

    }    
}


include('inc/header.php');
?>
<div class="container">
        <h1>Connexion</h1>

        <!-- Formulaire Connexion -->
        <form action="" method="post">
            <div class="form-group">
                <label for="pseudo">Identifiant ou E-mail *</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre identifiant" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo'];} ?>">
                <?php errorMessageForm($error,'pseudo') ?>             
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                <?php errorMessageForm($error,'password') ?>            
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" >
                <label class="form-check-label" for="defaultCheck1">
                    Se souvenir de moi
                </label>
            </div>
            <input type="submit" class="btn btn-primary" name="submitted" value="Connexion">
        </form>
        <p>
            <a href="inscription.php">Faire inscription</a>
        </p>
        <p>
            <a href="recovery.php">Mot de passe oublié</a>
        </p>
        <p>
            <a href="index.php">Retour à l'accueil</a>
        </p>
    </div>


<?php
include('inc/footer.php');

