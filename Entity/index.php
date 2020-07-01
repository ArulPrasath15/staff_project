<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}

$count=0;
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='CAT_1_2020' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

    $sql="SELECT * from CAT_1_2020 ORDER BY `rollno` ASC ";
    $data=$con->query($sql);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Mark</title>
  <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
  <link rel="stylesheet" href="../css/style.css" type="text/css"/> 
  <!-- <script src="semantic/dist/semantic.min.js"></script> -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
</head>
<body class="animate__animated animate__backInDown">
<!-- partial:index.partial.html -->
<div class="tablecontent">

        <table class="ui fixed selectable celled table" id="table-list">
            <thead>
                <tr  >
                    <?php
                    
                    for($i=0;$i<count($columnArr);$i++){ 
                    ?>
                    <th class="center aligned"> <?php echo strtoupper($columnArr[$i]);?></th>
                    <?php  
                    }
                    ?>
                </tr>

                <?php  
                    $max = $con->query("SELECT * FROM CAT_1_2020 WHERE  `rollno` like 'Max Mark' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark);$i++)
                        { ?>
                    <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo $maxmark[$i]; ?>> <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
                         }?> 
       
                      </tr> 
             </thead>
            <tbody> 
             
             <?php

            while($row1 = $data->fetch_assoc()){
                if($row1[$columnArr[0]]=='Max Mark')
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

   
<!-- partial -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="../Js/script.js"></script>

</body>
</html>
