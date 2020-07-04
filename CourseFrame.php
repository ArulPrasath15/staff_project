<?php
   
   include_once("db.php");

   if(isset($_POST["pattern"]))
    {
        $cnt=0;
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
        //echo $str1;

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
                $str2='<form class="ui form" id="frm2" method="POST" action="SavePage.php">
                <input type = "hidden" name = "test" value="'.($_POST['exam']).'"/>
                <input type = "hidden" name = "size" value="'.count($columnArr).'"/>
                <table class="ui fixed selectable celled table" id="table-list">
                <thead>
                    <tr>';
                        for($i=0;$i<count($columnArr);$i++)
                        { 
                            $str2.='<th class="center aligned">'.$columnArr[$i].'</th> ';
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
                            $str2.='<td class="center aligned"><input type = "number" name = "em'.$j.'" min="0" max="'.($_POST[$m]).'"/></td>';    
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
                <center><button class="ui primary  button" type="submit" style="border-radius:40px;margin-top:3%;width:20%"><h2>Frame</h2></button></center>
                </form>';
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
<body>
    <h2 class="ui center aligned icon header" style="margin:3%">
    <i class="settings icon"></i>
    <div class="content">
        Exam Framer
        <div class="sub header">Frame the Upcoming Exam Design.</div>
    </div>
    </h2>
    
    <div class="ui raised inverted segment" style="width:94%;margin:3%; id="seg">

    <div class="ui focus input" style="width:10%;margin-left:40%;">
        <input type="text" style="border-radius:20px;border-color: black;" value="No.of Questions" readonly>
    </div>
    <div class="ui focus input" style="width:8%;margin-left:5%;">
        <input type="text" style="border-radius:20px;border-color: black;" value="Max Mark" readonly>
    </div>

    <button class="ui circular right floated  blue icon button" id="ADD"><i class="add icon"></i></button>
    <form class="ui form" id="frm">   



        <div class="ui raised  container segment" style="width:60%;border-radius:50px;margin-top:3%;">

            <span class="ui header" style="font-size:30px;margin-left:10%;">Part &nbsp A</span>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px;border-color: black;" name="cnt1" maxlength:"2" required>
            </div>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px;border-color: black;" name="mark1" required>
            </div>

        </div>
        <div class="ui raised  container segment" style="width:60%;border-radius:50px;margin-top:3%;">

            <span class="ui header" style="font-size:30px;margin-left:10%;">Part &nbsp B</span>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px;border-color: black;" name="cnt2" maxlength:"2" required>
            </div>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px;border-color: black;" name="mark2" required>
            </div>

        </div>
        <div id="content"></div>
        <div style="width:8.5%;margin-left:45%;margin-top:3%;">
        <select class="ui fluid search dropdown" name="exam" required>
            <option Value="">Exam</option>
            <option Value="cat1">CAT1</option>
            <option Value="cat2">CAT2</option>
            <option Value="cat3">CAT3</option>
        </select>
        </div>
        
        <center><button class="ui primary  button" type="submit" id="b1" style="border-radius:40px;margin-top:3%;width:20%"><h2>Finalize</h2></button></center>
        </form>
        <div id="content1"></div>
    </div>
    

    </div>
  <script>
  var i=2;
  var str = "BCDEF";
  
  $(document).ready(function(){
      $("#ADD").on("click",function(){  
        i+=1;      
        var char = String.fromCharCode(64+i);
          
        var con='<div class="ui raised  container segment" style="width:60%;border-radius:50px;margin-top:3%;"><span class="ui header" style="font-size:30px;margin-left:10%;">Part &nbsp '+char+'</span><div class="ui focus input" style="width:6.5%;margin-left:16%;"><input type="text" style="border-radius:20px;border-color: black;" name="cnt'+i+'" required></div><div class="ui focus input" style="width:6.5%;margin-left:15%;"><input type="text" style="border-radius:20px;border-color: black;"  name="mark'+i+'" required></div></div>';
        document.getElementById("content").innerHTML+=con;
        
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
                //alert(d);
                document.getElementById("content1").innerHTML+=d;
            }
        });
        return false;
      });

  });
  </script>  
</body>
</html>