<?php

include_once("./db.php");
session_start();
if(isset($_SESSION["admin"]))
{

     session_unset();
     session_destroy();
     
    
}
header("Location: ./index.php");


?>
