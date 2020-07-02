<?php 

include_once("../db.php");
session_start();
$_SESSION["staffid"]="CSE023SF";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
</head>

<style>
body
{
    background-image: url("../Images/bg.jpg");
}
.tablecontent{
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 50px;
    padding-bottom: 50px;
}

</style>
    

<body>
<!-- Navbar start -->
  <!-- <div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div> -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
        <a class="active green item" style="font-size:20px">KEC Student +</a>
        
        <a  class="item"  style="margin-left:1060px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- Navbar ended -->

<!-- Table start -->
<div class="tablecontent">
<table class="ui selectable celled inverted table">
  <thead>
    <tr>
        <th class="center aligned">No</th>
        <th class="center aligned">Course Code</th>
        <th class="center aligned">Course Name</th>
        <th class="center aligned">Batch</th>
        <th class="center aligned">Sem</th>
        <th class="center aligned" colspan="3" >Action</th>
    </tr>
  </thead>
 <tbody>
    <?php
     $no=1;
     $same;
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
            <td class="center aligned" > <div class="ui button">Frame Patten</div></td>
            <td class="center aligned" ><div class="ui button">Assign Faculty</div></td>
            <td class="center aligned" ><div class="ui positive button">Activate</div></td>

        </tr>  
          <?php
        $no+=1;
          $same=$row1['code'];
        
        }
        if($row1['staff1']==$_SESSION['staffid'] || $row1['staff2']==$_SESSION['staffid'] || $row1['staff3']==$_SESSION['staffid'])
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
                <td class="center aligned" colspan="3" > <div class="ui button"> Mark Entry</div> </td>

    
           
            </tr>  
              <?php 
              $no+=1;
            }
            
         }
         else
         {
            if($norecord==1)
            {
           ?>
           <tr>
               <td class="center aligned" colspan="6" >No Record</td>
           </tr>
            <?php
            }
            $norecord+=1;
         }
     }
?>



   
  </tbody>
</table>
</div>









</body>
</html>

