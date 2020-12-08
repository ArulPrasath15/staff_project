<?php
    include_once('../db.php');
    session_start();
    if (isset($_POST["code"]))
    {
        $code=$_POST["code"];
        $name=$_POST["name"];
        $year=$_POST["year"];
        $batch=$_POST["batch"];
        $sem=$_POST["sem"];
        $cred=$_POST["cred"];
        $staff=$_POST["staff"];
        $sql="insert into `course_list` (`code`,`name`,`year`,`batch`,`sem`,`credit`,`cc`) values('$code','$name',' $year','$batch',$sem,$cred,'$staff')";
        if($con->query($sql)){
            $_SESSION['code']=$code;
            header("Location: ./cc.php");
            // echo "Course created successfuly!";
        } 
        else{
           echo '<script>alert("Error occurred...Try again!")</script>';
           header("Location: ./CreateCourse.php");

        }
     //exit();   
    }
?>