<?php

include_once("../db.php");
session_start();

if(isset($_POST["textarea1"]))
{
    $text=$_POST["textarea1"];
    $code=$_POST["code"];

    $sql1="UPDATE `copo`  SET `obs` = '$text' WHERE `code` LIKE  '$code'";

    if($con->query($sql1)==false)
    {
        
        echo "False";
    }else{
        echo "True";
    }

}
if(isset($_POST["textarea2"]))
{
    $text=$_POST["textarea2"];
    $code=$_POST["code"];

    $sql1="UPDATE `copo`  SET `obs1` = '$text' WHERE `code` LIKE  '$code'";
    if($con->query($sql1)==false)
    {
        
        echo "False";
    }else{
        echo "True";
    }

}

?>