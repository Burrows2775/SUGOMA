<?php

// include 'util/conforme.php';

session_start(); 

if (!isset($_SESSION['progression']['mot_secret'])) {

    $fichierMots = fopen('mots.txt', "r");
    if ($fichierMots === false) {
        throw new RuntimeException('Impossible d\'ouvrir le fichier');
    }

    $nbMot = random_int(1,167454);
    $compteur = 0;

    while (($line = fgets($fichierMots)) !== false && $compteur < $nbMot) {
        $line = rtrim($line, "\n\r");
        $compteur++;
    }

    $_SESSION['progression']['mot_secret'] = rtrim($line, "\n\r");
    $_SESSION['progression']['longueur_mot'] = strlen($_SESSION['progression']['mot_secret']);

    fclose($fichierMots);

}

$nbrChances = 5;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUGOMA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <p class="title">SUGOMA</p>
        <p>LA COPIE DU SUTOM DE MATTEO</p>
    </header>

    <button id="reset">Passer</button>
    
    <?php include 'error.php'; ?>
    <?php include 'tableau.php'; ?>
    <?php include 'keyboard.php'; ?>

    <script>
        const LONGUEUR_MOT = <?php echo $longueurMot; ?>;
        let firstLetter = <?php echo "'" . str_split(trim($_SESSION['progression']['mot_secret']))[0] . "'"; ?>;
    </script>
    <script src="script.js"></script>

</body>