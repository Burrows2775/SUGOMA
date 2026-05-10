<?php

// include 'util/conforme.php';

session_start(); 

$alphabet = array('A','B','C','D','E','F','G','H','I','J','L','M','N','O','P','Q','R','S','T','U','V');

if (!isset($_SESSION['progression']['mot_secret'])) {

    $fichierMots = file('db/devinable/dico-' . $alphabet[random_int(0,20)] . '.txt');

    if ($fichierMots === false) {
        throw new RuntimeException('Impossible d\'ouvrir le fichier');
    }

    $line = $fichierMots[random_int(0,(count($fichierMots) - 1))];

    $_SESSION['progression']['mot_secret'] = rtrim($line, "\n\r");
    $_SESSION['progression']['longueur_mot'] = strlen($_SESSION['progression']['mot_secret']);
    $_SESSION['progression']['nbEssais'] = 0;

}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUGOMA</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <p class="title">SUGOMA</p>
        <p>LA COPIE DU SUTOM DU sluac</p>
    </header>

    <button id="reset">Passer</button>
    
    <?php include 'include/error.php'; ?>
    <?php include 'include/tableau.php'; ?>
    <?php include 'include/keyboard.php'; ?>

    <script>
        const LONGUEUR_MOT = <?php echo $longueurMot; ?>;
        let firstLetter = <?php echo "'" . str_split(trim($_SESSION['progression']['mot_secret']))[0] . "'"; ?>;
        let sauvegarde = <?php if (isset($_SESSION['progression']['sauvegarde'])) {echo 1;} else {echo 0;} ?>;
    </script>
    <script src="scripts/script.js"></script>

</body>