<keyboard>
    <table>

        <?php 

            $keyboardLine1 = array('A', 'Z', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P');
            $keyboardLine2 = array('Q', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M');
            $keyboardLine3 = array('W', 'X', 'C', 'V', 'B', 'N', '', '' ,'↺' ,'➔');
            $keyboard = array($keyboardLine1, $keyboardLine2, $keyboardLine3);

            foreach($keyboard as $line) {

                echo '<tr>';
                foreach($line as $letter) {
                    if (!empty($letter)) {
                        echo '<td class="normal" id="letter-' . $letter . '">';
                        echo $letter;
                        echo '</td>';
                    }
                    else {
                        echo '<td class="vide"></td>';
                    }
                }
                echo '</tr>';

            }

        ?>

    </table>
</keyboard>