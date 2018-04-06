<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

if(!empty($_GET['slug']))  {

    //protection XSS
    $slug = trim(strip_tags($_GET['slug']));

    //REQUETE SQL
    $sql = "SELECT * FROM movies_full WHERE slug = :slug";
    
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug, PDO::PARAM_STR);
    // exécuter la requete
    $query ->execute();
 
    $movie = $query->fetch();
    $slug = $_GET['slug'];

    if(!empty($movie)){

    }else{
        die('404');
    }
        
}else{
    //fausse redirection
    die('404');
}



include('inc/header.php'); 
?>
    <div class="container">
        <img src="posters/<?php echo $movie['id'] ?>.jpg" alt=""></a>
        <p class='title'>Titre du film: <?php echo $movie['title']; ?></p>
        <p class='slug'>Slug: <?php echo $movie['slug']; ?></p>
        <p class='year'>Année: <?php echo $movie['year']; ?></p>
        <p class='genres'>Genres: <?php echo $movie['genres']; ?></p>
        <p class='plot'>Pitch: <?php echo $movie['plot']; ?></p>
        <p class='directors'>Réalisateur: <?php echo $movie['directors']; ?></p>
        <p class='cast'>Casting: <?php echo $movie['cast']; ?></p>
        <p class='writers'>Scénaristes: <?php echo $movie['writers']; ?></p>
        <p class='runtime'>Durée du film: <?php echo $movie['runtime']; ?></p>
        <p class='mpaa'>Motion Picture Association of America: <?php echo $movie['mpaa']; ?></p>
        <p class='rating'>Note: <?php echo $movie['rating']; ?></p>
        <p class='popularity'>Popularité: <?php echo $movie['popularity']; ?></p>
        <p class='modified'>modifié le: <?php echo $movie['modified']; ?></p>
        <p class='created'>créé le: <?php echo $movie['created']; ?></p>
        <p class='poster_flag'>Affiche du film: <?php echo $movie['poster_flag']; ?></p>

        <a href="details.php?slug=<?php echo $movie['id'];?>">
        
    </div>



    <!-- - Bouton « à voir » -->
    <!-- - Bouton "Retrait" pour supprimer le film à voir de la liste     -->
    <!-- faire une condition pour que le bouton s'affiche que si l'user est connecté -->
    <?php if(isLogged()){ ?>
        <a href="ajoutfilm.php?id=<?php echo $movie['id']; ?>">Film à ajouter</a>
        <a href="ajoutfilm.php?id=<?php echo $movie['id']; ?>">Film à retirer</a>
    <?php }
    ?>

<?php
include('inc/footer.php');
?>
  


     