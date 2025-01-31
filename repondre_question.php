<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $question = $stmt->fetch();

    if (!$question) {
        die("Question non trouvée.");
    }

    $taux_reussite = ($question['total_reponses'] > 0) ? ($question['bonnes_reponses'] / $question['total_reponses']) * 100 : 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $reponse_utilisateur = trim($_POST['reponse_utilisateur']);

        $reponse_correcte = (strtolower($reponse_utilisateur) == strtolower($question['reponse_attendue']));

        $sql = "UPDATE questions 
                SET total_reponses = total_reponses + 1, 
                    bonnes_reponses = bonnes_reponses + :is_correct 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':is_correct' => $reponse_correcte ? 1 : 0,
            ':id' => $id
        ]);

        $sql = "SELECT total_reponses, bonnes_reponses FROM questions WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stats = $stmt->fetch();

        $nouveau_taux_reussite = ($stats['total_reponses'] > 0) ? ($stats['bonnes_reponses'] / $stats['total_reponses']) * 100 : 0;

        $sql = "UPDATE questions SET taux_reussite = :taux WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':taux' => $nouveau_taux_reussite,
            ':id' => $id
        ]);

        header("Location: answer_question.php?id=$id&correct=" . ($reponse_correcte ? "1" : "0"));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre à une question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Répondre à une question</h1>

        <?php if (isset($question)): ?>
            <h3><?php echo htmlspecialchars($question['question']); ?></h3>

            <p><strong>Pourcentage de réussite :</strong> <?php echo number_format($taux_reussite, 2); ?>%</p>

            <form action="repondre_question.php?id=<?php echo $question['id']; ?>" method="post">
                <div class="form-group">
                    <label for="reponse_utilisateur">Votre réponse:</label>
                    <input type="text" id="reponse_utilisateur" name="reponse_utilisateur" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Valider</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
