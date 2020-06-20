<?php

$con=new mysqli("localhost","root","","staff");
if($con->connect_error)
{
    die('Connection Error');
}

$count=0;
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='student'";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

    $sql="SELECT * from student";
    $data=$con->query($sql);
    
    
                
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Mark</title>
  <link rel="stylesheet" href="./assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
  <link rel="stylesheet" href="./style.css" type="text/css"/> 
  <script src="semantic/dist/semantic.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="ui raised container segment">

        <table class="ui fixed celled table" id="table-list">
            <thead class="table-dark">
                <tr>
                    <?php
                    
                    for($i=0;$i<count($columnArr);$i++){ 
                    ?>
                    <th><?php echo strtoupper($columnArr[$i]);?></th>
                    <?php  
                    }
                    ?>
                    
                </tr>
            </thead>
            <tbody> 
             <?php   
                while($row1 = $data->fetch_assoc()){
                       ?> <tr class="item" >
                        <?php
                        for($i=0;$i<count($columnArr);$i++)
                        { ?>
                       <td class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?>> <?php echo $row1[$columnArr[$i]]; ?></td>
                    
                        <?php
                        }?> 
                       
                        </tr> 
                        
                        <?php
                    }
             ?>
            
            </tbody>
        </table>
        <div class="ui positive button">OK</div>
    </div>
<!-- partial -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="./script.js"></script>

</body>
</html>
