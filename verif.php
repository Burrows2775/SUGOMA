<?php
session_start();

$motEcrit = str_split($_GET['motTape']);
$motSecret = str_split($_SESSION['mot_secret']);


if(!isset($_SESSION['repartition_lettres'])) {

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

    $_SESSION['repartition_lettres'] = $repartition;
}

$repartition = $_SESSION['repartition_lettres'];
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
?>