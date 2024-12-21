<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=sql107.infinityfree.com; dbname=if0_37730030_viewlink', 'if0_37730030', '7MN2uMIBJoCQT');

// Définir le fuseau horaire de Togo (GMT+1)
date_default_timezone_set('Africa/Lome');

// Récupérer les statistiques de la base de données
$stmt = $pdo->prepare("SELECT link, COUNT(*) as click_count FROM clicks GROUP BY link");
$stmt->execute();
$clicks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nombre total de clics
$stmt_total = $pdo->prepare("SELECT COUNT(*) as total_clicks FROM clicks");
$stmt_total->execute();
$totalClicks = $stmt_total->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Clics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #ffffff;
        }
        .total {
            margin-top: 20px;
            font-size: 1.2em;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Suivi des Clics</h1>

    <table>
        <thead>
            <tr>
                <th>Lien</th>
                <th>Nombre de Clics</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les résultats de la requête pour chaque lien
            foreach ($clicks as $click) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($click['link']) . "</td>";
                echo "<td>" . htmlspecialchars($click['click_count']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Afficher le total des clics -->
    <div class="total">
        <p>Total des clics sur tous les liens : <?php echo $totalClicks; ?></p>
    </div>

</body>
</html>
