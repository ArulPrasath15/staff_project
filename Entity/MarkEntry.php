<?php 
include_once("../db.php");
session_start();
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
    <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css"/>
    <script src="../assets/js/jquery.min.js"></script> 
    <script src="../assets/Fomantic/dist/semantic.min.js"></script>
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

<body>
   <!-- navbar -->
   <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="../staff/index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="item"  style="margin-left:1100px;"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->
<h2 class="ui center aligned icon header" style="margin:3%">
<i class="edit icon"></i>
    <div class="content">
        Exam Mark Entry
        <div class="sub header">Select the Exam to Enter the Mark.</div>
    </div>
</h2>

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
            <!-- CAT 3 -->
            <?php 
            $table='CAT3_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val == FALSE)
            {
            }else
            {?>
                 <option Value=CAT3_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>CAT 3</option>

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
