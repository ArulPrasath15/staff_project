<?php 

include_once("../db.php");
session_start();
if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}
if(isset($_POST['submit']))
{
     
    $_SESSION['exam']=$_POST['exam'];
    $exam=substr($_POST['exam'],0,3); 
    if( $exam=="Oth" || $exam=="Ass")
    {

      header("Location: ../Entity/Table1.php");

    }
    else if($exam=="SEM")
    {

      header("Location: ../Entity/Sem.php");

    }
    else
    {
      header("Location: ../Entity/Table.php");
      
    }


}

?>