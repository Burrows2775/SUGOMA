<?php
session_start(); 

if (!isset($_SESSION['mot_secret'])) {
    $file = file("mots.txt");
    $motDuJour = trim($file[random_int(0, count($file)-1)]);
    $_SESSION['mot_secret'] = $motDuJour;
}

$motDuJour = $_SESSION['mot_secret'];
$longueurMot = strlen($motDuJour);
$nbrChances = 5;
?>

<!DOCTYPE html>
<html lang="en">
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
    
    <?php include 'tableau.php'; ?>
    <?php include 'keyboard.php'; ?>

    <script>
        const LONGUEUR_MOT = <?php echo $longueurMot; ?>;
        let firstLetter = <?php echo "'" . str_split(trim($motDuJour))[0] . "'"; ?>;
    </script>
    <script src="script.js"></script>

</body>