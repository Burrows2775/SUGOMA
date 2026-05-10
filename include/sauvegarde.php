<?php 
    session_start();

    if (isset($_SESSION['progression']['sauvegarde'])) {
        echo json_encode($_SESSION['progression']['sauvegarde']);
    }
?>