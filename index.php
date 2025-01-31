<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape Game - Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border-radius: 15px; 
        }
        .card:hover {
            transform: scale(1.05); 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?> 

<div class="container my-5 text-center">
    <h1 class="mb-4">Bienvenue dans l'Escape Game en ligne !</h1>
    <p class="lead text-muted">Testez vos connaissances et défiez vos amis en répondant aux questions d'énigmes !</p>

    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ajouter une question</h5>
                    <p class="card-text">Ajoutez des énigmes et testez la réflexion de vos amis !</p>
                    <a href="ajouter_question.php" class="btn btn-primary">
                        ➕ Ajouter une question
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">    
                <div class="card-body">
                    <h5 class="card-title">Lister les questions</h5>
                    <p class="card-text">Voir toutes les questions et testez vos connaissances !</p>
                    <a href="lister_questions.php" class="btn btn-primary">
                        📋 Voir les questions
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
