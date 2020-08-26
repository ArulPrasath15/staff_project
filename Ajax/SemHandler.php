<?php

include_once("../db.php");
session_start();
$roll=$_POST['ROLLNO'];
$_table=$_SESSION['exam'];
$flag=0;
$flag1=0;

$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='$_table' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
$columnArr = array_column($result ,'COLUMN_NAME');

// $mark=$_POST['MARK'];

if($_POST['GRADE']==strval(0))
{
  $grade=0;
}
else
{
  if(empty($_POST['GRADE']))
  {
    $grade='NULL';
    $flag=1;
  //  echo $ques;
  }
  else
  {
    $grade=$_POST['GRADE'];
  }
  
}

if($_POST['POINTS']==strval(0))
{
  $points=0;
}
else
{
  if(empty($_POST['POINTS']))
  {
    $points='NULL';
    $flag1=1;
  //  echo $ques;
  }
  else
  {
    $points=$_POST['POINTS'];
  }
  
}




if($flag==1 && $flag1==1 )
{
  $sql1="UPDATE `$_table`  SET `grade` = $grade , `points` = $points WHERE `rollno` LIKE  '$roll'";

}
else
{
  $sql1="UPDATE `$_table`  SET `grade` = '$grade' , `points` = '$points' WHERE `rollno` LIKE  '$roll'";

}



if ($con->query($sql1) === TRUE) {
    echo 's';
  } 
  else
  {
    echo $sql1;
  }

