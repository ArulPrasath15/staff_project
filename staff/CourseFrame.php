<?php
   
   include_once("../db.php");
    session_start();
   if(!isset($_SESSION["staffid"]))
    {
    header("Location: ../index.php");
    }

    if(!isset($_GET['code']))
    {
        header("Location: ./index.php");

    }
    $_code=$_GET['code']; 
    $_staffid= $_SESSION['staffid'];
    $_SESSION['code']=$_GET['code'];
    // echo $_staffid;
    // echo $_code;
    if(isset($_POST["pattern"]))
    {
        $cnt=0;
        $_SESSION['exam']= $_POST['exam'];
        $str="CREATE TABLE ".($_POST['exam'])." (sec varchar(2) NULL , rollno varchar(10) NOT NULL,";
        $str1="INSERT INTO `".($_POST['exam'])."`(`rollno`, ";
        $cnt=0;
        for($i=1;$i<=$_POST["i"];$i++)
        {
            $c="cnt".strval($i);
           // $m="mark".strval($i);
           // $r="req".strval($i);
        
            for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
            {
               $str.="Q".strval($j)." FLOAT NULL,";
               $str1.="`Q".strval($j)."`,";
            }
            $cnt+=$_POST[$c];
            
        }

        //$str=substr($str,0,strlen($str)-1);
        $str.="Total FLOAT NULL, PRIMARY KEY (rollno))";
        $str1=substr($str1,0,strlen($str1)-1);
        $str1.=") VALUES ('Max Mark',";
        $cnt=0;
        for($i=1;$i<=$_POST["i"];$i++)
        {
            $c="cnt".strval($i);
            $m="mark".strval($i);
        
            for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
            {
               $str1.=strval($_POST[$m]).",";
            }
            $cnt+=$_POST[$c];
            
        }
        
        $str1=substr($str1,0,strlen($str1)-1);
        $str1.=")";
        // echo $str;

        if($con->query($str))
        {
            if($con->query($str1))
            {
                
                //echo "Success";
                $sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='".($_POST['exam'])."' ";
                $data=$con->query($sql);
                while($row = $data->fetch_assoc()){
                    $result[] = $row;
                }
                // Array of all column names
                $columnArr = array_column($result, 'COLUMN_NAME');
                $str2='
                <div  class="ui raised inverted segment" id="tabdiv" style="width:94%;margin:3%;">
                <form class="ui form" id="frm2" method="POST" action="./SavePage.php">
                <input type = "hidden" name = "test" value="'.($_POST['exam']).'"/>
                <input type = "hidden" name = "size" value="'.count($columnArr).'"/>
                <div id="tt">
                <table class="ui inverted celled table" id="table-list">
                <tbody>
                    <tr>';
                        for($i=1;$i<count($columnArr)-1;$i++)
                        { 

                            if($i==0)
                            {
                                $str2.='<td class="center aligned"></td> ';
                            }
                            else{
                                $str2.='<td class="center aligned">'.$columnArr[$i].'</td> ';
                            }



                            
                        }
                        $str2.='</tr>';
                        $sql2 = $con->query("SELECT * FROM ".($_POST['exam'])."");
                        $res = $sql2->fetch_row();
                        $str2.='<tr>';
                            for($i=1;$i<count($res)-1;$i++)
                            { 
                                $str2.='<td class="center aligned">'.$res[$i].'</td>';
                             } 
           
                         $str2.=' </tr> 
                 
                    <tr>
                    <th class="center aligned">Expected Mark</th>';
                    $cnt=0;
                    for($i=1;$i<=$_POST["i"];$i++)
                    {
                        $c="cnt".strval($i);
                        $m="mark".strval($i);
        
                        for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
                        {
                            $str2.='<td class="center aligned" style="padding-top: 0px;padding-bottom: 0px; padding-right: 5px;padding-left: 5px;"><input style="padding-top: 0px;padding-bottom: 0px; padding-right: 0px;padding-left: 5px;" type = "number" name = "em'.$j.'" min="0" max="'.($_POST[$m]).'" step="0.50" required/></td>';    
                        }
                        $cnt+=$_POST[$c];
            
                    }
                    
                    $str2.='</tr>
                    <tr>
                    <th class="center aligned">Co</th>';
                    for($i=1;$i<count($res)-2;$i++)
                    { 
                        $str2.='<td class="center aligned" style="padding-top: 0px;padding-bottom: 0px; padding-right: 5px;padding-left: 5px;"><input style="padding-top: 0px;padding-bottom: 0px; padding-right: 0px;padding-left: 5px;" type = "number" name = "c'.$i.'" min="1" max="5" required/></td>';
                     }
                    $str2.='</tr>
                </tbody>
                </table></div><br>
                <center><button class="ui small positive button" name="create" type="submit" style="border-radius:5px;"><h2>Confirm</h2></button></form>
                <form class="ui form" id="frm3" method="POST" action="./SavePage.php">
                   <br> <button class="ui small negative button" name="cancel" type="submit" style="border-radius:5px;"><h2>Cancel</h2></button></center>
                </form></div>';
                echo $str2;
            }
        }

        
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Frame</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <?php include_once('../assets/notiflix.php'); ?>
     <link rel="icon" type="image/png" href="../Images/logo.png">
      <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css" />
      <script src="../assets/jquery.min.js"></script>
      <script src="../assets/Fomantic/dist/semantic.min.js"></script>
      <link rel="stylesheet" href="../assets/animate.min.css" type="text/css" />
 
</head>
<style>
body
{
    background-image:url("../Images/bg.jpg");
    background-size: cover;
    
}
input[type="number"]{
height: 40px;

}
span{
    font-size:20px;
}
#tt{
    overflow-x: scroll;
    width: 100%;
    margin:auto;
    /* display: flex; */
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}


