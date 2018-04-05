<?php
include('inc/functions.php');
include('inc/pdo.php');

// On fait la requette nbre de film
    $sql = "SELECT * FROM movies_full";
    $query = $pdo->prepare($sql);
    $query->execute();
    $films = $query->fetchAll();

    // Query statistique nbre de film
    $sql = "SELECT COUNT(*)
            FROM movies_full";
    $query = $pdo->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();
    // debug($count);

    
    // Query
include('inc/header_dash.php');?>

<!--  Main-Contain -->
    <div class="container">
        <h3>Tous mes articles :</h3>
    
        <table class="table table-hover">         
            <thead>
                <tr class="table-info">
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                    <th scope="col">Statut</th>        
                </tr>
            </thead>
            <tbody>
            
            <?php // Recuperation de la requette dans boucle foreach
                foreach ($articles as $article) { ?>
                <tr>
                    <td>
                        <p><?php echo $article['title']?></p>
                        <span><a href="editpost.php?id=<?php echo $article['id']?>">Editer </a></span>
                    </td>
                    <td>
                        <p class="font-italic"><?php echo $article['auteur']?></p>
                        <span></span>
                    </td>
                    <td>
                        <p class="font-italic"><?php echo $article['created_at']?></p>
                    </td>
                    <td>
                        <p><?php echo $article['status']?></p>
                    </td>                  
                </tr>
            </tbody>
                <?php }?>
            </table>
            </div>         
    </div>
    <hr>
    <div class="container fluid1 ">
        <h2>Statistique</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre d'article</th>
                    <th scope="col">Nombre de commentaire</th>
                    <th scope="col">Nombre d'auteur</th>
                    <th scope="col">Action</th>    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $count_comments;?></td>
                    <td><?php echo $count_auteur;?></td>
                </tr>
            </tbody>
        </table>

        <!-- Liste des auteurs -->
        <!-- <a href="" class="list-group-item list-group-item-action active"><h3>Nos auteurs</p></h3> -->
        <ul>
        <?php
        foreach ($auteurs as $auteur) { ?>    
        <div class="container">
            <li><a href="#" class="list-group-item list-group-item-action"><?php echo $auteur['auteur']; ?></a></li>
        </div>
       
       <?php } ?>
    </ul>
    </div>
     

<!-- End .Main-Contain -->

<?php
include('inc/footer_dash.php');
?>