<?php
session_start();

$motEcritString = strtoupper(trim($_GET['motTape'])); 
$motEcrit = str_split($motEcritString);
$motSecret = str_split($_SESSION['progression']['mot_secret']);

if(!isset($_SESSION['progression']['repartition_lettres'])) {

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
$motEcrit = str_split($motEcritString);

$fichierMots = fopen('db/ndevinable/dico-' . str_split($_GET['motTape'])[0] . '.txt', "r");
if ($fichierMots === false) { throw new RuntimeException('Impossible d\'ouvrir le fichier'); }

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

    $_SESSION['progression']['essais']++;
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

    if ($_SESSION['progression']['essais'] >= 6) {
        echo json_encode(array($resultat,$_SESSION['progression']['mot_secret']));
    }
    else {
        echo json_encode(array($resultat,'//'));
    }

}

?>