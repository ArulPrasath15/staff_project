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


$marksarr=array();
$quesarr=array();

for($i=1;$i<=count($columnArr)-2;$i++)
{

  $ques="CO".$i;
  $quesarr[$i]=$ques;
  //echo $_POST[$ques];
  if(!isset($_POST[$ques]))
  {
    $marksarr[$i]='NULL';
  }
  else if($_POST[$ques]==strval(0))
  {
    $marksarr[$i]=0;
  }
  else
  {
    if(empty($_POST[$ques]))
    {
      $marksarr[$i]='NULL';
    //  echo $ques;
    }
    else
    {
      $marksarr[$i]=$_POST[$ques];
    }
    
  }
}

$sql1='UPDATE '.$_table.' SET ';
for($i=1;$i<=count($columnArr)-2;$i++)
{

  $sql1.=$quesarr[$i] .'='. $marksarr[$i];
  if($i!=count($columnArr)-2)
  {
    $sql1.=',';
  }

}
$sql1.= ' WHERE rollno ='."'".$roll."'";

if ($con->query($sql1) === TRUE) {
    echo 's';
  } 
  else
  {
    echo $sql1;
  }

