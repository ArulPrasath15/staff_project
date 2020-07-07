<?php
    include_once('../db.php');
    if (isset($_POST["code"]))
    {
        $code=$_POST["code"];
        $name=$_POST["name"];
        $year=$_POST["year"];
        $batch=$_POST["batch"];
        $sem=$_POST["sem"];
        $cred=$_POST["cred"];
        $staff=$_POST["staff"];
        $sql="insert into course_list values('$code','$name',' $year','$batch',$sem,$cred,'$staff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        if($con->query($sql))
            echo "Course created successfuly!";
        else
            echo "Error occurred...Try again!";
     exit();   
    }
?>