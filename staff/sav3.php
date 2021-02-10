<?php
    include_once("../db.php");
    session_start(); 
    if(!isset($_SESSION["staffid"]))
    {
    header("Location: ../index.php");
    }
    
    if(isset($_POST["create3"]))
    {
            $str="CREATE TABLE ".strval($_SESSION['exam'])." (sec varchar(2) NULL , rollno varchar(10) NOT NULL, co1 FLOAT NULL, co2 FLOAT NULL, co3 FLOAT NULL, co4 FLOAT NULL, co5 FLOAT NULL, PRIMARY KEY (rollno))";
            $sql1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`co1`,`co2`,`co3`,`co4`,`co5`) VALUES ("Max Mark","'.strval($_POST["max1"]).'","'.strval($_POST["max2"]).'","'.strval($_POST["max3"]).'","'.strval($_POST["max4"]).'","'.strval($_POST["max5"]).'")';
            $sql2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`co1`,`co2`,`co3`,`co4`,`co5`) VALUES ("Exp Mark","'.strval($_POST["exp1"]).'","'.strval($_POST["exp2"]).'","'.strval($_POST["exp3"]).'","'.strval($_POST["exp4"]).'","'.strval($_POST["exp5"]).'")';
        
        $sql3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlA")';
        $sql4='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%A")';
        $sql5='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttA")';
        $sql6='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttA")';
        $sql7='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoA")';
        //$sql8='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("rangeA")';
        $sql9='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1A")';
        $sql91='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range2A")';
        $sql92='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range3A")';
        $sql93='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range4A")';
        $sql94='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range5A")';
        $sql10='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoA")';
        $sql3_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlB")';
        $sql4_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%B")';
        $sql5_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttB")';
        $sql6_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttB")';
        $sql7_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoB")';
        $sql9_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1B")';
        $sql91_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range2B")';
        $sql92_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range3B")';
        $sql93_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range4B")';
        $sql94_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range5B")';
        $sql10_1='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoB")';
        $sql3_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlC")';
        $sql4_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%C")';
        $sql5_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttC")';
        $sql6_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttC")';
        $sql7_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoC")';
        $sql9_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1C")';
        $sql91_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range2C")';
        $sql92_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range3C")';
        $sql93_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range4C")';
        $sql94_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range5C")';
        $sql10_2='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoC")';
        $sql3_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExpLvlD")';
        $sql4_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("Up2ExLvl%D")';
        $sql5_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("ExpAttD")';
        $sql6_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("SatAttD")';
        $sql7_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttLvlCoD")';
        $sql9_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range1D")';
        $sql91_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range2D")';
        $sql92_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range3D")';
        $sql93_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range4D")';
        $sql94_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("range5D")';
        $sql10_3='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`) VALUES ("AttcoD")';
        $sql11='INSERT INTO `'.strval($_SESSION['exam']).'` (`rollno`,`sec`)  SELECT  `rollno`,`sec` FROM `student` WHERE  `batch` LIKE '.($_SESSION['batch']).' ';
        if($con->query($str) and $con->query($sql1) and $con->query($sql2))
        {
                
                $con->query($sql3);$con->query($sql3_1);$con->query($sql3_2);$con->query($sql3_3);
                $con->query($sql4);$con->query($sql4_1);$con->query($sql4_2);$con->query($sql4_3);
                $con->query($sql5);$con->query($sql5_1);$con->query($sql5_2);$con->query($sql5_3);
                $con->query($sql6);$con->query($sql6_1);$con->query($sql6_2);$con->query($sql6_3);
                $con->query($sql7);$con->query($sql7_1);$con->query($sql7_2);$con->query($sql7_3);
                $con->query($sql8);$con->query($sql8_1);$con->query($sql8_2);$con->query($sql8_3);
                $con->query($sql9);$con->query($sql91);$con->query($sql92);$con->query($sql93);$con->query($sql94);
                $con->query($sql9_1);$con->query($sql91_1);$con->query($sql92_1);$con->query($sql93_1);$con->query($sql94_1);
                $con->query($sql9_2);$con->query($sql91_2);$con->query($sql92_2);$con->query($sql93_2);$con->query($sql94_2);
                $con->query($sql9_3);$con->query($sql91_3);$con->query($sql92_3);$con->query($sql93_3);$con->query($sql94_3);
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
            echo "<script>alert('Problem with Course Framing2...')</script>";
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