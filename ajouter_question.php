<?php
include('db.php');

$message = "";
$question_id = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $reponse_attendue = $_POST['reponse_attendue'];
    $message_succes = $_POST['message_succes'];
    $message_mauvaise_reponse = $_POST['message_mauvaise_reponse'];

    $sql = "INSERT INTO questions (question, reponse_attendue, message_succes, message_mauvaise_reponse)
            VALUES (:question, :reponse_attendue, :message_succes, :message_mauvaise_reponse)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':question' => $question,
        ':reponse_attendue' => $reponse_attendue,
        ':message_succes' => $message_succes,
        ':message_mauvaise_reponse' => $message_mauvaise_reponse
    ]);

    $question_id = $pdo->lastInsertId();

    $lien_question = "repondre_question.php?id=" . $question_id;

    $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    ✅ La question a été ajoutée avec succès !  
                    <br>
                    <a href='$lien_question' class='btn btn-primary mt-2'>📝 Accéder à la question</a>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            width: 100%;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
            background-color: #218838;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Ajouter une question</h1>

    <?= $message; ?>

    <div class="card bg-white shadow-sm p-4">
        <form action="ajouter_question.php" method="post">
            <div class="form-group">
                <label for="question"><strong>📌 Question :</strong></label>
                <input type="text" id="question" name="question" class="form-control" placeholder="Entrez votre question ici..." required>
            </div>

            <div class="form-group">
                <label for="reponse_attendue"><strong>✅ Réponse attendue :</strong></label>
                <input type="text" id="reponse_attendue" name="reponse_attendue" class="form-control" placeholder="Entrez la bonne réponse..." required>
            </div>

            <div class="form-group">
                <label for="message_succes"><strong>🎉 Message de succès :</strong></label>
                <input type="text" id="message_succes" name="message_succes" class="form-control" placeholder="Message en cas de bonne réponse..." required>
            </div>

            <div class="form-group">
                <label for="message_mauvaise_reponse"><strong>❌ Message de mauvaise réponse :</strong></label>
                <input type="text" id="message_mauvaise_reponse" name="message_mauvaise_reponse" class="form-control" placeholder="Message en cas de mauvaise réponse..." required>
            </div>

            <button type="submit" class="btn btn-success btn-custom">➕ Ajouter la question</button>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">🏠 Retour à l'accueil</a>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
