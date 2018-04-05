<?php
include('inc/function.php');
include('inc/pdo.php');


    // Requette nbre de film
    $sql = "SELECT COUNT(*)
    FROM movies_full";
    $query = $pdo->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();

    // Requette nbre d'utilisateur
    $sql = "SELECT COUNT(*)
    FROM users";
    $query = $pdo->prepare($sql);
    $query->execute();
    $count_users = $query->fetchColumn();
    

    // Requette 5 utilisateur inscrit
    $sql = "SELECT COUNT(*)
    FROM users";
    $query = $pdo->prepare($sql);
    $query->execute();
    $count_users = $query->fetchColumn();
    // debug($count);



include('inc/header_dash.php');?>
<!--  Main-Contain -->
    <div class="container">
        <h3>Liste des films :</h3>
        <a href="film_consultation.php">Voir</a>        
    </div>
    <hr>
    <div class="container">
        <h2>Statistique</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <tr>
                    <th scope="col">Nombre de films</th>
                    <th scope="col">Nombre d'utilisateur</th>
                    <th scope="col">5 Utilisateurs inscrit par semaine</th>
                    <th scope="col">Les 30 films les plus ajoutés dans la liste à voir</th>
                     
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $count_users;?></td>
                    <td>5 Utilisateur inscrit par semaine</td>
                    <td>Les 30 films les plus ajoutés dans la liste à voir</td>              
                </tr>
            </tbody>
        </table>
    </div>
     

<!-- End .Main-Contain -->

<?php
include('inc/footer_dash.php');
?>