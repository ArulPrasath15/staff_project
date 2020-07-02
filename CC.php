<?php
    $con=new mysqli("localhost","root","","staff");
    if($con->connect_error)
    {
        die("Database Connection Failed ".$con->connect_error );
    }
    if(isset($_POST["pattern"]))
    {
        $cnt=0;
        $str="CREATE TABLE CAT1 (ROLL varchar(10) NOT NULL,";
        $cnt=0;
        for($i=1;$i<=$_POST["i"];$i++)
        {
            $c="cnt".strval($i);
            $m="mark".strval($i);
            $r="req".strval($i);
        
            for($j=1+$cnt;$j<=$cnt+$_POST[$c];$j++)
            {
               $str.="Q".strval($j)." INT ";
               if(isset($_POST[$r]))
               {
                   $str.="NOT NULL DEFAULT '0'";
               }
               $str.=",";
            }
            $cnt+=$_POST[$c];
            
        }
        $str=substr($str,0,strlen($str)-1);
        $str.=")";
     
        if($con->query($str))
        {
            echo "Success";
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
    
    <div class="ui raised segment" style="width:94%;margin:3%; id="seg">
    <button class="ui circular right floated  blue icon button" id="ADD"><i class="add icon"></i></button>
    <form class="ui form" id="frm">   

        

        <div class="ui raised  container segment" style="width:60%;border-radius:50px;margin-top:3%;">

            <span class="ui header" style="font-size:30px;margin-left:10%;">Part &nbsp A</span>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px" name="cnt1" maxlength:"2">
            </div>
            <div class="ui focus input" style="width:6.5%;margin-left:15%;">
                <input type="text" style="border-radius:20px" name="mark1">
            </div>
            <div class="ui slider checkbox" style="margin-left:10%;">
                <input type="checkbox" name="req1">
                <label>Required</label>
            </div>

        </div>
        <div id="content"></div>
        <center><button class="ui primary  button" type="submit" style="border-radius:40px;margin-top:3%;width:20%"><h2>Finalize</h2></button></center>
        </form>
    </div>
    

    </div>
  <script>
  var i=1;
  var str = "BCDEF";
  
  $(document).ready(function(){
      $("#ADD").on("click",function(){  
        i+=1;      
        var char = String.fromCharCode(64+i);
          
        var con='<div class="ui raised  container segment" style="width:60%;border-radius:50px;margin-top:3%;"><span class="ui header" style="font-size:30px;margin-left:10%;">Part &nbsp '+char+'</span><div class="ui focus input" style="width:6.5%;margin-left:16%;"><input type="text" style="border-radius:20px" name="cnt'+i+'"></div><div class="ui focus input" style="width:6.5%;margin-left:15%;"><input type="text" style="border-radius:20px"  name="mark'+i+'"></div><div class="ui slider checkbox" style="margin-left:10%;"><input type="checkbox" name="req'+i+'"><label>Required</label></div></div>';
        document.getElementById("content").innerHTML+=con;
        
      });


      $("#frm").on("submit",function(){
        var form=$("#frm").serialize();
        form+="&i="+i+"&pattern=framed";
        $.ajax({  
            url:"",
            data:form,
            type:"POST",
            success:function(d){
                alert(d);
            }
        });
        return false;
      });

  });
  </script>  
</body>
</html>