<?php

include_once("../db.php");
session_start();
$roll=$_POST['ROLLNO'];
$_table=$_SESSION['exam'];

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='$_table' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
$columnArr = array_column($result, 'COLUMN_NAME');

// $mark=$_POST['MARK'];

if($_POST['MARK']==strval(0))
{
  $mark=0;
}
else
{
  if(empty($_POST['MARK']))
  {
    $mark='NULL';
  //  echo $ques;
  }
  else
  {
    $mark=$_POST['MARK'];
  }
  
}




$sql1="UPDATE `$_table`  SET `mark` = $mark WHERE `rollno` LIKE  '$roll'";




if ($con->query($sql1) === TRUE) {
    echo 's';
  } 
  else
  {
    echo $sql1;
  }