</style>
<!-- <div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div> -->

<body>
    <!-- navbar -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
        <a href="./index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a  class="right align item"  style="margin-left:1220px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      </div>
    </div>
<!-- navbar end -->
<?php 
$sql="SELECT * FROM `course_list` WHERE code LIKE '$_code' AND cc LIKE '$_staffid' ";
$res=$con->query($sql);
$rows=$res->fetch_assoc();
// echo $rows['batch'];
$_SESSION['batch']=$rows['batch'];
$_SESSION['cname']=$rows['name'];
$count=$res->num_rows;
if($count==1)
{ ?>
   
  
<h2 class="ui center aligned icon header" style="margin:3%">
    <i class="inverted yellow settings icon"></i>
    <div style="color:#ffd700" class="content">
        Exam Pattern Framer
        <div style="color:#ffd700" class="sub header">Frame the Upcoming Exam Design.</div>
    </div>
    </h2>
    <br>
    <form class="ui form" id="frm">  

    <div class="ui raised inverted segment" id="seg1" style="width:94%;margin:3%";>


    <br>
            <center> <span>Select Exam &nbsp;: &nbsp;&nbsp;</span><select class="ui  dropdown" id="dropd" name="exam" style="width: 250px;" onChange="drop(this.value);" required>
            <option Value="">Select Exam</option>

            <!-- CAT 1 -->
            <?php 
            $table='CAT1_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val !== FALSE)
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
            if($val !== FALSE)
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
            if($val !== FALSE)
            {
            }else
            {?>
                 <option Value=CAT3_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>CAT 3</option>

            <?php
            }
           ?>  
           <!-- Assignment -->
           <?php 
            $table='Assignment_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val !== FALSE)
            {
            }else
            {?>
                 <option Value=Assignment_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>Assignment</option>

            <?php
            }
           ?>  
           <!-- OtherAssesment -->
           <?php 
            $table='OtherAssesment_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val !== FALSE)
            {
            }else
            {?>
                 <option Value=OtherAssesment_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>OtherAssesment</option>

            <?php
            }
           ?>  
           <!-- SEM -->
           <?php 
            $table='SEM_'.$rows['code'].'_'.$rows['batch'];
            echo $table;
            $sql='select * from '.$table. '';
            $val = $con->query($sql);
            if($val !== FALSE)
            {
            }else
            {?>
                 <option Value=SEM_<?php echo strtoupper($rows['code']).'_'.$rows['batch']  ?>>SEM</option>

            <?php
            }
           ?>  
            
        </select></center><br>



    </div>
    
    
    <div  class="ui raised inverted segment" style="width:94%;margin:3%;visibility: hidden;"; id="seg">
    
    <center>
    
    
    <span id="scode">Course Code : <?php echo $_code ?>  </span>
    <div class="ui divider"></div>
    <span id="scode" style="margin-left:50px;">Course Name : <?php echo $rows['name'] ?>  </span>
    <div class="ui divider"></div>
    <span id="cat" style="margin-left:30px;"></span>
        
    
    </center>


      <div class="ui divider"></div>

     <div style="display: flex; justify-content: flex-end"> <button class="ui positive button" id="ADD" >ADD PART</i></button></div>
   
    <br>
    <table class="ui selectable fixed celled inverted table">
  <thead>
    <tr>
      <th class="center aligned"><h3>PART</h3></th>
      <th class="center aligned"><h3>No. of Questions</h3></th>
      <th class="center aligned"><h3>Marks For Each Questions</h3></th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
        <td class="center aligned" >A</td>
        <td class="center aligned">
             <div class="ui input">
                 <input type="number" name="cnt1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"
                type = "number"
                maxlength = "2"  required />
            </div>
        
        </td>
        <td class="center aligned">
             <div class="ui input">
             <input type="number" name="mark1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"
                type = "number"
                maxlength = "2"  min="0" step="0.50"  required />            
                </div>
        
        </td>

    </tr>

    <tr>
        <td class="center aligned" >B</td>
        <td class="center aligned">
            <div class="ui input">
            <input type="number"  name="cnt2" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"
                type = "number"
                maxlength = "2"  required />       
            </div>
        </td>
        <td class="center aligned">
            <div class="ui input">
            <input type="number" name="mark2" style="width:30%;margin-left:30%;margin-right:30%;font-size:20px;"
                type = "number"
                maxlength = "2"  min="0" step="0.50"  required />   
         </div>
        
        </td>
    </tr>



    
  </tbody>
  
</table>
    <div style="display: flex; justify-content: flex-end"><span style="align-content:right"class="ui negative button" id='del'>Delete</span></div>

<div class="ui divider"></div>
     <center>

        <br>
        <button class="ui small primary  button" type="submit" id="b1" style="border-radius:5px;"><h2>Finalize</h2></button></center>
        </form>

        </div>
        <div id="content1"></div>
    </br>
    

    </div>
  <script>


  var i=2;
  var str = "BCDEF";
  
  $(document).ready(function(){

    


    // $("#seg").hide();


      $('#ADD').click(function(){  
        i+=1;
        var x=$('table tr:last').find('td:first').html()     
        console.log("Added");
        var char=String.fromCharCode(x.charCodeAt() + 1) 
        var con='<tr> <td class="center aligned" >'+char+'</td> <td class="center aligned"> <div class="ui input"> <input type="number" name="cnt'+i+'" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" type = "number" maxlength = "2" required /> </div> </td> <td class="center aligned"> <div class="ui input"> <input type="number" name="mark'+i+'" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" type = "number" maxlength = "2"  min="0" step="0.50" required /> </div> </td> </tr>';
        $('table').append(con);
        
      });

      
      $("#frm").on("submit",function(){
        $("#b1").toggle();
        var form=$("#frm").serialize();
        form+="&i="+i+"&pattern=framed";
        $.ajax({  
            url:"",
            data:form,
            type:"POST",
            success:function(d){
                // alert(d);
                document.getElementById("content1").innerHTML+=d;
            }
        });
        return false;
      });


      $('#del').click(function() {
            i--;
            var totalRowCount = $("table").length;
            var rowCount = $("table td").closest("tr").length;
            var message = "Total Row Count: " + totalRowCount;
            message += "\nRow Count: " + rowCount;
           // alert(message);
            // console.log("ef");
            if(rowCount!=1)
            {
                $('table tr:last').detach();
            }
          //$('table tr:last').detach();
    });

    $('.ui.dropdown').dropdown();
  
});



 function drop(value){


      console.log(value);
   
      if(value=="<?php echo 'CAT3_'.$rows['code'].'_'.$rows['batch'];?>" || value=="<?php echo 'CAT2_'.$rows['code'].'_'.$rows['batch'];?>" || value=="<?php echo 'CAT1_'.$rows['code'].'_'.$rows['batch'];?>")
      { 
       
        $("#seg").css('visibility', 'visible');
        $("#seg1").hide();

      }
     
      if(value.slice(0, 3)=="CAT")
      {
        $("#cat").text("Exam : "+value.slice(0, 4));
      }
      else
      {
          window.location.href='CF2.php?exam='+value;
      }
       


}

  </script>  

<?php
}
else
{


    header("Location: ./index.php");


}

?>
   </body>
</html>