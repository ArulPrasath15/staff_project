<?php
include_once("../db.php");
session_start();
?>
<html lang="en">
<head>
      <meta charset="utf-8" />
      <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no"/>
     <?php include_once('../assets/notiflix.php'); ?>
      <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css" />
      <script src="../assets/jquery.min.js"></script>
      <script src="../assets/Fomantic/dist/semantic.min.js"></script>
      <link rel="stylesheet" href="../assets/animate.min.css" type="text/css" />

</head>
<body>

    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="../staff/index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="right aligned item"  style="margin-left:1100px;"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
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


