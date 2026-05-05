<?php
session_start();

$motEcrit = str_split($_GET['motTape']);
$motSecret = str_split($_SESSION['progression']['mot_secret']);

if(!isset($_SESSION['progression']['repartition_lettres'])) {

    // c un peu bourrin de prendre tt l'alphabet mais g la flemme de faire plus opti
    $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $repartition = array();
    $compteur = 0;

    foreach($alphabet as $lettreAlpha) {
        foreach($motSecret as $lettreMot) {
            if ($lettreMot === $lettreAlpha) {
                $compteur++;
            }
        }
        $repartition += [$lettreAlpha => $compteur];
        $compteur = 0;
    }

    $_SESSION['progression']['repartition_lettres'] = $repartition;
    
}

// Verif si le mot est bien existant (cheh noé) -----------------------

$motEcritString = strtoupper(trim($_GET['motTape'])); 
$motEcrit = str_split($motEcritString); // On garde ton tableau pour la suite du code
$motSecret = str_split($_SESSION['progression']['mot_secret']);


$fichierMots = fopen('mots.txt', "r");
if ($fichierMots === false) {
    throw new RuntimeException('Impossible d\'ouvrir le fichier');
}

$motTrouve = false; 
while (($line = fgets($fichierMots)) !== false) {
    if (strtoupper(trim($line)) === $motEcritString) {
        $motTrouve = true;
        break; 
    }
}

fclose($fichierMots);

if (!$motTrouve) {
    echo json_encode('Nodico');
} else {

    $repartition = $_SESSION['progression']['repartition_lettres'];
    $resultat = array();
    $compteur = 0;
    $casesValides = array();

    // Verif lettres valides (cases rouges)
    foreach($motEcrit as $lettreMotEcrit) {
        if ($lettreMotEcrit == $motSecret[$compteur]) {
            $resultat += [$compteur+1 => "Valide"];
            array_push($casesValides, $compteur);
            $repartition[$lettreMotEcrit]--;
        }
        $compteur++;
    }

    // Verif lettres mal placées et lettres absentes (cases jaunes et bleues)
    $compteur = 0;
    foreach($motEcrit as $lettreMotEcrit) {
        
        if(!in_array($compteur, $casesValides)) {
            if ($repartition[$lettreMotEcrit] >= 1) {
                // Lettres jaunes
                $resultat += [$compteur+1 => "Presente"];
                $repartition[$lettreMotEcrit]--;
            }
            else {
                // Lettres bleues
                $resultat += [$compteur+1 => "Invalide"];
            }
        }
        $compteur++;
    }

    echo json_encode($resultat);

}

?>