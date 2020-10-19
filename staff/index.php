<?php 
include_once("../db.php");
include_once("./nav.php");
if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="../Images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" /> 
  

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
</style> 
    

<body>

  <div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div>
  <br><br><br>
  <center><h2 style="color:#ffd700" class="animate__animated animate__fadeInDownBig">Welcome ! <?php echo $_SESSION['staffname']; ?></h2></center><br>
  <!-- Table start -->
  <div class="animate__animated animate__fadeInUpBig">
  <div class="tablecontent" >
  <table class="ui selectable celled inverted table">
    <thead>
      <tr>
          <th class="center aligned">No</th>
          <th class="center aligned">Course Code</th>
          <th class="center aligned">Course Name</th>
          <th class="center aligned">Batch</th>
          <th class="center aligned">Sem</th>
          <th class="center aligned" colspan="4" >Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=1;
      $same=0;
      $norecord=1;
      $sql="SELECT * from `course_list` ";
      $data=$con->query($sql);
      while($row1 = $data->fetch_assoc())
      {  
          
          if($row1['cc']==$_SESSION['staffid'])
          { ?>
          <tr>
              <td class="center aligned" ><?php  echo $no;            ?> </td>
              <td class="center aligned" ><?php  echo $row1['code'];  ?> </td>
              <td class="center aligned" ><?php  echo $row1['name'];  ?> </td>
              <td class="center aligned" ><?php  echo $row1['batch']; ?> </td>
              <td class="center aligned" ><?php  echo $row1['sem'];   ?> </td>
              <td class="center aligned" ><div class="ui button" onclick="location.href = './CourseFrame.php?code=<?php echo $row1['code']  ?>'" >Frame Pattern</div></td>
              <td class="center aligned" ><div class="ui button" onclick="location.href = './AssignFaculty.php<?php echo "?cc"."=".$row1['cc']."&"."code"."=".$row1['code'] ?>';">Assign Faculty</div></td>
              <td class="center aligned" ><div class="ui positive button" onclick="location.href = '../Entity/MarkEntry.php?code=<?php echo $row1['code']; ?>'">Mark Entry</div></td>
              <!-- <td class="center aligned" ><div class="ui positive button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td> -->
              <!-- <td class="center aligned" ><div class="ui positive button">Activate</div></td> -->
              <?php 
              if($row1['staff1']==$_SESSION['staffid'] || $row1['staff2']==$_SESSION['staffid'] || $row1['staff3']==$_SESSION['staffid'] || $row1['staff4']==$_SESSION['staffid']){
                //echo $row1['staff1'];
                $class=' ';
   
                if($row1['staff1']==$_SESSION['staffid'])
                {
                  $class='A';
                }
                elseif($row1['staff2']==$_SESSION['staffid'])
                {
                  $class='B';
                }
                elseif($row1['staff3']==$_SESSION['staffid'])
                {
                  $class='C';
                }
                elseif($row1['staff4']==$_SESSION['staffid'])
                {
                  $class='D';
                }
                //echo "SELECT * FROM `cat1_".$row1['code']."_".$row1['batch']."`";
                $tb1 = $con->query("SELECT * FROM `cat1_".$row1['code']."_".$row1['batch']."`");
                $tb2 = $con->query("SELECT * FROM `cat2_".$row1['code']."_".$row1['batch']."`");
                $tb3 = $con->query("SELECT * FROM `cat3_".$row1['code']."_".$row1['batch']."`");
                $tb4 = $con->query("SELECT * FROM `assignment_".$row1['code']."_".$row1['batch']."`");
                $tb5 = $con->query("SELECT * FROM `otherassesment_".$row1['code']."_".$row1['batch']."`");
                $tb6 = $con->query("SELECT * FROM `sem_".$row1['code']."_".$row1['batch']."`");
                
                if($tb1==true && $tb2==true && $tb3==true && $tb4==true && $tb5==true && $tb6==true){
                  $tb11 = $con->query("SELECT `Q1` FROM `cat1_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb21 = $con->query("SELECT `Q1` FROM `cat2_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb31 = $con->query("SELECT `Q1` FROM `cat3_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb41 = $con->query("SELECT `mark` FROM `assignment_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb51 = $con->query("SELECT `mark` FROM `otherassesment_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb61 = $con->query("SELECT `points` FROM `sem_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $res1 = $tb11->fetch_row();
                  $res2 = $tb21->fetch_row();
                  $res3 = $tb31->fetch_row();
                  $res4 = $tb41->fetch_row();
                  $res5 = $tb51->fetch_row();
                  $res6 = $tb61->fetch_row();
                  if(gettype($res1)!= 'NULL' && gettype($res2)!= 'NULL' && gettype($res3)[0]!= 'NULL' && gettype($res4)[0]!= 'NULL' &&gettype($res5)[0]!= 'NULL' && gettype($res6)[0]!= 'NULL'){
                  //echo "hi";
                  ?>
                  <td class="center aligned" ><div class="ui positive button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                  <?php
                  }
                  else{
                    ?>
                    <td class="center aligned" ><div class="ui positive disabled button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                    <?php
                  }  
              }
                else{
                  ?>
                  <td class="center aligned" ><div class="ui positive disabled button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                  <?php
                }
              }
              else{
                ?>
                <td class="center aligned" ><div class="ui positive disabled button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                <?php
              }
              ?>

          </tr>  
            <?php
            $no+=1;
            $same=$row1['code'];
          
          }
          if($row1['staff1']==$_SESSION['staffid'] || $row1['staff2']==$_SESSION['staffid'] || $row1['staff3']==$_SESSION['staffid'] || $row1['staff4']==$_SESSION['staffid'])
          {
              
              // echo $row1['code'];
              if($same==$row1['code'])
              {

              }
              else
              {

              ?>
              <tr>
                  <td class="center aligned" ><?php  echo $no;            ?> </td>
                  <td class="center aligned" ><?php  echo $row1['code'];  ?> </td>
                  <td class="center aligned" ><?php  echo $row1['name'];  ?> </td>
                  <td class="center aligned" ><?php  echo $row1['batch']; ?> </td>
                  <td class="center aligned" ><?php  echo $row1['sem'];   ?> </td>
                  <td class="center aligned" colspan="3" ><div class="ui positive  button" onclick="location.href = '../Entity/MarkEntry?code=<?php echo $row1['code']; ?>'">Mark Entry</div></td>
                  <!-- <td class="center aligned" ><div class="ui positive button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td> -->
                  <?php
                  $class=' ';
   
                if($row1['staff1']==$_SESSION['staffid'])
                {
                  $class='A';
                }
                elseif($row1['staff2']==$_SESSION['staffid'])
                {
                  $class='B';
                }
                elseif($row1['staff3']==$_SESSION['staffid'])
                {
                  $class='C';
                }
                elseif($row1['staff4']==$_SESSION['staffid'])
                {
                  $class='D';
                }
                //echo "SELECT * FROM `cat1_".$row1['code']."_".$row1['batch']."`";
                $tb1 = $con->query("SELECT * FROM `cat1_".$row1['code']."_".$row1['batch']."`");
                $tb2 = $con->query("SELECT * FROM `cat2_".$row1['code']."_".$row1['batch']."`");
                $tb3 = $con->query("SELECT * FROM `cat3_".$row1['code']."_".$row1['batch']."`");
                $tb4 = $con->query("SELECT * FROM `assignment_".$row1['code']."_".$row1['batch']."`");
                $tb5 = $con->query("SELECT * FROM `otherassesment_".$row1['code']."_".$row1['batch']."`");
                $tb6 = $con->query("SELECT * FROM `sem_".$row1['code']."_".$row1['batch']."`");
                
                if($tb1==true && $tb2==true && $tb3==true && $tb4==true && $tb5==true && $tb6==true){
                  $tb11 = $con->query("SELECT `Q1` FROM `cat1_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb21 = $con->query("SELECT `Q1` FROM `cat2_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb31 = $con->query("SELECT `Q1` FROM `cat3_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb41 = $con->query("SELECT `mark` FROM `assignment_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb51 = $con->query("SELECT `mark` FROM `otherassesment_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $tb61 = $con->query("SELECT `points` FROM `sem_".$row1['code']."_".$row1['batch']."` where `rollno` like  'Attco".$class."'");
                  $res1 = $tb11->fetch_row();
                  $res2 = $tb21->fetch_row();
                  $res3 = $tb31->fetch_row();
                  $res4 = $tb41->fetch_row();
                  $res5 = $tb51->fetch_row();
                  $res6 = $tb61->fetch_row();
                  if(gettype($res1)!= 'NULL' && gettype($res2)!= 'NULL' && gettype($res3)[0]!= 'NULL' && gettype($res4)[0]!= 'NULL' &&gettype($res5)[0]!= 'NULL' && gettype($res6)[0]!= 'NULL'){
                  //echo "hi";
                  ?>
                  <td class="center aligned" ><div class="ui positive button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                  <?php
                }
              }
                else{
                  ?>
                  <td class="center aligned" ><div class="ui positive disabled button" onclick="location.href = '../Final.php?code=<?php echo $row1['code']; ?>'">COPO Mapping</div></td>
                  <?php
                }
              ?>

      
            
              </tr>  
                <?php 
                $no+=1;
              }
              
          }
          else
          {
            
          }
      }?>



    </tbody>
  </table>
  </div>
  </div>
</body>
</html>

