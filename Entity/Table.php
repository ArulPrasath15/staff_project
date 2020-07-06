

<!-- THIS PAGE IS FOR MARK ENTRY TABLE -->
<?php
include_once("../db.php");
session_start();
$_table=$_SESSION['exam'];
// echo $_table;
$_staffid= $_SESSION['staffid'];
$_code=$_SESSION['ccode'];

$sql="SELECT * FROM `course_list` WHERE  `code`  LIKE  '$_code' ";
if($con->query($sql)==false)
{
    header("Location: ../staff/index.php");

}
$data=$con->query($sql);
$rows=$data->fetch_assoc();
$class;
   
if($rows['staff1']==$_staffid)
{
    $class='A';
}
elseif($rows['staff2']==$_staffid)
    {
        $class='B';
    }
    elseif($rows['staff3']==$_staffid)
    {
        $class='C';
    }
    elseif($rows['staff4']==$_staffid)
    {
        $class='D';
    }
    else
    {
        
        header("Location: ../staff/index.php");
    }




$range=array();
$count=0;
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='cat_1_2020' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

    $sql="SELECT * from cat_1_2020 WHERE `rollno` like '%18CSR%' ORDER BY `rollno` ASC ";
    $data=$con->query($sql);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Mark</title>
  <link rel="icon" type="image/png" href="../images/logo.png">
  <link rel="stylesheet" href="../assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
  <link rel="stylesheet" href="../css/Table.css" type="text/css"/> 
  <!--- <script src="semantic/dist/semantic.min.js"></script> -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />

  <!-- <link
    rel="stylesheet"
    href="  https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.10.21/css/dataTables.semanticui.min.css"
  /> -->
  
  
</head>
<style>
span
{
    color:white;
    font-size:15px;


}

</style>
<!-- <body class="animate__animated animate__backInDown"> -->
<script>
   
// function exportF(elem) {
//     console.log("erfe");
//   var table = document.getElementById("#table-list");
//   var html = table.outerHTML;
//   var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
//   elem.setAttribute("href", url);
//   elem.setAttribute("download", "export.xls"); // Choose the file name
//   return false;
// }


</script>
<body>

<!-- navbar -->
<div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="../staff/index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="item"  style="margin-left:900px;"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->

<br><br>
<center>

  <div class="ui two column stackable center aligned grid">
    
    <div class="middle aligned row">
      <div class="column">

             <table  style="width:600px;margin-left:80px;" class="ui celled fixed selectable table">
                     <tbody>
                        <tr>
                            <td class="center aligned">Course Code</td>
                            <td class="center aligned"><?php  echo $rows['code'].' - '.substr($_table,0,4);  ?></td>
                     
                        </tr>
                        <tr>
                             <td class="center aligned">Course Name</td>
                            <td class="center aligned"><?php  echo $rows['name'];   ?></td>
                        </tr> 
                        <tr>
                             <td class="center aligned">Section</td>
                            <td class="center aligned"><?php  echo $class;   ?></td>
                        </tr>
                       
                        </tbody>
                     </table>


                 </div>
                  <div class="column">
                    <table style="width:600px;margin-left:50px;" class="ui celled fixed selectable  table">
                        <tbody>
                        <tr>
                             <td class="center aligned">Semester</td>
                            <td class="center aligned"><?php  echo $rows['sem'];   ?></td>
                        </tr>
                         <tr>
                             <td class="center aligned">Batch</td>
                            <td class="center aligned"><?php  echo $rows['batch'];   ?></td>
                        </tr>
                        <tr>
                             <td class="center aligned">Credit</td>
                            <td class="center aligned"><?php  echo $rows['credit'];   ?></td>
                        </tr>
                        



                </tbody>
            </table>
        </div>
    </div>
  </div>



