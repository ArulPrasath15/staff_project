<?php
    include_once("../db.php");
    session_start();  

    if(isset($_POST["create"]))
    {
        $columnNum =(int)($_POST["size"]);
        $sql1='INSERT INTO `'.strval($_POST["test"]).'`(`rollno`';
        $sql2='INSERT INTO `'.strval($_POST["test"]).'`(`rollno`';
        for($i=1;$i<$columnNum;$i++)
        {
            $sql1.=" , `Q".strval($i)."`";
            $sql2.=" , `Q".strval($i)."`";
        }
        $sql1.=') VALUES ("Exp Mark"';
        $sql2.=') VALUES ("Co"';
        for($i=1;$i<$columnNum;$i++)
        {
            $em="em".strval($i);
            $c="c".strval($i);
            $sql1.=",".strval($_POST[$em]);
            $sql2.=",".strval($_POST[$c]);
        }
        $sql1.=')';
        $sql2.=')';
        if($con->query($sql1))
        {
            if($con->query($sql2))
            {
                header("Location: ./index.php");
            }
             // header("Location: CourseFrame.php");        
        }
        else
        {
            echo "<script>alert('Problem with Course Framing...')</script>";
            header("Location: ./index.php");        
        }
        
    }
    
    if(isset($_POST["cancel"]))
    {

        $exam=$_SESSION['exam'];
        $sql= "DROP TABLE".' '.$exam;
        if($con->query($sql)==true)
        {

            header("Location: ./index.php");


        }
        else
        {
            echo "ERROR :(";
        }
    }

    
?>