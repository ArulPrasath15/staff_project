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
              <!-- <td class="center aligned" ><div class="ui positive button">Activate</div></td> -->

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

