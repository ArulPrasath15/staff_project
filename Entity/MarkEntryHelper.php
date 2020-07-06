<?php 
include_once("../db.php");
session_start();
if(isset($_POST['submit']))
{
    
    header("Location: ../Entity/Table?mark=".$_POST['exam']);

}

?>