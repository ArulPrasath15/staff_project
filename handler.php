<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}
$roll=$_POST['ROLLNO'];
$Q1=!empty($_POST['Q1'])?$_POST['Q1']:'NULL';
$Q2=isset($_POST['Q2'])?$_POST['Q2']:'NULL';
$Q3=!empty($_POST['Q3'])?$_POST['Q3']:'NULL';
$Q4=!empty($_POST['Q4'])?$_POST['Q4']:'NULL';
$Q5=!empty($_POST['Q5'])?$_POST['Q5']:'NULL';
$Q6=!empty($_POST['Q6'])?$_POST['Q6']:'NULL';
$Q7=!empty($_POST['Q7'])?$_POST['Q7']:'NULL';
$Q8=!empty($_POST['Q8'])?$_POST['Q8']:'NULL';
$Q9=!empty($_POST['Q9'])?$_POST['Q9']:'NULL';
$Q10=!empty($_POST['Q10'])?$_POST['Q10']:'NULL';
$Q11=!empty($_POST['Q11'])?$_POST['Q11']:'NULL';
$Q12=!empty($_POST['Q12'])?$_POST['Q12']:'NULL';
$Q13=!empty($_POST['Q13'])?$_POST['Q13']:'NULL';
$Q14=!empty($_POST['Q14'])?$_POST['Q14']:'NULL';


$sql1=" UPDATE `student` SET q1 = $Q1, q2 = $Q2, q3 = $Q3, q4=$Q4, q5=$Q5, q6=$Q6, q7=$Q7, q8 =$Q8, q9=$Q9,q10= $Q10 ,q11= $Q11,q12= $Q12,q13= $Q13,q14= $Q14  WHERE `rollno`= '$roll' ";

if ($con->query($sql1) === TRUE) {
    echo "s";
  } 
  else
  {
    echo $sql1;
  }

