<?php
unset($_SESSION["name"]);
unset($_SESSION["login"]);
unset($_SESSION["password"]); 
session_destroy();
header('Location: landingPage.html'); 
?>