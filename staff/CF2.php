<?php
   
   include_once("../db.php");
   session_start();
   if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}

    if(!isset($_GET['exam']))
    {
        header("Location: ./index.php");

    }
    else
    {
        $str1='Assignment_'.strval($_SESSION['code']).'_'.strval($_SESSION['batch']);
        $str2='OtherAssesment_'.strval($_SESSION['code']).'_'.strval($_SESSION['batch']);
        $str3='SEM_'.strval($_SESSION['code']).'_'.strval($_SESSION['batch']);
        if(!((strval($_GET['exam'])==$str1) or (strval($_GET['exam'])==$str2) or (strval($_GET['exam'])==$str3)))
        {
            header("Location: ./index.php");
        }
    }
    $_SESSION['exam']=$_GET['exam']; 
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Frame</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
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
<div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div>

<body>


    <!-- navbar -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="./index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="right aligned item"  style="margin-left:1100px;"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->
<h2 class="ui center aligned icon header" style="margin:3%">
    <i class="inverted yellow settings icon"></i>
    <div style="color:#ffd700" class="content">
        Exam Pattern Framer
        <div style="color:#ffd700" class="sub header">Frame the Upcoming Exam Design.</div>
    </div>
    </h2>
    <br>
    <form class="ui form" id="frm" method="POST" action="./SavePage.php"> 

    <div  class="ui raised inverted segment" style="width:94%;margin:3%;";>
    
    <center> 
    <span id="scode">Course Code : <?php echo $_SESSION['code'] ?>  </span>
    <div class="ui divider"></div>
    <span id="scode" style="margin-left:50px;">Course Name : <?php echo $_SESSION['cname'] ?>  </span>
    <div class="ui divider"></div>
    <span id="cat" style="margin-left:30px;">Exam : <?php echo $_SESSION['exam'] ?> </span>
        
    
    </center>


      <div class="ui divider"></div>
    <br>
    <table class="ui selectable fixed celled inverted table">
  <tbody>
    <tr>
        <td class="center aligned" >MAX MARK</td>
        <td class="center aligned">
             <div class="ui input">
                 <input type="number" name="max1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"  
                type = "number"
                maxlength = "2" min="0" required />
            </div>
        
        </td>

    </tr>

    <tr>
        <td class="center aligned" >EXP MARK</td>
        <td class="center aligned">
             <div class="ui input">
                 <input type="number" name="exp1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;"  
                type = "number"
                maxlength = "2"  min="0" required />
            </div>
        
        </td>

    </tr>



    
  </tbody>
  
</table>

<div class="ui divider"></div>
     <center>

        <br>
        <button class="ui small primary  button" type="submit" name="create-assign" style="border-radius:5px;"><h2>Finalize</h2></button></center>
        </form>
        </div>




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

</body>
</html>