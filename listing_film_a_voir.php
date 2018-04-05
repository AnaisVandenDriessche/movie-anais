<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');


if( isLogged()) {
 
  
  $user_id = $_SESSION['user']['id']; 

  $sql = "SELECT m.* ,u.note as note
          FROM users_note AS u 
          LEFT JOIN movies_full AS m 
          ON u.movie_id = m.id
          WHERE u.user_id = :id";

  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$user_id,PDO::PARAM_INT);
  $query->execute();
  $movies = $query->fetchAll();

  //debug($movies);

  if(empty($movies)) { die('404'); }


} else {
  die('404');
}

include('inc/header.php'); 
?><h4>Ma liste de films à regarder</h4>
<?php
foreach ($movies as $movie) {
?>
   
      <ul class="list-group">   
        <li class="list-group-item"><?php echo $movie['slug'];?></li>
        <li class="list-group-item"><?php echo $movie['genres'];?></li>
        <li class="list-group-item"><?php echo $movie['plot'];?></li>
      </ul>

<?php } ?>



<?php
include('inc/footer.php'); 
