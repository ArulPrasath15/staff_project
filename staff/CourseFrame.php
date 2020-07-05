<?php
   
   include_once("../db.php");
   session_start();
    if(!isset($_GET['code']))
    {
        header("Location: ./staff/index.php");

    }
    $_code=$_GET['code']; 
    $_staffid= $_SESSION['staffid'];
    // echo $_staffid;
    // echo $_code;
    if(isset($_POST["pattern"]))
    {
        $cnt=0;
         $_SESSION['exam']= $_POST['exam'];
        $str="CREATE TABLE ".($_POST['exam'])." (rollno varchar(10) NOT NULL,";
        $str1="INSERT INTO `".($_POST['exam'])."`(`rollno`, ";
        $cnt=0;
        for($i=1;$i<=$_POST["i"];$i++)
        {
            $c="cnt".strval($i);
           // $m="mark".strval($i);
           // $r="req".strval($i);
        
            for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
            {
               $str.="Q".strval($j)." INT ,";
               $str1.="`Q".strval($j)."`,";
            }
            $cnt+=$_POST[$c];
            
        }

        //$str=substr($str,0,strlen($str)-1);
        $str.=" PRIMARY KEY (rollno))";
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
        // echo $str1;

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
                <div  class="ui raised inverted segment" style="width:94%;margin:3%;">
                <form class="ui form" id="frm2" method="POST" action="./SavePage.php">
                <input type = "hidden" name = "test" value="'.($_POST['exam']).'"/>
                <input type = "hidden" name = "size" value="'.count($columnArr).'"/>
                <table class="ui fixed inverted selectable celled table" id="table-list">
                <thead>
                    <tr>';
                        for($i=0;$i<count($columnArr);$i++)
                        { 

                            if($i==0)
                            {
                                $str2.='<th class="center aligned"></th> ';
                            }
                            else{
                                $str2.='<th class="center aligned">'.$columnArr[$i].'</th> ';
                            }



                            
                        }
                        $str2.='</tr>';
                        $sql2 = $con->query("SELECT * FROM ".($_POST['exam'])."");
                        $res = $sql2->fetch_row();
                        $str2.='<tr>';
                            for($i=0;$i<count($res);$i++)
                            { 
                                $str2.='<th class="center aligned">'.$res[$i].'</th>';
                             } 
           
                         $str2.=' </tr> 
                 </thead>
                <tbody>
                    <tr>
                    <th class="center aligned">Expected Mark</th>';
                    $cnt=0;
                    for($i=1;$i<=$_POST["i"];$i++)
                    {
                        $c="cnt".strval($i);
                        $m="mark".strval($i);
        
                        for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
                        {
                            $str2.='<td class="center aligned"><input type = "number" name = "em'.$j.'" min="0" max="'.($_POST[$m]).'" required/></td>';    
                        }
                        $cnt+=$_POST[$c];
            
                    }
                    
                    $str2.='</tr>
                    <tr>
                    <th class="center aligned">Co</th>';
                    for($i=1;$i<count($res);$i++)
                    { 
                        $str2.='<td class="center aligned"><input type = "number" name = "c'.$i.'" min="1" max="5"/></td>';
                     }
                    $str2.='</tr>
                </tbody>
                </table>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.js"></script>

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


</style>
<body>
    <!-- navbar -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
        <a class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="item"  style="margin-left:900px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->
<?php 
$sql="SELECT * FROM `course_list` WHERE code LIKE '$_code' AND cc LIKE '$_staffid' ";
$res=$con->query($sql);
$rows=$res->fetch_assoc();
$count=$res->num_rows;
if($count==1)
{ ?>
   
  
<h2 class="ui center aligned icon header" style="margin:3%">
    <i class="settings icon"></i>
    <div class="content">
        Exam Pattern Framer
        <div class="sub header">Frame the Upcoming Exam Design.</div>
    </div>
    </h2>
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
                 <input type="number" name="cnt1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "2"  required />
            </div>
        
        </td>
        <td class="center aligned">
             <div class="ui input">
             <input type="number" name="mark1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "2"  required />            
                </div>
        
        </td>

    </tr>

    <tr>
        <td class="center aligned" >B</td>
        <td class="center aligned">
            <div class="ui input">
            <input type="number"  name="cnt2" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "2"  required />       
            </div>
        </td>
        <td class="center aligned">
            <div class="ui input">
            <input type="number" name="mark2" style="width:30%;margin-left:30%;margin-right:30%;font-size:20px;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "2"  required />   
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
        var con='<tr> <td class="center aligned" >'+char+'</td> <td class="center aligned"> <div class="ui input"> <input type="number" name="cnt'+i+'" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "2" required /> </div> </td> <td class="center aligned"> <div class="ui input"> <input type="number" name="mark'+i+'" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "2" required /> </div> </td> </tr>';
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
      $("#seg").css('visibility', 'visible');
      $("#seg1").hide();
      $("#cat").text("Exam : "+value.slice(0, 4));
       


}

  </script>  

<?php
}
else
{


    header("Location: ./staff/index.php");


}

?>
   </body>
</html>