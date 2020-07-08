<?php 
include_once("../db.php");
session_start();
$_staffid=$_GET['cc'];
$_code=$_GET['code'];
$_SESSION['code']=$_code;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Staff</title>
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
.ui.card
{
    width:900px;
    height:500px;

}
h2
{
    color:white;

}
</style>

<script>

$(document).ready(function(){

  $('.ui.dropdown')
  .dropdown();

});


</script>

<body>
    <!-- navbar -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="./index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="right aligned item"  style="margin-left:1100px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->
<br><br>
<center>
    <div class="ui inverted card">
    <form class="ui form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <br>
        <div class="header"><h2>Assign Faculty</h2></div>
         <!-- <div class="ui divider"></div> -->
        <?php
            $sql="SELECT * FROM  `course_list` WHERE `cc` LIKE '$_staffid' AND  `code` LIKE '$_code' ";
            $data=$con->query($sql);
            $count=$data->num_rows;
            $row=$data->fetch_assoc();
            // echo $row['name'];
            // echo $count;
            if($count==1)
            { ?>
                
                <table class="ui celled fixed selectable inverted table">
                     <tbody>
                        <tr>
                            <td class="center aligned">Course Code</td>
                            <td class="center aligned"><?php  echo $row['code'];  ?></td>
                     
                        </tr>
                        <tr>
                             <td class="center aligned">Course Name</td>
                            <td class="center aligned"><?php  echo $row['name'];   ?></td>
                        </tr> 
                        <tr>
                             <td class="center aligned">Batch</td>
                            <td class="center aligned"><?php  echo $row['batch'];   ?></td>
                        </tr>
                        <tr>
                             <td class="center aligned">Semester</td>
                            <td class="center aligned"><?php  echo $row['sem'];   ?></td>
                        </tr>
                        <tr>
                             <td class="center aligned">Credit</td>
                            <td class="center aligned"><?php  echo $row['credit'];   ?></td>
                        </tr>
                        </tbody>
                     </table>

                     <table class="ui celled padding  selectable inverted table">
                     <thead>
                        <tr>
                            <th  class="center aligned"> Section</th>
                            <th  class="center aligned"> Staff</th>
                        
                         </tr>
                     </thead>
                     <tbody>
                              <tr>
                                <td class="center aligned"> A  </td>
                                <td class="center aligned"> 

                                    <select name='Adrop' id='Adropid'  class="ui fluid search dropdown" >
                                    <?php 
                                    if($row['staff1']==null)
                                    {?>
                                        <option value="">Staff</option>

                                    <?php }
                                    else
                                    {
                                        $staff1=$row['staff1'];
                                        $sql1="SELECT * from  staff  WHERE  `staffid` LIKE '$staff1' ";
                                        $data=$con->query($sql1);
                                        $row1=$data->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $row['staff1'] ?>"><?php echo $row1['name'];?></option>

                                    <?php }
                                    ?>
                                    <option value="CSE001SF">Dr.N.Shanthi</option>
                                    <option value="CSE002SF">Dr.R.R.Rajalaxmi</option>
                                    <option value="CSE003SF">Dr.K.Kousalya</option>
                                    <option value="CSE004SF">Dr.S.Malliga</option>
                                    <option value="CSE005SF">Dr.R.C.Suganthe</option>
                                    <option value="CSE006SF">Dr.P.Natesan</option>
                                    <option value="CSE007SF">Dr.C.S.Kanimozhi Selvi</option>
                                    <option value="CSE008SF">Dr.E.Gothai</option>
                                    <option value="CSE009SF">Dr.P.Jayanthi</option>
                                    <option value="CSE010SF">Dr.S.Shanthi</option>
                                    <option value="CSE011SF">Mr.N.P.Saravanan</option>
                                    <option value="CSE012SF">Dr.K.Nirmala Devi</option>
                                    <option value="CSE013SF">Ms.PCD.Kalaivaani</option>
                                    <option value="CSE014SF">Dr.R.S.Latha</option>
                                    <option value="CSE015SF">Dr.N.Krishnamoorthy</option>
                                    <option value="CSE016SF">Dr.K.Sangeetha</option>
                                    <option value="CSE017SF">Dr.S.V.Kogilavani</option>
                                    <option value="CSE018SF">Dr.P.Vishnu Raja</option>
                                    <option value="CSE019SF">Dr.P.Keerthika</option>
                                    <option value="CSE020SF">Dr.S.K.Nivetha</option>
                                    <option value="CSE021SF">Dr.R.S.Mohana</option>
                                    <option value="CSE022SF">Ms.M.Geetha</option>
                                    <option value="CSE023SF">Dr.R.Manjula Devi</option>
                                    <option value="CSE024SF">Mr.T.Kumaravel</option>
                                    <option value="CSE025SF">Ms.S.Ramya</option>
                                    <option value="CSE026SF">Mr.K.Devendran</option>
                                    <option value="CSE027SF">Ms.N.Sasipriyaa</option>
                                    <option value="CSE028SF">Mr.B.Bizu</option>
                                    <option value="CSE029SF">Mr.R.Sureshkumar</option>
                                    <option value="CSE030SF">Ms.D.Deepa</option>
                                    <option value="CSE031SF">Mr.S.Selvaraj</option>
                                    <option value="CSE032SF">Ms.M.Sangeetha</option>
                                    <option value="CSE033SF">Ms.O.R.Deepa</option>
                                    <option value="CSE034SF">Mr.P.S.Prakash</option>
                                    <option value="CSE035SF">Ms.K.S.Kalaivani</option>
                                    <option value="CSE036SF">Mr.S.Santhoshkumar</option>
                                    <option value="CSE037SF">Ms.C.Sagana</option>
                                    <option value="CSE038SF">Mr.B.Krishnakumar</option>
                                    <option value="CSE039SF">Ms.S.Mohana Saranya</option>
                                    <option value="CSE040SF">Ms.S.Mohanapriya </option>
                                    <option value="CSE041SF">Ms.P.S.Nandhini</option>
                                    <option value="CSE042SF">Ms.K.Tamil Selvi </option>
                                    <option value="CSE043SF">Ms.M.K.Dharani</option>
                                    <option value="CSE044SF">Ms.Vani Rajasekar</option>
                                    <option value="CSE045SF">Ms.K.Venu</option>
                                    <option value="CSE046SF">Dr.K.Dinesh</option>
                                </select>

                                </td>
                            </tr>
                            <tr>
                                <td class="center aligned">B</td>
                                <td class="center aligned">
                                
                                <select name='Bdrop' class="ui fluid search dropdown">
                                <?php 
                                    if($row['staff2']==null)
                                    {?>
                                        <option value="">Staff</option>

                                    <?php }
                                    else
                                    {
                                        $staff2=$row['staff2'];
                                        $sql1="SELECT * from  staff  WHERE  `staffid` LIKE '$staff2' ";
                                        $data=$con->query($sql1);
                                        $row1=$data->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $row['staff2'];?>"><?php echo $row1['name'];?></option>

                                    <?php }
                                    ?>
                                    <option value="CSE001SF">Dr.N.Shanthi</option>
                                    <option value="CSE002SF">Dr.R.R.Rajalaxmi</option>
                                    <option value="CSE003SF">Dr.K.Kousalya</option>
                                    <option value="CSE004SF">Dr.S.Malliga</option>
                                    <option value="CSE005SF">Dr.R.C.Suganthe</option>
                                    <option value="CSE006SF">Dr.P.Natesan</option>
                                    <option value="CSE007SF">Dr.C.S.Kanimozhi Selvi</option>
                                    <option value="CSE008SF">Dr.E.Gothai</option>
                                    <option value="CSE009SF">Dr.P.Jayanthi</option>
                                    <option value="CSE010SF">Dr.S.Shanthi</option>
                                    <option value="CSE011SF">Mr.N.P.Saravanan</option>
                                    <option value="CSE012SF">Dr.K.Nirmala Devi</option>
                                    <option value="CSE013SF">Ms.PCD.Kalaivaani</option>
                                    <option value="CSE014SF">Dr.R.S.Latha</option>
                                    <option value="CSE015SF">Dr.N.Krishnamoorthy</option>
                                    <option value="CSE016SF">Dr.K.Sangeetha</option>
                                    <option value="CSE017SF">Dr.S.V.Kogilavani</option>
                                    <option value="CSE018SF">Dr.P.Vishnu Raja</option>
                                    <option value="CSE019SF">Dr.P.Keerthika</option>
                                    <option value="CSE020SF">Dr.S.K.Nivetha</option>
                                    <option value="CSE021SF">Dr.R.S.Mohana</option>
                                    <option value="CSE022SF">Ms.M.Geetha</option>
                                    <option value="CSE023SF">Dr.R.Manjula Devi</option>
                                    <option value="CSE024SF">Mr.T.Kumaravel</option>
                                    <option value="CSE025SF">Ms.S.Ramya</option>
                                    <option value="CSE026SF">Mr.K.Devendran</option>
                                    <option value="CSE027SF">Ms.N.Sasipriyaa</option>
                                    <option value="CSE028SF">Mr.B.Bizu</option>
                                    <option value="CSE029SF">Mr.R.Sureshkumar</option>
                                    <option value="CSE030SF">Ms.D.Deepa</option>
                                    <option value="CSE031SF">Mr.S.Selvaraj</option>
                                    <option value="CSE032SF">Ms.M.Sangeetha</option>
                                    <option value="CSE033SF">Ms.O.R.Deepa</option>
                                    <option value="CSE034SF">Mr.P.S.Prakash</option>
                                    <option value="CSE035SF">Ms.K.S.Kalaivani</option>
                                    <option value="CSE036SF">Mr.S.Santhoshkumar</option>
                                    <option value="CSE037SF">Ms.C.Sagana</option>
                                    <option value="CSE038SF">Mr.B.Krishnakumar</option>
                                    <option value="CSE039SF">Ms.S.Mohana Saranya</option>
                                    <option value="CSE040SF">Ms.S.Mohanapriya </option>
                                    <option value="CSE041SF">Ms.P.S.Nandhini</option>
                                    <option value="CSE042SF">Ms.K.Tamil Selvi </option>
                                    <option value="CSE043SF">Ms.M.K.Dharani</option>
                                    <option value="CSE044SF">Ms.Vani Rajasekar</option>
                                    <option value="CSE045SF">Ms.K.Venu</option>
                                    <option value="CSE046SF">Dr.K.Dinesh</option>
                                </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="center aligned">C</td>
                                <td class="center aligned">
                                <select name='Cdrop' style="color:black;" class="ui fluid search dropdown">
                                <?php 
                                if($row['staff3']==null)
                                {?>
                                    <option value="">Staff</option>

                                <?php }
                                else
                                {
                                    $staff3=$row['staff3'];
                                    $sql1="SELECT * from  staff  WHERE  `staffid` LIKE '$staff3' ";
                                    $data=$con->query($sql1);
                                    $row1=$data->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $row['staff3'];?>"><?php echo $row1['name'];?></option>

                                <?php }
                                ?>
                                    <option value="CSE001SF">Dr.N.Shanthi</option>
                                    <option value="CSE002SF">Dr.R.R.Rajalaxmi</option>
                                    <option value="CSE003SF">Dr.K.Kousalya</option>
                                    <option value="CSE004SF">Dr.S.Malliga</option>
                                    <option value="CSE005SF">Dr.R.C.Suganthe</option>
                                    <option value="CSE006SF">Dr.P.Natesan</option>
                                    <option value="CSE007SF">Dr.C.S.Kanimozhi Selvi</option>
                                    <option value="CSE008SF">Dr.E.Gothai</option>
                                    <option value="CSE009SF">Dr.P.Jayanthi</option>
                                    <option value="CSE010SF">Dr.S.Shanthi</option>
                                    <option value="CSE011SF">Mr.N.P.Saravanan</option>
                                    <option value="CSE012SF">Dr.K.Nirmala Devi</option>
                                    <option value="CSE013SF">Ms.PCD.Kalaivaani</option>
                                    <option value="CSE014SF">Dr.R.S.Latha</option>
                                    <option value="CSE015SF">Dr.N.Krishnamoorthy</option>
                                    <option value="CSE016SF">Dr.K.Sangeetha</option>
                                    <option value="CSE017SF">Dr.S.V.Kogilavani</option>
                                    <option value="CSE018SF">Dr.P.Vishnu Raja</option>
                                    <option value="CSE019SF">Dr.P.Keerthika</option>
                                    <option value="CSE020SF">Dr.S.K.Nivetha</option>
                                    <option value="CSE021SF">Dr.R.S.Mohana</option>
                                    <option value="CSE022SF">Ms.M.Geetha</option>
                                    <option value="CSE023SF">Dr.R.Manjula Devi</option>
                                    <option value="CSE024SF">Mr.T.Kumaravel</option>
                                    <option value="CSE025SF">Ms.S.Ramya</option>
                                    <option value="CSE026SF">Mr.K.Devendran</option>
                                    <option value="CSE027SF">Ms.N.Sasipriyaa</option>
                                    <option value="CSE028SF">Mr.B.Bizu</option>
                                    <option value="CSE029SF">Mr.R.Sureshkumar</option>
                                    <option value="CSE030SF">Ms.D.Deepa</option>
                                    <option value="CSE031SF">Mr.S.Selvaraj</option>
                                    <option value="CSE032SF">Ms.M.Sangeetha</option>
                                    <option value="CSE033SF">Ms.O.R.Deepa</option>
                                    <option value="CSE034SF">Mr.P.S.Prakash</option>
                                    <option value="CSE035SF">Ms.K.S.Kalaivani</option>
                                    <option value="CSE036SF">Mr.S.Santhoshkumar</option>
                                    <option value="CSE037SF">Ms.C.Sagana</option>
                                    <option value="CSE038SF">Mr.B.Krishnakumar</option>
                                    <option value="CSE039SF">Ms.S.Mohana Saranya</option>
                                    <option value="CSE040SF">Ms.S.Mohanapriya </option>
                                    <option value="CSE041SF">Ms.P.S.Nandhini</option>
                                    <option value="CSE042SF">Ms.K.Tamil Selvi </option>
                                    <option value="CSE043SF">Ms.M.K.Dharani</option>
                                    <option value="CSE044SF">Ms.Vani Rajasekar</option>
                                    <option value="CSE045SF">Ms.K.Venu</option>
                                    <option value="CSE046SF">Dr.K.Dinesh</option>
                                </select>
                                
                                
                                </td>
                            </tr> 
                            <tr>
                                <td class="center aligned">D</td>
                                <td class="center aligned">
                                <select  name='Ddrop' class="ui fluid search dropdown">
                                <?php 
                                    if($row['staff4']==null)
                                    {?>
                                        <option value="">Staff</option>

                                    <?php }
                                    else
                                    {
                                        $staff4=$row['staff4'];
                                        $sql1="SELECT * from  staff  WHERE  `staffid` LIKE '$staff4' ";
                                        $data=$con->query($sql1);
                                        $row1=$data->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $row['staff4'];?>"><?php echo $row1['name'];?></option>

                                    <?php }
                                    ?>
                                    <option value="CSE001SF">Dr.N.Shanthi</option>
                                    <option value="CSE002SF">Dr.R.R.Rajalaxmi</option>
                                    <option value="CSE003SF">Dr.K.Kousalya</option>
                                    <option value="CSE004SF">Dr.S.Malliga</option>
                                    <option value="CSE005SF">Dr.R.C.Suganthe</option>
                                    <option value="CSE006SF">Dr.P.Natesan</option>
                                    <option value="CSE007SF">Dr.C.S.Kanimozhi Selvi</option>
                                    <option value="CSE008SF">Dr.E.Gothai</option>
                                    <option value="CSE009SF">Dr.P.Jayanthi</option>
                                    <option value="CSE010SF">Dr.S.Shanthi</option>
                                    <option value="CSE011SF">Mr.N.P.Saravanan</option>
                                    <option value="CSE012SF">Dr.K.Nirmala Devi</option>
                                    <option value="CSE013SF">Ms.PCD.Kalaivaani</option>
                                    <option value="CSE014SF">Dr.R.S.Latha</option>
                                    <option value="CSE015SF">Dr.N.Krishnamoorthy</option>
                                    <option value="CSE016SF">Dr.K.Sangeetha</option>
                                    <option value="CSE017SF">Dr.S.V.Kogilavani</option>
                                    <option value="CSE018SF">Dr.P.Vishnu Raja</option>
                                    <option value="CSE019SF">Dr.P.Keerthika</option>
                                    <option value="CSE020SF">Dr.S.K.Nivetha</option>
                                    <option value="CSE021SF">Dr.R.S.Mohana</option>
                                    <option value="CSE022SF">Ms.M.Geetha</option>
                                    <option value="CSE023SF">Dr.R.Manjula Devi</option>
                                    <option value="CSE024SF">Mr.T.Kumaravel</option>
                                    <option value="CSE025SF">Ms.S.Ramya</option>
                                    <option value="CSE026SF">Mr.K.Devendran</option>
                                    <option value="CSE027SF">Ms.N.Sasipriyaa</option>
                                    <option value="CSE028SF">Mr.B.Bizu</option>
                                    <option value="CSE029SF">Mr.R.Sureshkumar</option>
                                    <option value="CSE030SF">Ms.D.Deepa</option>
                                    <option value="CSE031SF">Mr.S.Selvaraj</option>
                                    <option value="CSE032SF">Ms.M.Sangeetha</option>
                                    <option value="CSE033SF">Ms.O.R.Deepa</option>
                                    <option value="CSE034SF">Mr.P.S.Prakash</option>
                                    <option value="CSE035SF">Ms.K.S.Kalaivani</option>
                                    <option value="CSE036SF">Mr.S.Santhoshkumar</option>
                                    <option value="CSE037SF">Ms.C.Sagana</option>
                                    <option value="CSE038SF">Mr.B.Krishnakumar</option>
                                    <option value="CSE039SF">Ms.S.Mohana Saranya</option>
                                    <option value="CSE040SF">Ms.S.Mohanapriya </option>
                                    <option value="CSE041SF">Ms.P.S.Nandhini</option>
                                    <option value="CSE042SF">Ms.K.Tamil Selvi </option>
                                    <option value="CSE043SF">Ms.M.K.Dharani</option>
                                    <option value="CSE044SF">Ms.Vani Rajasekar</option>
                                    <option value="CSE045SF">Ms.K.Venu</option>
                                    <option value="CSE046SF">Dr.K.Dinesh</option>
                                </select>

                                </td>
                            </tr> 
                    </tbody>
                    <tfoot>
                        <td colspan="2">
                           <center><button class="ui positive button" name="submit" type="submit">Submit</button></center>
                        </td>
                    </tfoot>
                 </table>
                    <div class="ui input" style="visibility: hidden">
                     <input type="text" name='codec' value="<?php echo $_SESSION['code']; ?>">
                    </div>

             <?php
            }
            else
            {?>
                <br><br><br><br><br>
                <H1 style="color:red">Access Denied !</H1>

             <?php  
            }?>


        </form>
    </div>
    

</center>
</body>
</html>


<?php

if(isset($_POST['submit']))
{
    
    $A=$_POST['Adrop'];
    $B=$_POST['Bdrop'];
    $C=$_POST['Cdrop'];
    $D=$_POST['Ddrop'];
    $ccode=$_POST['codec'];
    
    $sql1=" UPDATE  `course_list` SET  `staff1` = '$A' , `staff2` = '$B', `staff3` = '$C', `staff4` = '$D' WHERE `code` LIKE '$ccode' ";
    if($con->query($sql1)==true)
    {
        header("Location: ../staff/index.php");
    }
    else{
        echo 'failed';
        header("Location: ../staff/index.php");
    }

 }

?>















