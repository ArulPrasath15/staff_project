<?php
    include_once("../db.php");
    session_start(); 
    if(!isset($_SESSION["staffid"]))
    {
    header("Location: ../index.php");
    }
    
   
    if(isset($_POST["create"]))
    {
        $batch=$_SESSION['batch'];
        $columnNum =(int)($_POST["size"]);
        $sql1='INSERT INTO `'.strval($_POST["test"]).'`(`rollno`';
        $sql2='INSERT INTO `'.strval($_POST["test"]).'`(`rollno`';
        for($i=1;$i<$columnNum-2;$i++)
        {
            $sql1.=" , `Q".strval($i)."`";
            $sql2.=" , `Q".strval($i)."`";
        }
        $sql1.=') VALUES ("Exp Mark"';
        $sql2.=') VALUES ("Co"';
        for($i=1;$i<$columnNum-2;$i++)
        {
            $em="em".strval($i);
            $c="c".strval($i);
            $sql1.=",".strval($_POST[$em]);
            $sql2.=",".strval($_POST[$c]);
        }
        $sql1.=')';
        $sql2.=')';

        // echo $sql1;
        // echo $sql2;

        $sql3='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Up2ExpLvl")';
        // echo $sql3;
        $sql4='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Up2ExLvl%")';
        $sql5='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("ExpAtt")';
        $sql6='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("SatAtt")';
        $sql7='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("AttLvlCo")';
        $sql8='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("range")';
        $sql9='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Attco")';

        if($con->query($sql1))
        {
            if($con->query($sql2))
            {

                $con->query($sql3);
                $con->query($sql4);
                $con->query($sql5);
                $con->query($sql6);
                $con->query($sql7);
                $con->query($sql8);
                $con->query($sql9);
               

                    $sql10='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`,`sec`)  SELECT  `rollno`,`sec` FROM `student` WHERE  `batch` LIKE '.$batch.' ';
                    if($con->query($sql10))
                    {

                        header("Location: ./index.php");


                    }
                    else
                    {

                        echo "<script>alert('Problem with Course Framing...try Again')</script>";
                        
                    }
            }
             // header("Location: CourseFrame.php");        
        }
        else
        {
            echo "<script>alert('Problem with Course Framing...')</script>";
           // header("Location: ./index.php");        
        }
        
    }
    
    if(isset($_POST["create-assign"]))
    {

        $str="CREATE TABLE ".strval($_SESSION['exam'])." (sec varchar(2) NULL , rollno varchar(10) NOT NULL, mark FLOAT NULL, PRIMARY KEY (rollno))";
        $sql1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`mark`) VALUES ("Max Mark","'.strval($_POST["max1"]).'")';
        $sql2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`mark`) VALUES ("Exp Mark","'.strval($_POST["exp1"]).'")';
        $sql3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvl")';
        $sql4='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%")';
        $sql5='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAtt")';
        $sql6='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAtt")';
        $sql7='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCo")';
        $sql8='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range")';
        $sql9='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Attco")';
        $sql10='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`sec`)  SELECT  `rollno`,`sec` FROM `student` WHERE  `batch` LIKE '.($_SESSION['batch']).' ';
        if($con->query($str) and $con->query($sql1) and $con->query($sql2))
        {
                // $con->query($sql1);
                // $con->query($sql2);
                echo "hai...";
                $con->query($sql3);
                $con->query($sql4);
                $con->query($sql5);
                $con->query($sql6);
                $con->query($sql7);
                $con->query($sql8);
                $con->query($sql9);
                if($con->query($sql10))
                {
                    header("Location: ./index.php");
                }
                else
                {
                    echo "<script>alert('Problem with Course Framing...')</script>";
                }
        }
        else
        {
            echo "<script>alert('Problem with Course Framing...')</script>";
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