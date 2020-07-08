<?php

include_once("./db.php");
session_start();
if(isset($_SESSION["staffid"]))
{

     session_unset();
     session_destroy();
     
    
}
header("Location: ./Login.php");


?>
