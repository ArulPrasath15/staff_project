<?php 
include_once("../db.php");
session_start();
if(isset($_POST['submit']))
{
    
    $_SESSION['exam']=$_POST['exam'];
    header("Location: ../Entity/Table");

}

?>