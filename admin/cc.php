<!--Course Coordinators table created-->
<?php


include_once("../db.php");
session_start();
if(!isset($_SESSION['admin']))
{

    header("Location: ./index.php");

}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creation</title>
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
.tablecontent{
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 50px;
    padding-bottom: 50px;
}
td{

  font-size:16px;
}
th{

font-size:16px;
}
bi{
  font-size:25;
}
b1{
  font-size:18;
}

</style> 
    
<body>
<div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div>

<div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="./cc.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> Admin</h4></a>
        <a  class="right aligned item"  style="margin-left:1100px;"   href="./Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
  <br><br><br>
  <center><h2 style="color:#ffd700" class="animate__animated animate__fadeInDownBig"><u>Welcome Admin !</u><br><br>Course List </h2></center><br>
  <div style="display:flex;justify-content:flex-end">
 
  </div>
  <!-- Table start -->
  <div class="animate__animated animate__fadeInUpBig">
  <div class="tablecontent" >
  <div align="right" ><button id="createbutton" class="ui positive button" onclick="location.href='CreateCourse.php';"> <bi>+ </bi><b1> Create Course</b1></button></div>
 <table class="ui selectable celled inverted table">
    <thead>
      <tr>
          <th class="center aligned">No</th>
          <th class="center aligned">Course Code</th>
          <th class="center aligned">Course Name</th>
          <th class="center aligned">Course Coordinator</th>
          <th class="center aligned">Batch</th>
          <th class="center aligned">Sem</th>
          <th class="center aligned">Year</th>
          <th class="center aligned">Credit</th>
          
      </tr>
    </thead>
    <tbody>
      <?php
      $no=1;
      $same=0;
      $norecord=1;
      $sql="SELECT * from `course_list` ";
      $data=$con->query($sql);
      if(mysqli_num_rows($data)>0)
      {
      while($row1 = $data->fetch_assoc())
      {  
          
       // if(mysqli_num_rows($row1)>0)
         // { ?>
          <tr>
              <td class="center aligned" ><?php  echo $no;            ?> </td>
              <td class="center aligned" ><?php  echo $row1['code'];  ?> </td>
              <td class="center aligned" ><?php  echo $row1['name'];  ?> </td>
              <?php
              $sql1="select `name` FROM `staff` WHERE `staffid` LIKE '".$row1['cc']."'";
              $data1=$con->query($sql1);
              $res=$data1->fetch_row();
              ?>
              <td class="center aligned" ><?php  echo $res[0]; ?> </td>
              <td class="center aligned" ><?php  echo $row1['batch']; ?> </td>
              <td class="center aligned" ><?php  echo $row1['sem'];   ?> </td>
              <td class="center aligned" ><?php  echo $row1['year']; ?> </td>
              <td class="center aligned" ><?php  echo $row1['credit']; ?> </td>
              
              <!-- <td class="center aligned" ><div class="ui positive button">Activate</div></td> -->

          </tr>  
            
                <?php 
                $no+=1;
            
              
          }
    }  ?>

   </tbody>
  </table>
  </div>
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

</script> 
</html>