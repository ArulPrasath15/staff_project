<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}
$roll=$_POST['ROLLNO'];
echo $roll;


