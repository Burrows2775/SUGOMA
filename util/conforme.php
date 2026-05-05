<?php 
    // Fichier qui convertis le dictionnaire des 300K mots en dictionnaire de mots exploitable pour le jeu

    $fichierConvert = fopen('util/convert.txt', 'r');
    $fichierFinal = fopen('util/conversion.txt', "w");

    if ($fichierConvert === false || $fichierFinal === false) {
        throw new RuntimeException('Impossible d\'ouvrir le fichier');
    }

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

    while (($line = fgets($fichierConvert)) !== false) {
        $line = rtrim($line, "\n\r");
        
        // Mot accepté = possède entre 5 et 10 lettres
        // Pas de tirets

        if (strlen($line) <= 10 && strlen($line) >= 5 && !str_contains($line, '-')) {

            $copiePropre = strtoupper(removeAccents($line));
            fwrite($fichierFinal, strtoupper($copiePropre));
            fwrite($fichierFinal, "\n");

        }
        
    }

    fclose($fichierFinal);
    fclose($fichierConvert);

?>