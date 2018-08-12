<?php
session_destroy();
session_start();
 
$_SESSION['type'] = 'guest' ;

header('Location: Website/home.php')

?>