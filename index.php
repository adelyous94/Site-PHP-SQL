<?php
    session_start();
    require_once('controleur/controleur.class.php');
    //creation d'une instance de la classe Controleur
    $unControleur = new Controleur (); 


if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    session_destroy(); // Détruit toutes les variables de session
    header("Location: index.php?page=1"); // Redirige vers l'accueil
    exit(); // S'assurer que le script ne continue pas
}

if (isset($_GET['page']) && $_GET['page'] === 6 && isset($_SESSION['email'])) {
    header("Location: index.php?page=1"); // Redirige vers l'accueil
    exit(); // S'assurer que le script ne continue pas
}


    // Gestion de la mise à jour d'un pays
    if (isset($_POST['Modifier']) && $_GET['page']==4) {
        // Mise à jour des informations du pays
        $unControleur->updatePays($_POST);
        echo "<br> Le pays a été modifié avec succès ! <br>";
        // Redirection pour éviter de soumettre plusieurs fois le formulaire
        header("Location: index.php?page=4");
    }
    if (isset($_POST['Modifier']) && $_GET['page']==3) {
        // Mise à jour des informations du pays
        $unControleur->updatePays($_POST);
        echo "<br> Le pays a été modifié avec succès ! <br>";
        // Redirection pour éviter de soumettre plusieurs fois le formulaire
        header("Location: index.php?page=3");
    }

    // Gestion de la mise à jour d'un projet
    if (isset($_POST['Modifier']) && $_GET['page']==2) {
        // Mise à jour des informations du pays
        $unControleur->updateProjet($_POST);
        echo "<br> Le Projet a été modifié avec succès ! <br>";
        // Redirection pour éviter de soumettre plusieurs fois le formulaire
        header("Location: index.php?page=2");


    }
?>
<?php
                    // Vérification de la soumission du formulaire
                    if (isset($_POST['Connexion'])) {
                        $email = $_POST['email'];
                        $mdp = $_POST['mdp'];

                        // On vérifie la connexion via un contrôle
                        $unUser = $unControleur->verifConnexion($email, $mdp); 
                        if ($unUser) {
                            // Si l'utilisateur est validé, on stocke les informations en session
                            $_SESSION['nom'] = $unUser['nom'];
                            $_SESSION['prenom'] = $unUser['prenom'];
                            $_SESSION['email'] = $unUser['email'];
                            $_SESSION['role'] = $unUser['role'];
                            header("Location: index.php?page=1"); // Redirige vers l'accueil

                            // Redirection après connexion réussie
                            exit(); // Pour arrêter le script et éviter que le reste de la page soit exécuté
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Vérifiez vos identifiants.</div>";
                        }
                    }


                    ?>

<!DOCTYPE html>  
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Association Espoir et Solidarité</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        /* Style général de la page */
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f9f9f9; /* Couleur de fond claire */
            padding-top: 56px; /* Espace pour que le contenu ne soit pas masqué par la navbar fixe */
        }
 
        /* En-tête avec image de fond */
        .header-banner {
            background: url('image/banniere2.jpg') no-repeat center center/cover; /* Image de fond */
            position: relative;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .header-banner h1 {
            font-size: 4rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Ombre pour le texte */
        }
        .header-banner p {
            font-size: 1.5rem;
            margin-top: 10px;
            font-family: 'Lora', serif; /* Police stylée pour le slogan */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        .header-banner .btn {
            background-color: #ffffff; /* Rouge orangé */
            border: 2px solid black;
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .header-banner .btn:hover {
            background-color: #e64a19; /* Couleur plus foncée au survol */
        }

        /* Style de la barre de navigation */
        .navbar-custom {
            background-color: #ffffff; /* Beige clair */
        }
        .navbar-nav .nav-link {
            color: #333;
            font-size: 1.1rem;
        }
        .navbar-nav .nav-link:hover {
            color: #ff5722; /* Rouge orangé */
        }

        /* Sections */
        .section-padding {
            padding: 60px 0;
        }
        .mission-details {
            background-color: #ffffff; /* Orange pâle */
            border-radius: 10px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .mission-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .mission-text {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Style des témoignages */
        .testimonial {
            background-color: #e1f5fe; /* Bleu clair */
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .testimonial p {
            font-style: italic;
        }
        .testimonial h5 {
            margin-top: 10px;
            font-weight: bold;
        }

        /* Style des projets */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }

    </style>
</head>
<body>

    <!-- Barre de navigation Bootstrap fixée en haut de lécran -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=1">Accueil</a>
        <img src="image/logo.png" alt="Accueil" width="70" height="70" style="margin-right: 5px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=2">
                        <img src="image/nosprojets.png" alt="Projets" width="45" height="45" style="margin-right: 5px;"> Nos Projets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=3">
                        <img src="image/membres.png" alt="Membres" width="45" height="45" style="margin-right: 5px;"> Membres
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=4">
                        <img src="image/pays.png" alt="Pays" width="45" height="45" style="margin-right: 5px;"> Pays
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=5">
                        <img src="image/dons.png" alt="Dons" width="40" height="40" style="margin-right: 5px;"> Dons
                    </a>
                </li>'

                    <?php
    if (!isset($_SESSION['email'])){ echo'
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="index.php?page=6" style="margin-left: 10px;">Connexion</a>
                </li>';} 

    if (isset($_SESSION['email'])) {
        echo '
        <li class="nav-item">
            <a class="btn btn-danger" href="index.php?page=logout" style="margin-left: 10px;">
                <img src="image/deconnexion.png" alt="Deconnexion" width="20" height="20" style="margin-right: 5px;"> Déconnexion
            </a>
        </li>';}


                if (isset($_POST['Connexion'])) {
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        
        $unUser = $unControleur->verifConnexion($email, $mdp); 
        if($unUser){

            $_SESSION['nom']=$unUser['nom'];
            $_SESSION['prenom']=$unUser['prenom'];
            $_SESSION['email']=$unUser['email'];
            $_SESSION['role']=$unUser['role']; 



        }else {

            echo "<br> Verifiez vos identifiants";
        }
    }?>

            </ul>
        </div>
    </div>
</nav>


    <!-- En-tête avec image de fond -->
    <header class="header-banner">
        <h1>Association Espoir et Solidarité</h1>
        <p class="lead">Unis pour bâtir un avenir solidaire</p>
        <a href="index.php?page=2" class="btn">Découvrez Nos Projets</a>
    </header>

    <!-- Intégration de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    switch($page){
        case 1 : require_once("controleur/home.php"); break;
        case 2 : require_once("controleur/c_projets.php"); break;
        case 3 : require_once("controleur/c_membres.php"); break;
        case 4 : require_once("controleur/c_pays.php"); break;
        case 5 : require_once("controleur/c_dons.php"); break;
        case 6 : require_once("controleur/c_connexion.php"); break;
        case 'logout':
    session_destroy(); // Détruit toutes les variables de session
    header("Location: index.php?page=1"); // Redirige vers l'accueil
    exit();

    }
    ?>