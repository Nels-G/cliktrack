<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=sql107.infinityfree.com; dbname=if0_37730030_viewlink', 'if0_37730030', '7MN2uMIBJoCQT');

// Définir le fuseau horaire de Togo (GMT+1)
date_default_timezone_set('Africa/Lome');

// Vérifier si le paramètre linkid est dans l'URL (en minuscules)
if (isset($_GET['linkid'])) {
    $linkId = trim(htmlspecialchars($_GET['linkid']));
    echo "Paramètre linkid reçu : " . $linkId . "<br>";
} else {
    echo "Le paramètre linkid n'est pas passé dans l'URL.<br>";
    echo "Contenu de \$_GET :<br>";
    print_r($_GET);  // Affiche tout le contenu de la variable $_GET pour le débogage
    exit();  
}

// Définir le lien en fonction du linkId avec le contributor id
$links = [
        'az-900' => 'https://learn.microsoft.com/en-gb/training/courses/az-900t00?wt.mc_id=studentamb_350176',
        'az-104' => 'https://learn.microsoft.com/en-gb/training/courses/az-104t00?wt.mc_id=studentamb_350176',
        'az-204' => 'https://learn.microsoft.com/en-us/training/courses/az-204t00?wt.mc_id=studentamb_350176',
        'az-400' => 'https://learn.microsoft.com/en-gb/training/courses/az-400t00?wt.mc_id=studentamb_350176',
        'az-500' => 'https://learn.microsoft.com/en-us/training/courses/az-500t00?wt.mc_id=studentamb_350176',
        'az-140' => 'https://learn.microsoft.com/en-us/training/courses/az-140t00?wt.mc_id=studentamb_350176',
        'az-305' => 'https://learn.microsoft.com/en-us/training/courses/az-305t00?wt.mc_id=studentamb_350176',
        'dp-100' => 'https://learn.microsoft.com/en-us/training/courses/dp-100t00?wt.mc_id=studentamb_350176',
        'dp-420' => 'https://learn.microsoft.com/en-us/training/courses/dp-420t00?wt.mc_id=studentamb_350176',
        'mb-200' => 'https://learn.microsoft.com/en-us/training/courses/mb-200t00?wt.mc_id=studentamb_350176',
        'mb-300' => 'https://learn.microsoft.com/en-us/training/courses/mb-300t00?wt.mc_id=studentamb_350176',
        'mb-910' => 'https://learn.microsoft.com/en-us/training/courses/mb-910t00?wt.mc_id=studentamb_350176',
        'mb-920' => 'https://learn.microsoft.com/en-us/training/courses/mb-920t00?wt.mc_id=studentamb_350176',
        'pl-900' => 'https://learn.microsoft.com/en-us/training/courses/pl-900t00?wt.mc_id=studentamb_350176',
        'pl-100' => 'https://learn.microsoft.com/en-us/training/courses/pl-100t00?wt.mc_id=studentamb_350176',
        'pl-400' => 'https://learn.microsoft.com/en-us/training/courses/pl-400t00?wt.mc_id=studentamb_350176',
        'sc-900' => 'https://learn.microsoft.com/en-us/training/courses/sc-900t00?wt.mc_id=studentamb_350176',
        'sc-200' => 'https://learn.microsoft.com/en-us/training/courses/sc-200t00?wt.mc_id=studentamb_350176',
        'sc-300' => 'https://learn.microsoft.com/en-us/training/courses/sc-300t00?wt.mc_id=studentamb_350176',
        'sc-400' => 'https://learn.microsoft.com/en-us/training/courses/sc-400t00?wt.mc_id=studentamb_350176',
];

// Vérifier si le linkid existe dans notre tableau de liens
if (array_key_exists($linkId, $links)) {
    $link = $links[$linkId];

    // Enregistrer l'adresse IP et le clic dans la base de données
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM clicks WHERE ip = :ip AND link = :link");
    $stmt->execute(['ip' => $ip, 'link' => $link]);
    $clickCount = $stmt->fetchColumn();

    // Si l'IP n'a pas encore cliqué sur ce lien, l'enregistrer dans la base de données
    if ($clickCount == 0) {
        $stmt = $pdo->prepare("INSERT INTO clicks (ip, time, link) VALUES (:ip, :time, :link)");
        $stmt->execute(['ip' => $ip, 'time' => $time, 'link' => $link]);
    }

    // Redirection vers le lien du cours
    header("Location: $link");
    exit();
} else {
    // Si aucun cours n'est trouvé, rediriger vers la page d'accueil de Microsoft Learn avec votre Contributor ID
    $defaultLink = 'https://learn.microsoft.com/en-gb/?wt.mc_id=studentamb_350176';

    // Enregistrer l'adresse IP et le clic pour cette redirection par défaut dans la base de données
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM clicks WHERE ip = :ip AND link = :link");
    $stmt->execute(['ip' => $ip, 'link' => $defaultLink]);
    $clickCount = $stmt->fetchColumn();

    // Si l'IP n'a pas encore cliqué sur ce lien, l'enregistrer dans la base de données
    if ($clickCount == 0) {
        $stmt = $pdo->prepare("INSERT INTO clicks (ip, time, link) VALUES (:ip, :time, :link)");
        $stmt->execute(['ip' => $ip, 'time' => $time, 'link' => $defaultLink]);
    }

    // Redirection vers la page d'accueil avec votre Contributor ID
    header("Location: $defaultLink");
    exit();
}
?>
