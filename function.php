<?php
function debug($array){
  echo '<pre>';
  print_r($array);
  echo'</pre>';
}

function getImageMovie($id,$title){
  $img = '<img src="posters.php.$id.'.jpg" alt="'.$title.'"/>';
  return $img;
}
 ?>