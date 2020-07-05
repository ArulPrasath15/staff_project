

<!-- THIS PAGE IS FOR MARK ENTRY TABLE -->
<?php
include_once("../db.php");
session_start();

$count=0;
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='cat1' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

    $sql="SELECT * from cat1 ORDER BY `rollno` ASC ";
    $data=$con->query($sql);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Mark</title>
  <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
  <link rel="stylesheet" href="../css/Table.css" type="text/css"/> 
  <!-- <script src="semantic/dist/semantic.min.js"></script> -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
</head>
<body class="animate__animated animate__backInDown">

<!-- navbar -->
<div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
        <a class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="item"  style="margin-left:900px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->

<!-- partial:index.partial.html -->
<div class="tablecontent">

        <table class="ui fixed selectable celled table" id="table-list">
            <thead>
                <tr  >
                    <?php
                    
                    for($i=0;$i<count($columnArr);$i++){ 
                        if($i==count($columnArr)-1)
                        {?>

                           
                            <th rowspan="4"class="center aligned"><?php echo strtoupper($columnArr[$i]);?> </th> 
                        <?php 
                        }
                        else{
                    ?>


                             <th class="center aligned"> <?php echo strtoupper($columnArr[$i]);?></th>


                        <?php } 
                    }
                    ?>
                </tr>

                <?php  
                    $max = $con->query("SELECT * FROM cat1 WHERE  `rollno` like 'Max Mark' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark)-1;$i++)
                        { ?>
                                  <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo $maxmark[$i]; ?>> <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
                         }?> 
       
                    </tr> 

                    <?php  
                    $max = $con->query("SELECT * FROM cat1 WHERE  `rollno` like 'Exp Mark' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark)-1;$i++)
                        { ?>
                    <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo $maxmark[$i]; ?>> <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
                         }?> 
       
                    </tr> 

                    <?php  
                    $max = $con->query("SELECT * FROM cat1 WHERE  `rollno` like 'Co' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark)-1;$i++)
                        {   
                            if($i==0)
                            {?>
                             <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo strtoupper($maxmark[$i]); ?>> <?php echo strtoupper($maxmark[$i]);?></th>
                            <?php
                             $i++;
                            }

                            ?>
                             <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo 'CO'.$maxmark[$i]; ?>> <?php  if(is_numeric($maxmark[$i])){echo 'CO'.$maxmark[$i];}?></th>
                    
                        <?php
                         }?> 
       
                    </tr> 


             </thead>
            <tbody> 
             
             <?php

            while($row1 = $data->fetch_assoc()){
                if($row1[$columnArr[0]]=='Max Mark' || $row1[$columnArr[0]]=='Exp Mark' ||$row1[$columnArr[0]]=='Co')
                {}
                else{
                    ?> <tr class="item">
                    <?php
                    for($i=0;$i<count($columnArr);$i++)
                    { ?>
                    <td class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?>> <?php echo $row1[$columnArr[$i]]; ?></td>
                
                    <?php
                    }?> 
                    
                    </tr> 
                    
                    <?php
                    }
                }
             ?>
            
            </tbody>
        </table>
     </div>

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="../js/Table.js"></script>

</body>
</html>
