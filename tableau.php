<table>
    <?php
        $motDuJour = $_SESSION['progression']['mot_secret'];
        $longueurMot = $_SESSION['progression']['longueur_mot'];;
        $nbrChances = 5;

        // Première ligne ----------------------------------------------------------

        echo '<tr id="ligne-0">';

        echo '<td id="case-0-0" class="bleu">' . str_split(trim( $motDuJour ))[0] . '</td>'; // Affichage de la première lettre du mot

        for($i = 0; $i < strlen(trim( $motDuJour )) - 1; $i++) {
            echo '<td id="case-0-'. $i+1 . '" class="bleu"></td>';
        }

        echo '</tr>';

        // -------------------------------------------------------------------------

        for($i = 0; $i < $nbrChances; $i++) {
            $j = 0;

            echo '<tr>';
            foreach(str_split(trim( $motDuJour )) as $jaj) {
                echo '<td id="case-' . $i+1 . '-' . $j . '" class="bleu"></td>';
                $j++;
            }
            echo '</tr>';
        }

        // #2B2B2B;

    ?>
</table>