<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de la question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="mb-4">Suppression d'une question</h1>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM questions WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            echo "<div class='alert alert-success shadow-lg p-3 mb-4 rounded' role='alert'>
                    ✅ La question a été supprimée avec succès !
                  </div>";
        } else {
            echo "<div class='alert alert-danger shadow-lg p-3 mb-4 rounded' role='alert'>
                    ❌ Aucune question spécifiée !
                  </div>";
        }
        ?>

        <a href="lister_questions.php" class="btn btn-primary btn-lg">🔙 Retour à la liste des questions</a>
    </div>
</body>
</html>
