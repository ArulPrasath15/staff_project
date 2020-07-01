<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}
$roll=$_POST['ROLLNO'];


$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='CAT_1_2020' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
$columnArr = array_column($result, 'COLUMN_NAME');


$marksarr=array();
$quesarr=array();

for($i=1;$i<=count($columnArr)-1;$i++)
{

  $ques="Q".$i;
  $quesarr[$i]=$ques;
  if($_POST[$ques]==strval(0))
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

$sql1='UPDATE CAT_1_2020 SET ';
for($i=1;$i<=count($columnArr)-1;$i++)
{

  $sql1.=$quesarr[$i] .'='. $marksarr[$i];
  if($i!=count($columnArr)-1)
  {
    $sql1.=",";
  }
  else
  {
    $sql1.=" ";
  }

}
$sql1.= 'WHERE rollno ='."'".$roll."'";

if ($con->query($sql1) === TRUE) {
    echo 's';
  } 
  else
  {
    echo 'e';
  }