</center>
<br>


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
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Max Mark' ");
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
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Exp Mark' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark)-1;$i++)
                        { ?>
                    <th class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?> value=<?php echo $maxmark[$i]; ?>> <?php echo $maxmark[$i]; ?></th>
                    
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
    

             <tfoot >


             <tr>
`
                    <?php  
                        $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Up2ExpLvl' ");
                        $maxmark = $max->fetch_row(); ?>
                    <tr  class="maxmarkrow">
                            <?php
                            for($i=0;$i<count($maxmark);$i++)
                            { if($i==0)
                                {?>
                                    <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>No of students scores upto expected level </para></th>
                                    
                               <?php }else{   


                                ?>
                                    <th style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[$i]; ?></th>
                        
                            <?php
                   } }?>
                    <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>
                    </tr>

                    <tr>

                    <?php  
                        $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Up2ExLvl%' ");
                        $maxmark = $max->fetch_row(); ?>
                    <tr  class="maxmarkrow">
                            <?php
                            for($i=0;$i<count($maxmark)-1;$i++)
                            { if($i==0)
                                {?>
                                    <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>% of scoring above the attainment level, Total appeared for Test</para></th>
                                    
                               <?php }else{   


                                ?>
                                    <th style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo number_format($maxmark[$i],2); ?></th>
                        
                            <?php
                   } }?>

                    <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>
                    <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>

                    </tr>




                <tr >    
                <th style="background-color:grey;color:black;font-size:15px;"></th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;" colspan="2"><pre>5 </pre> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;" colspan="3"><center>4</center> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;" colspan="2"><pre>3</pre> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"colspan="3"><pre>2</pre> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"colspan="3"><pre>1</pre> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>  




                </tr>
                <?php
                     
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'range' ");
                    $maxmark = $max->fetch_row();


                ?>
                <tr >    
                <th style="background-color:grey;color:black;font-size:15px;"><para>Range of attainment</para></th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><pre>></pre> </th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><?php echo $maxmark[4]  ?> </th>
                <th style="background-color:#dfedf7;color:black;font-size:20px;">-</th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><?php echo $maxmark[3]  ?></th> 
                <th style="background-color:#dfedf7;color:black;font-size:20px;">-</th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><?php echo $maxmark[2]  ?></th> 
                <th style="background-color:#dfedf7;color:black;font-size:20px;">-</th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><?php echo $maxmark[1]  ?></th>  
                <th style="background-color:#dfedf7;color:black;font-size:15px;"><</th>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th> 
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>

 
                </tr>
                

                

                <tr>

                <?php  
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'ExpAtt' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark);$i++)
                        { if($i==0)
                            {?>
                                <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Expected attainment for each question</para></th>
                                
                           <?php }else{   


                            ?>
                                <th style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
               } }?>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>
                </tr>

                <tr>

                <?php  
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'SatAtt' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark);$i++)
                        { if($i==0)
                            {?>
                                <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Satisfaction attainment level based on level indicator</para></th>
                                
                           <?php }else{   


                            ?>
                                <th style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
               } }?>
                <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>
                </tr>

                <tr>

                <?php  
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Co' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark);$i++)
                        {   
                            if($i==0)
                            {?>
                             <th  style="background-color:grey;color:black;font-size:15px;" class="center aligned" ><para>Mapping with CO </para></th>
                            <?php
                             $i++;
                            }

                            ?>
                             <th  style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php  if(is_numeric($maxmark[$i])){echo 'CO'.$maxmark[$i];}?></th>
                    
                        <?php
                        }?>  
                        <th style="background-color:#dfedf7;color:black;font-size:15px;"></th>
                </tr>

                <tr>

                <?php  
                    $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'AttLvlCo' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        <?php
                        for($i=0;$i<count($maxmark);$i++)
                        { if($i==0)
                            {?>
                                <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Attainment level of Each CO</para></th>
                                
                           <?php }else{   


                            ?>
                                <th style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[$i]; ?></th>
                    
                        <?php
               } }?>
                <th style="background-color:#dfedf7;color:black;font-size:16px;"></th>
                </tr> 


                <tr>
                
                <?php
                $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Attco' ");
                $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                <th style="background-color:grey;color:black;font-size:16px;"><para>Attainment level  of All CO  </para></th>
                        <?php
                        $j=0;
                        for($i=1;$i<count($maxmark);$i++)
                        { if($maxmark[$i]==0)
                            {?>
                                <!-- <th style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Attainment level of Each CO</para></th> -->
                                
                           <?php }else
                           {   $j++;
                            ?>
                                
                                <th style="background-color:#dfedf7;color:black;font-size:15px;" colspan="2" class="center aligned" > <?php echo "CO".$i.' = '.$maxmark[$i]; ?></th>
                    
                        <?php
               } }
               
                $t =count($columnArr)-$j*2;
            //    echo $t;
               for($i=0;$i<$t;$i++)
               {    ?>
                <th style="background-color:#dfedf7;color:black;font-size:16px;"></th>

                <?php
               }
               
                 ?>

             </tr>

             </tfoot>
        </table>
        <center><form class="ui form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" ><button class="ui small positive  button" type="submit" id="b1" name="submit" style="border-radius:5px;"><h2>Submit</h2></button></form></center>
        <button id="downloadLink" onclick="exportF(this);">Export to excel</button>
        <?php

        if(isset($_POST["submit"]))
        {
           
            $exp = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Exp Mark' ");
            $expmark = $exp->fetch_row();
            $max = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Max Mark' ");
            $maxmark = $max->fetch_row();
            $max1 = $con->query("SELECT * FROM cat_1_2020 WHERE  `rollno` like 'Co' ");
            $comark = $max1->fetch_row();
            $exp_tot=0;
            $max_tot=0;
            $exp_att=0; 
            $sql ="SELECT * FROM cat_1_2020 WHERE  `rollno` like '%18CSR%' ";
            $data1=$con->query($sql);
            $got=array();
            $tot_num=array();
            $exp_att_arr=array(); 
            $sat_att_arr=array(); 
            $Up2ExpLvl=array();
            $AttLvlCo=array();
            $Co=array();
            $Co_count=array();
            array_push($Co,0,0,0,0,0);
            array_push($Co_count,0,0,0,0,0);
            for($i=1;$i<count($columnArr)-1;$i++)
            {
            $exp_tot+=$expmark[$i];
            $max_tot+=$maxmark[$i];
            array_push($exp_att_arr,(int)(($expmark[$i]/$maxmark[$i])*100));
            array_push($sat_att_arr,0);   
            array_push($got,0);
            array_push($tot_num,0);
            array_push($Up2ExpLvl,0);
            array_push($AttLvlCo,0);
            }
            while($row1 = $data1->fetch_assoc()){
            for($i=1;$i<count($columnArr)-1;$i++)
            {
                if($row1[$columnArr[$i]]!=NULL){
                $tot_num[$i-1]++;
                if($row1[$columnArr[$i]]>=$expmark[$i])
                {
                $got[$i-1]++;
                }}
            }
            }
            $exp_att=(int)(($exp_tot/$max_tot)*100);
            //  $range=array();
            //array_push($range,$exp_att);
            $temp=(int)(($exp_att-50)/3);
            array_push($range,50,50+$temp,$exp_att-$temp,$exp_att);
            //  $range[0]=50;
            //  $range[1]=50+$temp;
            //  $range[2]=$exp_att-$temp;
            //  $range[3]=$exp_att;
            $temp_rem=($exp_att-50)-($temp*3);
            if($temp_rem==2)
            {
            $range[1]+=1;
            $range[3]-=1;
            }
            else if($temp_rem==1)
            {
            $range[1]+=1;
            }
            for($i=1;$i<count($columnArr)-1;$i++)
            {
            $Up2ExpLvl[$i-1]=(($got[$i-1]/$tot_num[$i-1])*100);
            if($exp_att_arr[$i-1]<=$range[0])
            {
                $sat_att_arr[$i-1]=1;
            }
            else if($exp_att_arr[$i-1]>$range[0] && $exp_att_arr[$i-1]<=$range[1])
            {
                $sat_att_arr[$i-1]=2;
            }
            else if($exp_att_arr[$i-1]>$range[1] && $exp_att_arr[$i-1]<=$range[2])
            {
                $sat_att_arr[$i-1]=3;
            }
            else if($exp_att_arr[$i-1]>$range[2] && $exp_att_arr[$i-1]<=$range[3])
            {
                $sat_att_arr[$i-1]=4;
            }
            else
            {
                $sat_att_arr[$i-1]=5;
            }
            }
            for($i=1;$i<count($columnArr)-1;$i++)
            {
            if($Up2ExpLvl[$i-1]<=$range[0])
            {
                $AttLvlCo[$i-1]=1;
            }
            else if($Up2ExpLvl[$i-1]>$range[0] && $Up2ExpLvl[$i-1]<=$range[1])
            {
                $AttLvlCo[$i-1]=2;
            }
            else if($Up2ExpLvl[$i-1]>$range[1] && $Up2ExpLvl[$i-1]<=$range[2])
            {
                $AttLvlCo[$i-1]=3;
            }
            else if($Up2ExpLvl[$i-1]>$range[2] && $Up2ExpLvl[$i-1]<=$range[3])
            {
                $AttLvlCo[$i-1]=4;
            }
            else
            {
                $AttLvlCo[$i-1]=5;
            }
            }
            for($i=1;$i<count($columnArr)-1;$i++)
            {
            for($j=1;$j<=5;$j++)
            {
                if($comark[$i]==$j)
                {
                $Co[$j-1]+=$AttLvlCo[$i-1];
                $Co_count[$j-1]+=1;
                }
            }
            }
            for($i=0;$i<5;$i++)
            {
            if($Co_count[$i]!=0)
            {
                $Co[$i]=(float)($Co[$i]/$Co_count[$i]);
            }
            }
            //    print_r($Co);
            //    print_r($range);
            //    print_r($AttLvlCo);
            $sql2="UPDATE cat_1_2020 SET ";
            $sql3="UPDATE cat_1_2020 SET ";
            $sql4="UPDATE cat_1_2020 SET ";
            $sql5="UPDATE cat_1_2020 SET ";
            $sql6="UPDATE cat_1_2020 SET ";
            for($i=1;$i<count($columnArr)-1;$i++)
            {
            $sql2.=strval($columnArr[$i])."=".$got[$i-1];
            $sql3.=strval($columnArr[$i])."=".$Up2ExpLvl[$i-1];
            $sql4.=strval($columnArr[$i])."=".$exp_att_arr[$i-1];
            $sql5.=strval($columnArr[$i])."=".$sat_att_arr[$i-1];
            $sql6.=strval($columnArr[$i])."=".$AttLvlCo[$i-1];
            if($i!=count($columnArr)-2)
            {
                $sql2.=",";
                $sql3.=",";
                $sql4.=",";
                $sql5.=",";
                $sql6.=",";
            }
            else
            {
                $sql2.=" ";
                $sql3.=" ";
                $sql4.=" ";
                $sql5.=" ";
                $sql6.=" ";
            }
            }
            $sql2.= "WHERE rollno like 'Up2ExpLvl'";
            $con->query($sql2);
            $sql3.= "WHERE rollno like 'Up2ExLvl%'";
            $con->query($sql3);
            $sql4.= "WHERE rollno like 'ExpAtt'";
            $con->query($sql4);
            $sql5.= "WHERE rollno like 'SatAtt'";
            $con->query($sql5);
            $sql6.= "WHERE rollno like 'AttLvlCo'";
            $con->query($sql6);


            $sql7="UPDATE cat_1_2020 set `Q1` = ".$range[0]." , `Q2`= ".$range[1]." , `Q3`=  ".$range[2].", `Q4`= ".$range[3]." WHERE `rollno` LIKE 'range'";
            $con->query($sql7);

            $sql8="UPDATE cat_1_2020 set `Q1` = ".$Co[0]." , `Q2`= ".$Co[1]." , `Q3`=  ".$Co[2].", `Q4`= ".$Co[3].",`Q5`= ".$Co[4]." WHERE `rollno` LIKE 'Attco'";
            $con->query($sql8);
                      
           

    }

     ?>
       </div>


   
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script scr="https://cdn.datatables.net/1.10.21/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script> -->

<script  src="../js/Table.js"></script>



</body>
</html>
