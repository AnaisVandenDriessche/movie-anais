<?php 


// Function debug
function debug($array)
{
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}

// ===============================
// Protection faille xxs
function clean($a)
{
    return trim(strip_tags($a));
}
// Exemple : $title = clean($_POST['title']);


// ===============================
// Error message form
function errorMessageForm ($a,$b)
{
   echo '<span class="error text-danger">';
    if(!empty($a[$b])) {echo $a[$b]; }
    echo '</span>' ;     

}
/*Appel de la fonction
========================
exemple: 
--------
    errorMessageForm($error, 'message')
*/

// ============================
// Validation champs 
function validateChamp ($value,$error,$key,$min,$max)
{
    if(!empty($value)) {
        if(strlen($value)< $min) {
            $error[$key] = 'Minimum '.$min.' caractères';
        } elseif(strlen($value) > $max) {
            $error[$key] = 'Maximum '.$max.' caractères';
        }
    } else {
        $error[$key] = 'Veuillez renseigner ce champ';
    }
    return $error;
}
/* exemple
==========
        $error = validateChamp($pseudo,$error,'pseudo',3,20);
*/

// ===========================
// Créer un random
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/////////////////////////////////////////

//Loggé return true or false
function isLogged()
{
    if(!empty($_SESSION['user'])){
        if(!empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id'])){
            if(!empty($_SESSION['user']['pseudo']) && !empty($_SESSION['user']['role']) && !empty($_SESSION['user']['ip']) ){
                $ip = $_SERVER['REMOTE_ADDR'];
                if($ip == $_SESSION['user']['ip']){
                    return true;
                }
            }

        }

    }
    return false;
}

// Pagination

function paginationIdea($page,$num,$count) {
    echo '<div class="">';
    echo '<ul class="pagination justify-content-center">';
	if ($page > 1){
        echo '<li class="page-item">
                <a href="index.php?page=' . ($page - 1) . '" class="page-link btn btn-primary" tabindex="-1">Précédent</a></li>';
    }
    
 	//n'affiche le lien vers la page suivante que s'il y en a une
 	//basée sur le count() de MYSQL
    if ($page*$num < $count) {   
        echo '<li class="page-item">
                <a href="index.php?page=' . ($page + 1) . '" class="page-link btn btn-primary">Suivant</a></li>';
    }

    echo '</ul>';    
    echo '</div>';
}

?>