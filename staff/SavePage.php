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

        // $sql3='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Up2ExpLvl")';
        // $sql4='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Up2ExLvl%")';
        // $sql5='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("ExpAtt")';
        // $sql6='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("SatAtt")';
        // $sql7='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("AttLvlCo")';
        // $sql8='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("range")';
        // $sql9='INSERT INTO `'.strval($_POST["test"]).'` (`rollno`) VALUES ("Attco")';
        $sql3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlA")';
        $sql4='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%A")';
        $sql5='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttA")';
        $sql6='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttA")';
        $sql7='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoA")';
        $sql8='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeA")';
        $sql9='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoA")';
        $sql3_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlB")';
        $sql4_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%B")';
        $sql5_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttB")';
        $sql6_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttB")';
        $sql7_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoB")';
        $sql8_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeB")';
        $sql9_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoB")';
        $sql3_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlC")';
        $sql4_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%C")';
        $sql5_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttC")';
        $sql6_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttC")';
        $sql7_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoC")';
        $sql8_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeC")';
        $sql9_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoC")';
        $sql3_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlD")';
        $sql4_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%D")';
        $sql5_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttD")';
        $sql6_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttD")';
        $sql7_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoD")';
        $sql8_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeD")';
        $sql9_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoD")';
        if($con->query($sql1))
        {
            if($con->query($sql2))
            {

                // $con->query($sql3);
                // $con->query($sql4);
                // $con->query($sql5);
                // $con->query($sql6);
                // $con->query($sql7);
                // $con->query($sql8);
                // $con->query($sql9);
                $con->query($sql3);$con->query($sql3_1);$con->query($sql3_2);$con->query($sql3_3);
                $con->query($sql4);$con->query($sql4_1);$con->query($sql4_2);$con->query($sql4_3);
                $con->query($sql5);$con->query($sql5_1);$con->query($sql5_2);$con->query($sql5_3);
                $con->query($sql6);$con->query($sql6_1);$con->query($sql6_2);$con->query($sql6_3);
                $con->query($sql7);$con->query($sql7_1);$con->query($sql7_2);$con->query($sql7_3);
                $con->query($sql8);$con->query($sql8_1);$con->query($sql8_2);$con->query($sql8_3);
                $con->query($sql9);$con->query($sql9_1);$con->query($sql9_2);$con->query($sql9_3);
               

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

        if(substr(strval($_SESSION['exam']),0,3)=="SEM")
        {
            $str="CREATE TABLE ".strval($_SESSION['exam'])." (sec varchar(2) NULL , rollno varchar(10) NOT NULL, grade varchar(3) NULL, points FLOAT NULL, PRIMARY KEY (rollno))";
            $sql1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`points`) VALUES ("Max Mark","'.strval($_POST["max1"]).'")';
            $sql2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`points`) VALUES ("Exp Mark","'.strval($_POST["exp1"]).'")';
        }
        else{
            $str="CREATE TABLE ".strval($_SESSION['exam'])." (sec varchar(2) NULL , rollno varchar(10) NOT NULL, mark FLOAT NULL, PRIMARY KEY (rollno))";
            $sql1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`mark`) VALUES ("Max Mark","'.strval($_POST["max1"]).'")';
            $sql2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`mark`) VALUES ("Exp Mark","'.strval($_POST["exp1"]).'")';
        }
        $sql3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlA")';
        $sql4='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%A")';
        $sql5='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttA")';
        $sql6='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttA")';
        $sql7='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoA")';
        $sql8='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeA")';
        $sql9='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1A")';
        $sql10='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoA")';
        $sql3_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlB")';
        $sql4_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%B")';
        $sql5_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttB")';
        $sql6_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttB")';
        $sql7_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoB")';
        $sql8_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeB")';
        $sql9_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1B")';
        $sql10_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoB")';
        $sql3_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlC")';
        $sql4_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%C")';
        $sql5_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttC")';
        $sql6_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttC")';
        $sql7_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoC")';
        $sql8_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeC")';
        $sql9_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1C")';
        $sql10_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoC")';
        $sql3_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlD")';
        $sql4_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%D")';
        $sql5_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttD")';
        $sql6_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttD")';
        $sql7_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoD")';
        $sql8_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeD")';
        $sql9_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1D")';
        $sql10_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoD")';
        $sql11='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`sec`)  SELECT  `rollno`,`sec` FROM `student` WHERE  `batch` LIKE '.($_SESSION['batch']).' ';
        if($con->query($str) and $con->query($sql1) and $con->query($sql2))
        {
                // $con->query($sql1);
                // $con->query($sql2);
                //echo "hai...";
                if(substr(strval($_SESSION['exam']),0,5)=="Other")
                {
                    $co="";
                    if(isset($_POST['co1'])){
                        $co.="1";
                    }
                    if(isset($_POST['co2'])){
                        $co.="2";
                    }
                    if(isset($_POST['co3'])){
                        $co.="3";
                    }
                    if(isset($_POST['co4'])){
                        $co.="4";
                    }
                    if(isset($_POST['co5'])){
                        $co.="5";
                    }
                    $sql_co='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`mark`) VALUES ("CO","'.$co.'")';
                    $con->query($sql_co);    
                }
                $con->query($sql3);$con->query($sql3_1);$con->query($sql3_2);$con->query($sql3_3);
                $con->query($sql4);$con->query($sql4_1);$con->query($sql4_2);$con->query($sql4_3);
                $con->query($sql5);$con->query($sql5_1);$con->query($sql5_2);$con->query($sql5_3);
                $con->query($sql6);$con->query($sql6_1);$con->query($sql6_2);$con->query($sql6_3);
                $con->query($sql7);$con->query($sql7_1);$con->query($sql7_2);$con->query($sql7_3);
                $con->query($sql8);$con->query($sql8_1);$con->query($sql8_2);$con->query($sql8_3);
                $con->query($sql9);$con->query($sql9_1);$con->query($sql9_2);$con->query($sql9_3);
                $con->query($sql10);$con->query($sql10_1);$con->query($sql10_2);$con->query($sql10_3);
                if($con->query($sql11))
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