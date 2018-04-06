<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootsrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="assets/style_dash.css">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One" rel="stylesheet">

    <title>Backoffice</title>
</head>
<body>

  <div class="main header ">
      <header>
          <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand" href="dashboard.php">Backoffice</a>
            <ul class="nav justify-content-end ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li> 
                <li class="nav-item">
                    <?php if(isLogged()){ ?>
                    <p>Connecté en tant que : <?php echo $_SESSION['user']['pseudo']; ?></p>
                        <a class="nav-link" href="deconnexion.php"> Déconnexion </a>
                        <a class="nav-link" href="profil.php"> Mon profil </a>
                     <?php }
                ?>
                </li>
            </ul>
          </nav>
        </header>
        <section class="jumbotron text-center">
            <div class="container">
                <!-- <h1 class="jumbotron-heading"> Backoffice 2.0</h1>
                <p class="lead text-muted"></p> -->
                <!-- <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p> -->
            </div>
        </section>
