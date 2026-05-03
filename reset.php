<?php
session_start();
unset($_SESSION['mot_secret']); 
unset($_SESSION['repartition_lettres']); 
header('Location: index.php');
exit();
?>