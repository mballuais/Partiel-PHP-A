<?php
include('db.php');

$sql = "UPDATE questions SET taux_reussite = 
            CASE 
                WHEN total_reponses > 0 THEN (bonnes_reponses / total_reponses) * 100 
                ELSE 0 
            END";
$pdo->query($sql);

$order = isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'ASC' : 'DESC';
$sql = "SELECT * FROM questions ORDER BY taux_reussite $order";
$stmt = $pdo->query($sql);
$questions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des questions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            max-width: 900px;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef; 
        }
        .btn-custom {
            width: 100%;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        .badge {
            font-size: 14px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">📜 Liste des Questions</h1>

    <div class="text-center mb-3">
        <a href="lister_questions.php?sort=asc" class="btn btn-secondary btn-sm">⬆️ Trier par taux croissant</a>
        <a href="lister_questions.php?sort=desc" class="btn btn-secondary btn-sm">⬇️ Trier par taux décroissant</a>
    </div>

    <table class="table table-striped table-hover shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>📝 Question</th>
                <th>🏆 Taux de réussite (%)</th>
                <th>📊 Total Réponses</th>
                <th>✅ Bonnes Réponses</th>
                <th>⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($question['question']); ?></td>
                    <td>
                        <span class="badge <?php echo ($question['taux_reussite'] >= 50) ? 'badge-success' : 'badge-danger'; ?>">
                            <?php echo number_format($question['taux_reussite'], 2); ?>%
                        </span>
                    </td>
                    <td><span class="badge badge-info"><?php echo $question['total_reponses']; ?></span></td>
                    <td><span class="badge badge-primary"><?php echo $question['bonnes_reponses']; ?></span></td>
                    <td>
                        <a href="repondre_question.php?id=<?php echo $question['id']; ?>" class="btn btn-success btn-sm btn-custom">✅ Répondre</a>
                        <a href="supprimer_question.php?id=<?php echo $question['id']; ?>" class="btn btn-danger btn-sm btn-custom">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

</body>
</html>
