<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

?>
<a href="index.php">Retour vers page accueil</a>
<br>
<br>
<a href="listing_film_a_voir.php"> Voir ma liste de film "à voir" </a>
<br>
<br>

<?php
if(!empty($_GET['id']) && isLogged()) {
 
    $movie_id = $_GET['id'];
    $user_id = $_SESSION['user']['id']; 

    $sql = "SELECT * FROM movies_full WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$movie_id,PDO::PARAM_INT);
    $query->execute();
    $movie = $query->fetch();
    if(empty($movie)) { die('404'); }



    //REQUETE SQL
    $sql="INSERT INTO users_note ( user_id, movie_id, note) VALUES( :user_id, :movie_id, NULL)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $query->bindValue(':movie_id',$movie_id,PDO::PARAM_INT);
    $query ->execute();

   
        echo "le film a bien été ajouté!!!";
        die();

}      


// redirection vers la page qui affiche les films que cet utilisateur veut voir 


header('Location:listing_film_a_voir.php ');
?>

