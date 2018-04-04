<?php
include('inc/pdo.php');
include('inc/function.php');


include('inc/header.php'); 
?>
<a href="index.php">Retour vers page accueil</a>

<h1>Mes films à voir</h1>

<?php
if(!empty($_GET['slug'])) {
    $id = $_GET['slug'];

    $sql = "SELECT id FROM movies_full WHERE slug = :slug";
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug,PDO::PARAM_INT);
    $query->execute();
    $reve = $query->fetch();
 
}

// afficher la liste des films à voir classée en fonction de la date d'ajout

