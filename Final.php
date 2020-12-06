<?php

include_once("./db.php");
include_once('./assets/notiflix.php'); 
session_start();
if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}

//$_table=$_SESSION['exam'];
$_staffid= $_SESSION['staffid'];
$_code=$_GET['code'];




$sql="SELECT * FROM `course_list` WHERE  `code`  LIKE  '$_code' ";
if($con->query($sql)==false)
{
    header("Location: ./staff/index.php");

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
        
        header("Location: ./staff/index.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CO PO MAPPING</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
     <link rel="stylesheet" href="./assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
      <script src="./assets/jquery.min.js"></script>
      <script src="./assets/Fomantic/dist/semantic.min.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
</head>
<style>
    body
    {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background:url("./Images/bg.jpg") ;
        background-size: cover;
    }


    
    .topic
    {
        font-family:"Times New Roman", Times, serif;
        color:black;
        padding:50px;
    }
    .card
    {
        position:relative;
        top:50%;
        left: 50%;
        transform:translate(-650px,50px);
        width:1300px;
        background:white;
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.5);
        border-radius: 10px;
        padding:3%;
    }
    table
    {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th 
    {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 18px;
    }
    .darkness,.darkness2{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .6);
    transition: .5s ease;
    z-index: -1;
    opacity: 0;
}

.darkness.active,.darkness2.active{
    opacity: 1;
    z-index: 2;
}

.model,.model2{
    position: fixed;
    top: 50%;
    left: 50%;
    max-width: 450px;
    padding: 30px;
    color: #4A5666;
    background-color: #F8F8F8;
    visibility: hidden;
    opacity: 0;
    transition: .5s ease;
    transform: translate(-50%, -50%);
}

.model.active,.model2.active{
    visibility: visible;
    opacity: 1;
    z-index: 3;
}
textarea.text1{
  resize: none;
  height:100px;
  width:300px
}
textarea.text2{
  resize: none;
  height:100px;
  width:300px
}
</style>
<body>
<div id="fun">
<!-- Navbar start -->
    <!-- <div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div> -->
    <div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
        <a href="./index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a  class="right align item"  style="margin-left:1220px"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      </div>
    </div>
<!-- Navbar ended -->
    <div class="card">
    <Button onclick="Export2Doc('fun','CO-PO Mapping');" variant="contained" color="primary" class="right align item"  style="margin-left:1100px;color:black;"   style="font-size:20px">Export2Doc</Button>
    <div class="topic">
        <h1 style="font-size:40px"><center>CO-PO MAPPING</center></h1>
    </div>
    <?php
        $tb1 = $con->query("SELECT * FROM `CAT1_".$rows['code']."_".$rows['batch']."`");
        if($tb1==true){
        $tb11 = $con->query("SELECT * FROM `CAT1_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb11->fetch_row();
        if(gettype($res[2])!= 'NULL'){
        $cat1_co=[];
        array_push($cat1_co,$res[2],$res[3],$res[4],$res[5],$res[6]);
        }else{
            $cat1_co=[0,0,0,0,0];
        }}else{
            $cat1_co=[0,0,0,0,0];
        }
        $tb2 = $con->query("SELECT * FROM `CAT2_".$rows['code']."_".$rows['batch']."`");
        if($tb2==true){
        $tb21 = $con->query("SELECT * FROM `CAT2_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb21->fetch_row();
        if(gettype($res[2])!= 'NULL'){
        $cat2_co=[];
        array_push($cat2_co,$res[2],$res[3],$res[4],$res[5],$res[6]);
        }else{
            $cat2_co=[0,0,0,0,0];
        }}else{
            $cat2_co=[0,0,0,0,0];
        }
        $tb3 = $con->query("SELECT * FROM `CAT3_".$rows['code']."_".$rows['batch']."`");
        if($tb3==true){
        $tb31 = $con->query("SELECT * FROM `CAT3_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb31->fetch_row();
        if(gettype($res[2])!= 'NULL'){
        $cat3_co=[];
        array_push($cat3_co,$res[2],$res[3],$res[4],$res[5],$res[6]);
        }else{
            $cat3_co=[0,0,0,0,0];
        }}else{
            $cat3_co=[0,0,0,0,0];
        }
        $tb4 = $con->query("SELECT * FROM `Assignment_".$rows['code']."_".$rows['batch']."`");
        if($tb4==true){
        $tb41 = $con->query("SELECT * FROM `Assignment_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb41->fetch_row();
        if(gettype($res[2])!= 'NULL'){
        $assignment_co=$res[2];
        }else{
            $assignment_co=0;
        }}else{
            $assignment_co=0;
        }    
        $tb5 = $con->query("SELECT * FROM `OtherAssesment_".$rows['code']."_".$rows['batch']."`");
        if($tb5==true){
        $tb51 = $con->query("SELECT * FROM `OtherAssesment_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb51->fetch_row();
        if(gettype($res[2])!= 'NULL'){
        $otherassesment_co=$res[2];
        }else{
            $otherassesment_co=0;
        }}else{
            $otherassesment_co=0;
        }    
        $tb55 = $con->query("SELECT * FROM `OtherAssesment_".$rows['code']."_".$rows['batch']."`");
        if($tb55==true){
        $tb551 = $con->query("SELECT * FROM `OtherAssesment_".$rows['code']."_".$rows['batch']."` WHERE  `rollno` like 'CO' ");
        $res = $tb551->fetch_row();
        if(gettype($res[2])!= 'NULL'){
            $otherassesment_co_map=strval($res[2]);
        }else{
            $otherassesment_co_map="";
        }}else{
            $otherassesment_co_map="";
        }
        $tb6 = $con->query("SELECT * FROM `SEM_".$rows['code']."_".$rows['batch']."`");
        if($tb6==true){
        $tb61 = $con->query("SELECT * FROM `SEM_".$rows['code']."_".$rows['batch']."` where `rollno` like  'Attco".$class."'");
        $res = $tb61->fetch_row();
        if(gettype($res[3])!= 'NULL'){
        $sem_co=$res[3];
        }else{
            $sem_co=0;
        }}else{
            $sem_co=0;
        }

        $sql = $con->query("SELECT * FROM `copo` WHERE  `code` like '".$rows['code']."' ");
        $po_res = $sql->fetch_assoc();
        $poco=[];
        $poco[0]=explode(":",$po_res['co1']);$poco[1]=explode(":",$po_res['co2']);$poco[2]=explode(":",$po_res['co3']);$poco[3]=explode(":",$po_res['co4']);$poco[4]=explode(":",$po_res['co5']);
        $po_tar=[];$pso_tar=[];
        for($i=0;$i<12;$i++)
        {
            $po_tar[$i]=$po_res['po'.($i+1)];
        }
        $pso_tar[0]=$po_res['pso1'];$pso_tar[1]=$po_res['pso2'];
    ?>
    <table>
    <h2>&nbsp;ATTAINMENT OF COURSE OUTCOMES(COs)</h2>
    <h2>&nbsp;Attainment through Cumulative Internal Examinations(CIE)</h2>
    <br>
    <tr>
        <td rowspan="2" style="background: #dddddd">COs</td>
        <th colspan="5">Assessment Methods</th>
        <th rowspan="2">Attainment<br>level of CO</th>
        <th rowspan="2">Mapped<br>PO</th>
        <th rowspan="2">Mapped<br>PSO's</th>
    </tr>
    <tr>
        <th>CA<br>Test-I</th>
        <th>CA<br>Test-II</th>
        <th>CA<br>Test-III</th>
        <th>Assignment</th>
        <th>Other<br>Assessments</th>
    </tr>
    
    <?php
        $co_avg=[];
        for($i=0;$i<5;$i++){
        $count=0;
        $val=0;
    ?>
        <tr>
        <td style="background: #dddddd">CO<?php echo ($i+1);?></td>
        <?php
            if($cat1_co[$i]!=0)
            {
                $count++;
                $val+=$cat1_co[$i];
        ?>
        <td><?php echo number_format($cat1_co[$i],2);?></td>
        <?php                
            }else{
        ?>
        <td> </td>
        <?php
            }
        ?>
        <?php
            if($cat2_co[$i]!=0)
            {
                $count++;
                $val+=$cat2_co[$i];
        ?>
        <td><?php echo number_format($cat2_co[$i],2);?></td>
        <?php                
            }else{
        ?>
        <td> </td>
        <?php
            }
        ?>
        <?php
            if($cat3_co[$i]!=0)
            {
                $count++;
                $val+=$cat3_co[$i];
        ?>
        <td><?php echo number_format($cat3_co[$i],2);?></td>
        <?php                
            }else{
        ?>
        <td> </td>
        <?php
            }
        ?>
        <td><?php echo $assignment_co;?></td>
        <?php
            $count++;
            $val+=$assignment_co;
            $str=strval($i+1);
            if(strpos($otherassesment_co_map,$str)!==false)
            {
                $count++;
                $val+=$otherassesment_co;
        ?>
        <td><?php echo $otherassesment_co;?></td>
        <?php                
            }else{
        ?>
        <td> </td>
        <?php
            }
            $co_avg[$i]=number_format(($val/$count),2);
        ?>
        <td><?php echo $co_avg[$i];?></td>
        <td><?php echo $poco[$i][0]; ?></td>
        <td><?php echo $poco[$i][1]; ?></td>
        </tr>
    <?php } ?>
    <!-- <tr>
        <td style="background: #dddddd">CO2</td>
        <td>2.71</td>
        <td>2</td>
        <td> </td>
        <td>4</td>
        <td> </td>
        <td>2.9</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO3</td>
        <td> </td>
        <td>2</td>
        <td>3.8</td>
        <td>4</td>
        <td>5</td>
        <td>3.7</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO4</td>
        <td> </td>
        <td> </td>
        <td>1</td>
        <td>4</td>
        <td> </td>
        <td>2.5</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO5</td>
        <td> </td>
        <td> </td>
        <td>1.8 </td>
        <td>4</td>
        <td> </td>
        <td>2.9</td>
        <td>PO=1</td>
        <td>PSO=1</td>
    </tr> -->
    </table>
    <br>
    <table>
    <h2>&nbsp;Attainment through Semester End Examination(SEE)<h2>
    <tr>
        <td style="background: #dddddd">COs</td>
        <th>Attainment level of<br>CO</th>
        <th>Mapped COs</th>
        <th>Mapped PSOs</th>
    </tr>
    <?php
        for($i=0;$i<5;$i++){
    ?>
        <tr>
        <td style="background: #dddddd">CO<?php echo ($i+1);?></td>
        <td><?php echo $sem_co;?></td>
        <td><?php echo $poco[$i][0]; ?></td>
        <td><?php echo $poco[$i][1]; ?></td>
        </tr>
    <?php } ?>
    <!-- <tr>
        <td style="background: #dddddd">CO1</td>
        <td>5</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO2</td>
        <td>5</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO3</td>
        <td>5</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO4</td>
        <td>5</td>
        <td>PO=1,2,3</td>
        <td>PSO=1,2</td>
    </tr>
    <tr>
        <td style="background: #dddddd">CO5</td>
        <td>5</td>
        <td>PO=1,2</td>
        <td>PSO=1</td>
    </tr> -->
    </table>
    <table>
    <br>
    <h2>&nbsp;ATTAINMENT OF PROGRAM OUTCOMES(Pos)</h2>
    <br>
    <tr>
        <th style="background: #dddddd">Pos</th>
        <th colspan="12">POs</th>
        <th colspan="2">PSOs</th>
    </tr>
    <tr>
        <th> </th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
        <th>6</th>
        <th>7</th>
        <th>8</th>
        <th>9</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>1</th>
        <th>2</th>
    </tr>
    <tr>
        <th style="background: #dddddd">Attainment<br>level of PO<br>from CIE</th>
        <!-- <td>3.18</td>
        <td>3.18</td>
        <td>3.25</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td> -->
        <?php
            $cie=[];
            for($i=0;$i<12;$i++)
            {
                $val=0;$count=0;
                for($j=0;$j<5;$j++)
                {
                    if(strpos($poco[$j][0],strval($i+1))!==false)
                    {
                        $val+=$co_avg[$j];
                        $count++;
                    }
                }
                if($val!=0)
                {
                    $cie[$i]=number_format(($val/$count),2);
                }
                else
                {
                    $cie[$i]=' ';
                }
        ?>
        <td><?php echo $cie[$i];?></td>
        <?php } ?>
        <?php
            $val=0;$count=0;$val1=0;$count1=0;
            for($j=0;$j<5;$j++)
            {
                if(strpos($poco[$j][1],'1')!==false)
                {
                    $val+=$co_avg[$j];
                    $count++;
                }
                if(strpos($poco[$j][1],'2')!==false)
                {
                    $val1+=$co_avg[$j];
                    $count1++;
                }
            }
            if($val!=0)
            {
                $cie[12]=number_format(($val/$count),2);
            }
            else
            {
                $cie[12]=' ';
            }
            if($val1!=0)
            {
                $cie[13]=number_format(($val1/$count1),2);
            }
            else
            {
                $cie[13]=' ';
            }
        ?>
        <td><?php echo $cie[12];?></td>
        <td><?php echo $cie[13];?></td>
        <!-- <td>3.18</td>
        <td>3.18</td> -->
    </tr>
    <tr>
        <th style="background: #dddddd">Attainment<br>level of PO<br>from SEE</th>
        <!-- <td>5</td>
        <td>5</td>
        <td>5</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>5</td>
        <td>5</td> -->
        <?php
            $see=[];
            for($i=0;$i<12;$i++)
            {
                if($po_tar[$i]!=0)
                {
                    $see[$i]=$sem_co;
                }
                else
                {
                    $see[$i]=' ';
                }
        ?>
        <td><?php echo $see[$i];?></td>
        <?php } ?>
        <?php 
            if($pso_tar[0]!=0)
            {
                $see[12]=$sem_co;
            }
            else
            {
                $see[12]=' ';
            }
            if($pso_tar[1]!=0)
            {
                $see[13]=$sem_co;
            }
            else
            {
                $see[13]=' ';
            }
        ?>
        <td><?php echo $see[12];?></td>
        <td><?php echo $see[13];?></td>
        
    </tr>
    <tr>
        <th style="background: #dddddd">Attainment<br>level of PO<br>(50% of CIE<br>50% of SEE)</th>
        <!-- <td>4.1</td>
        <td>4.1</td>
        <td>4.13</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>4.1</td>
        <td>4.1</td> -->
        <?php
            $att_lvl_po=[];
            for($i=0;$i<14;$i++)
            {
                if($cie[$i]!=' ')
                {
                    $att_lvl_po[$i]=number_format((($cie[$i]+$see[$i])/2),2);
                }
                else
                {
                    $att_lvl_po[$i]=' ';
                }
        ?>
        <td><?php echo $att_lvl_po[$i];?></td> 
        <?php } ?>
    </tr>
    </table>
    <br>
    <table>
    <h2>&nbsp;COURSE ASSESMENT REPORT<h2>
    <tr>
        <th style="background: #dddddd" colspan="5">POs attainment remarks</th>
    </tr>
    <tr>
        <th>POs</th>
        <th>Target Level</th>
        <th>Attainment Level</th>
        <th>Observations</th>
        <th></th>
    </tr>
    <?php
        $obsspan=0;
        $att_po=[0,0,0,0,0,0,0,0,0,0,0,0];
        for($i=0;$i<12;$i++)
        {
            if($po_tar[$i]!=0)
            {
                $obsspan=$obsspan+1;
            }
        }
        for($i=0;$i<12;$i++)
        {
            $obs=" ";
            if($po_tar[$i]!=0)
            {
                $att_po[$i]=number_format(((($att_lvl_po[$i])/5)*$po_tar[$i]),2);
                if(round($att_po[$i],2) >= round($po_tar[$i],2) )
                {
                    $obs="Target was attained";
                }
                else{
                    $obs="Target was not attained";
                }
                if( $po_res['obs'] != null)
                {
                    $obs=$po_res['obs'];
                }

            
    ?>
        <tr>
        <td><?php echo 'PO '.($i+1);?></td>
        <td><?php echo $po_tar[$i]; ?></td>
        <td><?php echo $att_po[$i]; ?></td>
        <?php
        if($i==0)
        {?> 
        
            <td rowspan=<?php echo $obsspan; ?>><?php echo $obs; ?></td>
            <td rowspan=<?php echo $obsspan; ?>><button class="ui positive  button"  id='btn1'>Edit</button></td>
        
        <?php
        }
        
        ?>
        
        </tr>
    <?php } } ?>
    <tr>
        <th style="background: #dddddd" colspan="4">PSOs attainment remarks</th>
    </tr>
    <tr>
        <th>PSOs</th>
        <th>Target Level</th>
        <th>Attainment Level</th>
        <th>Observations</th>
        <th></th>
    </tr>
    <?php
        $att_pso=[0,0];
        if($pso_tar[0]!=0)
        {
            $obs=" ";
            $att_pso[0]=number_format(((($att_lvl_po[12])/5)*$pso_tar[0]),2);
            if(round($att_pso[0],2) >= round($pso_tar[0],2))
            {
                $obs="Target was attained";
            }
            else{
                
                $obs="Target was not attained";
            }
            if( $po_res['obs1'] != null)
                {
                    $obs=$po_res['obs1'];
                }
    ?>
        <tr>
        <td><?php echo 'PSO 1';?></td>
        <td><?php echo $pso_tar[0]; ?></td>
        <td><?php echo $att_pso[0]; ?></td>
        <td rowspan='2'><?php echo $obs;?></td>
        <td rowspan='2'><button class="ui positive  button"  id='btn2'>Edit</button></td>
        </tr>
    <?php } ?>
    <?php
        if($pso_tar[1]!=0)
        {
            $obs=" ";
            $att_pso[1]=number_format(((($att_lvl_po[13])/5)*$pso_tar[1]),2);
            if(round($att_pso[1],2) >= round($pso_tar[1],2))
            {
                $obs="Target was attained";
            }
            else{
                $obs="Target was not attained";
            }
    ?>
        <tr>
        <td><?php echo 'PSO 2';?></td>
        <td><?php echo $pso_tar[1]; ?></td>
        <td><?php echo $att_pso[1]; ?></td>
        
        </tr>
    <?php } ?>
    </table>
    </div>
    </div>
    <!-- Modal -->
<div class="darkness"></div>
<div class="model">
  <h2>Edit Observation</h2>
  <form id='f1'>
  <div class="field">
    <textarea class="text1" name="textarea1" required ></textarea>
    <input type="hidden"  name="code" value=<?php echo $_code;?>

  </div><br><br>
  <button class="ui primary green button" id='update1' value='Submit'>Update</button>
  <div class="ui primary red button" id='close1' value='close'>Close</div>

  </form>
</div></div><br><br><br><br>
<!-- -------- -->
  <!-- Modal -->
  <div class="darkness2"></div>
<div class="model2">
  <h2>Edit Observation 2</h2>
  <form id='f2'>
  <div class="field">
    <textarea class="text1" name="textarea2" required ></textarea>
    <input type="hidden"  name="code" value=<?php echo $_code;?>

  </div><br><br>
  <button class="ui primary green button" id='update2' value='Submit'>Update</button>
  <div class="ui primary red button" id='close2' value='close'>Close</div>

  </form>
</div></div>
<!-- -------- -->
    <script>

    
$( document ).ready(function() {
    var coursecode='<?php echo $_code ;?>';

        $('#btn1').on('click',function(){
            $('.darkness, .model').addClass('active');
        });

        $('#close1').on('click',function(){
            $('.darkness, .model').removeClass('active');
        });

        $('#btn2').on('click',function(){
            console.log('2');
            $('.darkness2, .model2').addClass('active');
        });

        $('#close2').on('click',function(){
            $('.darkness2, .model2').removeClass('active');
        });



        $(function () {
        
        $('#f1').bind('submit', function () {
            var d1=$('#f1').serialize();
            console.log(d1);

          $.ajax({
            type: 'post',
            url: './Ajax/handler2.php',
            data: $('#f1').serialize(),
            success: function (d) {
              if(d=='True')
              {
                console.log('load');
                location.reload();

              }
            }
          });
          return false;
        });
      });
      
      $(function () {
        
        $('#f2').bind('submit', function () {
            var d2=$('#f2').serialize();
            // console.log(d2);

          $.ajax({
            type: 'post',
            url: './Ajax/handler2.php',
            data: $('#f2').serialize(),
            success: function (d) {
              if(d=='True')
              {
                console.log('load');
                location.reload();

              }
            }
          });
          return false;
        });
      });

});

        

    function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
    </script>
</body>
</html>
