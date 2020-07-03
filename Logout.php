<?php

include_once("./db.php");
if(isset($_SESSION["staffid"]))
{
    session_destroy();
    session_unset();
    
}

header("Location: ./Login.php");


?>