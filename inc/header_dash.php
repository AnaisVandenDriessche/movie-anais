<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Movie Anaïs</title>
</head>
<body>

  <div class="main header ">
  
      <header>
        <h1>Backoffice</h1>
        

        <?php if(isLogged()){ ?>
            <p>Connecté en tant que : <?php echo $_SESSION['user']['pseudo']; ?></p>
            <a href="deconnexion.php"> Déconnexion </a>
            <a href="profil.php"> Mon profil </a>
           <?php }
        ?>
        
        
      </header>
