<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}
$roll=$_POST['ROLLNO'];
$Q1=!empty($_POST['Q1'])?$_POST['Q1']:0;
$Q2=!empty($_POST['Q2'])?$_POST['Q2']:0;
$Q3=!empty($_POST['Q3'])?$_POST['Q3']:0;
$Q4=!empty($_POST['Q4'])?$_POST['Q4']:0;
$Q5=!empty($_POST['Q5'])?$_POST['Q5']:0;
$Q6=!empty($_POST['Q6'])?$_POST['Q6']:0;
$Q7=!empty($_POST['Q7'])?$_POST['Q7']:0;
$Q8=!empty($_POST['Q8'])?$_POST['Q8']:0;
$Q9=!empty($_POST['Q9'])?$_POST['Q9']:0;
$Q10=!empty($_POST['Q10'])?$_POST['Q10']:0;

//  echo $Q1.$Q2.$Q3.$Q4.$Q5.$Q6.$Q7.$Q8.$Q9.$Q10;


$sql1=" UPDATE `student` SET q1 = '$Q1', q2 = '$Q2', q3 = '$Q3', q4='$Q4', q5='$Q5', q6='$Q6', q7='$Q7', q8 ='$Q8', q9='$Q9',q10= '$Q10'   WHERE `rollno`= '$roll' ";

if ($con->query($sql1) === TRUE) {
    echo "s";
  } else {
    echo "e";
  }

