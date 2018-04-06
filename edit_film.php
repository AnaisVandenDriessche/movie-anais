<?php
include('inc/functions.php');
include('inc/pdo.php');
$error = array();$success = false;

// Trouver le GET
if(!empty($_GET['slug']) && is_numeric($_GET['slug'])){
    $slug = $_GET['slug'];
    $sql = "SELECT * FROM movies_full WHERE slug = :slug";
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug,PDO::PARAM_STR);
    $query->execute();
    $movie = $query->fetch();
    // debug($movie);
    if(empty($movie)) {
        die('404');
    }

} else {
    die('404');
}

// Soumission form 
if(!empty($_POST['submitted'])){
    // Protection des failles XSS
    $title = clean($_POST['title']);
    $auteur = clean($_POST['auteur']);
    $content = clean($_POST['content']);
    $status = clean($_POST['status']);

    
    // Validation champ   
    // Titre
    if(!empty($title)) {
        if(strlen($title )< 3) {
          $error['title'] = 'Minimum 3 caracteres';
        } elseif(strlen($title) > 255) {
          $error['title'] = 'maximum 255 caracteres';
        }
      } else {
        $error['title'] = 'Veuillez renseigner ce champ';
      }

      // Auteur
    if(!empty($auteur)) {
        if(strlen($auteur )< 5) {
          $error['auteur'] = 'Minimum 5 caracteres';
        } elseif(strlen($auteur) > 20) {
          $error['auteur'] = 'maximum 20 caracteres';
        }
      } else {
        $error['auteur'] = 'Veuillez renseigner ce champ';
      }

      // Article (Content)
    if(!empty($content)) {
        if(strlen($content )< 100) {
          $error['content'] = 'Minimum 100 caracteres';
        } elseif(strlen($content) > 10000) {
          $error['content'] = 'maximum 10000 caracteres';
        }
      } else {
        $error['content'] = 'Veuillez renseigner ce champ';
      }

    // Status
    $optionArray = array("actif", "inactif");

    if (!in_array($status, $optionArray)) {
    $error['status'] = "Choisir une option";
    }


    // if pas error
    if(count($error) == 0) {
    $success = true;

    // Si pas d'errerur on insert notre nouvel article
    $sql = "UPDATE articles SET title = :title, content = :content, auteur = :auteur, status = :status, update_at = NOW() where id = :id ";
            $query = $pdo->prepare($sql);

            // protection injection sql;
            $query->bindValue(':id',$id,PDO::PARAM_INT);            
            $query->bindValue(':title',$title,PDO::PARAM_STR);
            $query->bindValue(':content',$content,PDO::PARAM_STR);
            $query->bindValue(':auteur',$auteur,PDO::PARAM_STR);
            $query->bindValue(':status',$status,PDO::PARAM_STR);
            $query->execute();

    } 
    header('Location: dashboard.php');             
    
}
// Fin Soumission du Form

include('inc/header_dash.php'); ?>

<!-- main-content -->
    <div class="container">
            <!-- Formulaire -->
        <form action="" method="post">
            <div class="row row2">
                <div class="col">
                    <label for="title">Titre du film :</label>
                    <input type="text" class="form-control" name="title" value="<?php if(!empty($_POST['title'])){echo $_POST['title']; } else {echo $movie['title'];}?>">
                    <span class="error text-muted"><?php if(!empty($error['title'])) {echo $error['title']; } ?></span> 
                </div>

                <div class="col">
                    <label for="year">Date :</label>
                    <input type="text" class="form-control" name="year" value="<?php if(!empty($_POST['year'])){echo $_POST['year']; } else {echo $movie['year'];}?>">
                    <span class="error text-muted"><?php if(!empty($error['year'])) {echo $error['year']; } ?></span>    
                </div>
                <div class="col">
                    <label for="genres">Genre</label>
                    <input type="text" class="form-control" name="genres" value="<?php if(!empty($_POST['genres'])){echo $_POST['genres']; } else {echo $movie['genres'];}?>">
                    <span class="error text-muted"><?php if(!empty($error['genres'])) {echo $error['genres']; } ?></span>    
                </div>

                <div class="col">
                    <label for="rating">Note :</label>
                    <input type="text" class="form-control" name="rating" value="<?php if(!empty($_POST['rating'])){echo $_POST['rating']; } else {echo $movie['rating'];}?>">
                    <span class="error text-muted"><?php if(!empty($error['rating'])) {echo $error['rating']; } ?></span>    
                </div>
                
            </div>

            <div class="form-group">
                <label for="content">Tapez votre article :</label>
                <textarea class="form-control" rows="10" name="content" id="content" ><?php if(!empty($_POST['content'])){echo $_POST['content']; } else {echo $article['content'];}?></textarea>
                <span class="error text-muted"><?php if(!empty($error['content'])) {echo $error['content'];} ?> </span>     
            </div>

                <input type="submit" class="btn btn-info btn-lg btn-block" name="submitted" value="Enregistrer modification">
            
        </form>
    </div>


<?php
// redirection index.php



include('inc/footer.php');

?>