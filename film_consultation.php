<?php
include('inc/function.php');
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
        <h3>Tous les films de ma Vidéothèque :</h3>
        <table class="table table-hover">         
            <thead>
                <tr class="table-info">
                    <th scope="col">Titre</th>
                    <th scope="col">Date</th>
                    <th scope="col">Genres</th>
                    <th scope="col">Note</th>        
                           
                </tr>
            </thead>
            <tbody>
                <?php // Recuperation de la requette dans boucle foreach
                foreach ($films as $film) { ?>
                <tr>
                    <td>
                        <p><?php echo $film['title']?></p>
                        <span><a href="editpost.php?id=<?php echo $film['id']?>">Editer </a></span>
                    </td>
                    <td>
                        <p class="font-italic"><?php echo $film['year']?></p>
                        <span></span>
                    </td>
                    <td>
                        <p class="font-italic"><?php echo $film['genres']?></p>
                    </td>
                    <td>
                        <p><?php echo $film['rating']?></p>
                    </td>                  
                </tr>
            </tbody>
                <?php }?>
        </table>
            </div>         
    </div>
    <hr>
   
<!-- End .Main-Contain -->

<?php
include('inc/footer_dash.php');
?>