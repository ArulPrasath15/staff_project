<?php 
include_once("../db.php");
include_once("../staff/nav.php");
if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}

if(!isset($_GET['code']))
{
    header("Location: ../staff/index.php");
}
$_staffid=$_SESSION['staffid'];
$_code=$_GET['code'];
$_SESSION['ccode']=$_code;
$sql="SELECT * FROM `course_list` WHERE  `code`  LIKE  '$_code' ";
if($con->query($sql)==false)
{
    header("Location: ../staff/index.php");

}
$data=$con->query($sql);
$rows=$data->fetch_assoc();
if($rows['staff1']==$_staffid || $rows['staff2']==$_staffid || $rows['staff3']==$_staffid || $rows['staff4']==$_staffid)
{

}
else
{
    
    header("Location: ../staff/index.php");
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Entry</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
    
</head>

<style>
body
{
    background-image: url("../Images/bg.jpg");
    background-size: cover;
}
.ui.dropdown:not(.button)>.default.text {
    color: rgb(27, 28, 29);
    font-size:17px;
}

</style>


<div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div>

<body>
  
<h2 class="ui center aligned icon header" style="margin:3%">
<i class="yellow edit icon"></i>
    <div style="color:#ffd700" class="content">
        Exam Mark Entry
        <div style="color:#ffd700" class="sub header">Select the Exam to Enter the Mark.</div>
    </div>
</h2><br>

<div class="ui raised inverted segment" id="seg1" style="width:94%;margin:3%";><br>


<form class="ui form" onsubmit=" return check();" action="MarkEntryHelper.php" method="POST">



<center><select class="ui dropdown"  id="dropd" name="exam" style="width: 250px;"  required>
            <option Value="">Select Exam</option>

            <!-- CAT 1 -->
            <?php 
            $table='CAT1_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val == FALSE)
            {
            }else
            {?>
                 <option Value=CAT1_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>CAT 1</option>

            <?php
            }
           ?> 
            <!-- CAT 2 -->
            <?php 
            $table='CAT2_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val === FALSE)
            {
            }else
            {?>
                 <option Value=CAT2_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>CAT 2</option>

            <?php
            }
           ?>         
            <!--  CAT 3 -->
            <?php 
            $table='CAT3_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val === FALSE)
            {
            }else
            {?>
                 <option Value=CAT3_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>CAT 3</option>

            <?php
            }
           ?>



            <?php 
            $table='Assignment_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val == FALSE)
            {
            }else
            {?>
                 <option Value=Assignment_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>ASSIGNMENT</option>

            <?php
            }
           ?>  
           <!-- asses -->
           <?php 
            $table='OtherAssesment_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val === FALSE)
            {
            }else
            {?>
                 <option Value=OtherAssesment_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>OTHER ASSIGNMENT</option>

            <?php
            }
           ?>
            <!--  other asses -->
            <?php 
            $table='SEM_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val === FALSE)
            {
            }else
            {?>
                 <option Value=SEM_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>SEMESTER</option>

            <?php
            }
           ?>
           
            
           
           


        </select><br><br>
        <button class="ui positive button" type="submit" name="submit"> Entry Mark</button>
        
        
        </center>
        </form>
        <br>

</div>
</body>
<script>
document.onreadystatechange = function() { 
	if (document.readyState !== "complete") { 
		document.querySelector("body").style.visibility = "hidden"; 
		document.querySelector(".preloader").style.visibility = "visible"; 
	} else { 
		document.querySelector(".preloader").style.display = "none"; 
		document.querySelector("body").style.visibility = "visible"; 
	} 
};

$(document).ready(function(){

    $('.ui.dropdown').dropdown();


});


function check(){

    var dropdownd=$('#dropd').val();
    console.log(dropdownd);
    if(dropdownd=='')
    {
          return false;
    }



}

</script>



</html>
