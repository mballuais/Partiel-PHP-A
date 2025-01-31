<?php
include('db.php');

if (isset($_GET['id']) && isset($_GET['correct'])) {
    $id = $_GET['id'];
    $reponse_correcte = ($_GET['correct'] == "1");

    $sql = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $question = $stmt->fetch();

    if (!$question) {
        die("Question non trouvée.");
    }
} else {
    die("Paramètres invalides.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center">
        <h1 class="mt-5">Résultat</h1>

        <?php if ($reponse_correcte): ?>
            <div class="alert alert-success">
                <h3>✅ Bonne réponse !</h3>
                <p><?php echo htmlspecialchars($question['message_succes']); ?></p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <h3>❌ Mauvaise réponse !</h3>
                <p><?php echo htmlspecialchars($question['message_mauvaise_reponse']); ?></p>
                <p><strong>La bonne réponse était :</strong> <?php echo htmlspecialchars($question['reponse_attendue']); ?></p>
            </div>
        <?php endif; ?>

        <a href="lister_questions.php" class="btn btn-primary mt-3">Retour à la liste des questions</a>
    </div>
</body>
</html>
