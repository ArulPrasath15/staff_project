<?php
    include_once("db.php");
        $sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='cat1' ";
        $data=$con->query($sql);
        while($row = $data->fetch_assoc()){
            $result[] = $row;
        }
        // Array of all column names
        $columnArr = array_column($result, 'COLUMN_NAME');
        $sql1='INSERT INTO `cat1`(`ROLL`';
        $sql2='INSERT INTO `cat1`(`ROLL`';
        for($i=1;$i<count($columnArr);$i++)
        {
            $sql1.=" , `Q".strval($i)."`";
            $sql2.=" , `Q".strval($i)."`";
        }
        $sql1.=') VALUES ("Exp Mark"';
        $sql2.=') VALUES ("Co"';
        for($i=1;$i<count($columnArr);$i++)
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
                echo "<script>alert('Course Successfully Framed...')</script>";
                header("Location: CourseFrame.php");
            }
            echo "<script>alert('Problem with Course Framing Please do it again...')</script>";
            header("Location: CourseFrame.php");        
        }
    
?>