<?php 
    // Programme qui convertis le dictionnaire des 300K mots en dictionnaires de mots exploitable pour le jeu

    function removeAccents(string $str) {
        // Fonction qui retire les accents des mots

        $accents = [
            'À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å',
            'È','É','Ê','Ë','è','é','ê','ë',
            'Ì','Í','Î','Ï','ì','í','î','ï',
            'Ò','Ó','Ô','Õ','Ö','ò','ó','ô','õ','ö',
            'Ù','Ú','Û','Ü','ù','ú','û','ü',
            'Ý','ý','ÿ','Ç','ç','Ñ','ñ','Œ','œ','Æ','æ',
        ];
        $replacements = [
            'A','A','A','A','A','A','a','a','a','a','a','a',
            'E','E','E','E','e','e','e','e',
            'I','I','I','I','i','i','i','i',
            'O','O','O','O','O','o','o','o','o','o',
            'U','U','U','U','u','u','u','u',
            'Y','y','y','C','c','N','n','OE','oe','AE','ae',
        ];

        return str_replace($accents, $replacements, $str);
    }

    /*
    $cheminGrandeListe = 'util/devinables.txt';
    $dossierDestination = 'db/devinable/'; 
    */

    $cheminGrandeListe = 'util/ndevinables.txt';
    $dossierDestination = 'db/ndevinable/'; 

    $fichierSource = fopen($cheminGrandeListe, 'r');

    $fichiersOuverts = [];

    if ($fichierSource) {
        while (($ligne = fgets($fichierSource)) !== false) {

            if (!str_contains($ligne, '-') && (strlen(trim($ligne)) >= 5 && strlen(trim($ligne)) <= 9)) {
                $mot = strtoupper(removeAccents(trim($ligne)));
                $motSplit = str_split($mot);
                $premiereLettre = $motSplit[0];

                if (!isset($fichiersOuverts[$premiereLettre])) {
                    $fichiersOuverts[$premiereLettre] = fopen($dossierDestination . 'dico-' . $premiereLettre . '.txt', 'a');
                }

                fwrite($fichiersOuverts[$premiereLettre], $mot . PHP_EOL);
            }

        }

        fclose($fichierSource);
    } else {
        echo "Erreur d'ouverture du fichier source.";
    }

    foreach ($fichiersOuverts as $pointeurDeFichier) {
        fclose($pointeurDeFichier);
    }

?>