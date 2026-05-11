<?php
    session_start();
    unset($_SESSION['progression']); 
    header('Location: ../');
    exit();
?>