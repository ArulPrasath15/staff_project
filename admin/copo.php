<?php

include_once("../db.php");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creation</title>
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


</style>
<body>
<!-- navbar -->
<div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="./index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href="">Admin</h4></a>
        <a  class="right aligned item"  style="margin-left:1100px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->
    <h2 class="ui center aligned icon header" style="margin:3%">
        <i class="edit icon"></i>
        <div style="color:#ffd700" class="content">
            Course Creation
            <div class="sub header">Creating the courses.</div>
        </div>
    </h2>

    <form class="ui form" id="frm" method="POST" action="./sav.php">
    <table class="ui selectable fixed celled inverted table"> 
        <thead>
        <tr>
            <th colspan="15" class="center aligned">Mapping of COs with POs, PSOs</th>
        </tr>
        </thead>

        <tr>
            <th class="center aligned">COs / POs&PSOs</th>
            <?php
                for($i=1;$i<=12;$i++)
                {
            ?>
            <th class="center aligned">PO<?php echo $i;?></th>
            <?php } ?>
            <th class="center aligned">PSO1</th>
            <th class="center aligned">PSO2</th>
        </tr>
        
        <?php
                for($i=1;$i<=5;$i++)
                {
            ?>
                <tr>
                <th class="center aligned">CO<?php echo $i;?></th>
                <?php
                    for($j=1;$j<=12;$j++)
                    {
                ?>
                <td class="center aligned">
                    <div class="ui input">
                        <input type="number" name="<?php echo 'co'.$i.'po'.$j ;?>" maxlength = "1"  min="0" max="3" />
                    </div>
                </td>
                <?php } ?>
                <td class="center aligned">
                    <div class="ui input">
                        <input type="number" name="co<?php echo $i;?>pso1" maxlength = "1"  min="0" max="3" />
                    </div>
                </td>
                <td class="center aligned">
                    <div class="ui input">
                        <input type="number" name="co<?php echo $i;?>pso2" maxlength = "1"  min="0" max="3" />
                    </div>
                </td>
                </tr>
            <?php } ?>
        

        <tr>
            <th colspan="15" class="center aligned">1 - Slight, 2 - Moderate, 3 - Substantial</th>
        </tr>

    </table>
    <center><button class="ui small primary  button" type="submit" name="create-assign" style="border-radius:5px;"><h2>Finalize</h2></button></center>
    </form>

</body>

</html>


<!-- <?php
                for($i=1;$i<=5;$i++)
                {
            ?>
                <tr>
                <th class="center aligned">CO<?php echo $i;?></th>
                <?php
                    for($j=1;$j<=12;$j++)
                    {
                ?>
                <td class="center aligned">
                <div class="ui input">
                <input type="number" name="<?php echo 'co'.$i.'po'.$j ;?>" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" type = "number"
                    maxlength = "1"  min="0" required />
                    </div>
                </td>
                <?php } ?>
                <td class="center aligned">
                <div class="ui input">
                 <input type="number" name="co<?php echo $i;?>pso1" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" type = "number"
                    maxlength = "1"  min="0" required />
                </div>
                </td>
                <td class="center aligned">
                <div class="ui input">
                  <input type="number" name="co<?php echo $i;?>pso2" style="width:5%;margin-left:30%;margin-right:30%;font-size:20px;" type = "number"
                    maxlength = "1"  min="0" required />
                </div>
                </td>
                </tr>
            <?php } ?> -->