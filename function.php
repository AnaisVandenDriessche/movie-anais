<?php
function debug($array){
  echo '<pre>';
  print_r($array);
  echo'</pre>';
}

function getImageMovie($id,$title){
  $img = "<img src="posters'.$id.'.jpg" alt="'.$title.'"/>';
  return $img;
}
 ?>
