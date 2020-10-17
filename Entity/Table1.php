<!-- THIS PAGE IS FOR MARK ENTRY TABLE -->
<?php

include_once("../db.php");
// include_once("../assets/simplexlsx-master/src/SimpleXLSX.php");
include_once('../assets/notiflix.php'); 
session_start();
if(!isset($_SESSION["staffid"]))
{
  header("Location: ../index.php");
}

$_table=$_SESSION['exam'];
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
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='$_table' ";
$data=$con->query($sql);
while($row = $data->fetch_assoc()){
    $result[] = $row;
}
// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

    $sql="SELECT * from $_table WHERE `sec` like '$class' ORDER BY `rollno` ASC ";
    $data=$con->query($sql);


    if(isset($_POST['absbtn']))
    {

        $roll=strtoupper($_POST['rol']);
        $sqll="SELECT * from ".$_table." WHERE `rollno` LIKE '$roll' AND `sec` LIKE '$class' ";
        echo $sqll;
        $data=$con->query($sqll);
        $rowsA=$data->num_rows;
        echo $rowsA;
        if($rowsA!=0)
        {
            $sql= "DELETE FROM ".$_table." WHERE `rollno` LIKE '$roll' ";
            // echo $sql;
            if($con->query($sql))
            {
    
                   echo '<script>alert("fwfw")</script>'; 
                   header('Location: '.$_SERVER['REQUEST_URI']);
    
            }
            else
            {
               
                echo "<body><script> Notiflix.Notify.Success('Marked Absent Already');</script></body>";
    
            }


        }
        else
        {

            //  echo '<script> alert("Roll NO Not Belongs to this class.")</script>';
            header('Location: '.$_SERVER['REQUEST_URI']);
        }

        


    }
    if(isset($_POST['prebtn']))
    {
        
        $roll=strtoupper($_POST['rol']);
        $sql= "INSERT INTO  ".$_table." ( `rollno`,`sec`) VALUES ('$roll','$class') ";
        // echo $sql;
        if($con->query($sql))
        {

            //    echo "sucesss"; 
               header('Location: '.$_SERVER['REQUEST_URI']);

        }
        else{

            echo "<body><script> Notiflix.Notify.Success('Marked Present Already');</script></body>";

        }


    }

    if(isset($_POST['importsubmit']))
    {
        $sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='staff' AND `TABLE_NAME`='$_table' ";
        $data=$con->query($sql);
        while($row = $data->fetch_assoc()){
            $result1[] = $row;
        }
        // Array of all column names
        $columnArr1 = array_column($result1, 'COLUMN_NAME');

        // echo count($columnArr1)-1;
        // echo $_FILES['ifile']['tmp_name'];
        
        if ( $xlsx = SimpleXLSX::parse( $_FILES['ifile']['tmp_name'] ) )
        {
        list( $num_cols, $num_row) = $xlsx->dimension();
        // echo $num_cols."     ";
        $maxmark=array(); 
        $error=0;
        $success=0;
        $maxfailedroll=array(); 
        $sql1="SELECT * FROM `$_table` WHERE rollno LIKE 'Max Mark' ";
        $data1=$con->query($sql1);
        $res=$data1->fetch_assoc();
        for ( $i = 1; $i < count($columnArr1)-2; $i ++ )
        {
            $ques="Q".$i;
            $maxmark[$i]=$res[$ques];

        }
        // print_r($maxmark);     




            if( $num_cols==count($columnArr1)-1)
            {
                $j=0;
                foreach ( $xlsx->rows() as $k => $r ) {
                    
                    $marksarr=array();
                    $quesarr=array();
                    $sql="SELECT * FROM `$_table` WHERE rollno LIKE '$r[0]' ";
                    $res=$con->query($sql);
                    
                    if($res->num_rows!=0) 
                     {
                        $maxcheck=0;
                        
                        for ( $i = 1; $i < count($columnArr1)-2; $i ++ )
                        {

                            if($r[$i]<=$maxmark[$i])
                            {
                            }
                            else
                            {

                                $maxcheck++;
                                $maxfailedroll[$j]=$r[0];
                                $j++;
                             }



                        }
                        if($maxcheck==0)
                        {
                            for ( $i = 1; $i < count($columnArr1)-2; $i ++ ) {
                                $ques="Q".$i;
                                // echo $ques;
                                $quesarr[$i]=$ques;
                                // echo $r[$i];
                                if($r[$i]==strval(0))
                                {
                                    $marksarr[$i]=0;
                                }
                                else
                                {
                                    if(empty($r[$i]))
                                    {
                                    $marksarr[$i]='NULL';
                                    //  echo $ques;
                                    }
                                    else
                                    {
                                    $marksarr[$i]=$r[$i];
                                    }
                                    
                                }
    
                            }
    
                            $quesarr[count($columnArr1)-2]='TOTAL';
                            if($r[count($columnArr1)-2]==strval(0))
                            {
                                $marksarr[count($columnArr)-2]=0;
                                }
                                else
                                {
                                if(empty($r[count($columnArr1)-2]))
                                {
                                    $marksarr[count($columnArr)-2]='NULL';
                                //  echo $ques;
                                }
                                else
                                {
                                    $marksarr[count($columnArr)-2]=$r[count($columnArr1)-2];
                                }
                            
                             }
                            // print_r($quesarr);
                            // print_r($marksarr);
                            $sql1='UPDATE '.$_table.' SET ';
                            for($i=1;$i<=count($columnArr)-3;$i++)
                            {
    
                                $sql1.=$quesarr[$i] .'='. $marksarr[$i];
                                $sql1.=',';
    
                            }
    
                            $total=count($columnArr)-2;
                            $sql1.= 'Total'.'='.$marksarr[$total].' ';
    
                            $sql1.= 'WHERE rollno ='."'".$r[0]."'";
    
                            if ($con->query($sql1) === TRUE) {
                                if(count($maxfailedroll)==0)
                                {
                                    
                                }
                                else
                                {
                                    $error++;

                                }
    
                            } 
                            else
                            {
                                echo $sql1;
                            }
    



                        }
     
                  }
                     else 
                    {
                    // echo "EERRR";
                    }
                // echo $r[$i];

                }
            
            }
            else
            {

                echo "<body><script> Notiflix.Report.Failure('Invalid Excel Format','Please Check the Format','Okay',function(){ window.location.replace('./Table.php');});</script></body>";
                // for column count
            }


            if($error==0)
            {
                echo "<body><script> Notiflix.Report.Success('Imported Successfully ','Please Check the table','Okay',function(){ window.location.replace('./Table.php');});</script></body>";

            }
            else
            {
                $maxfailedroll=array_flip($maxfailedroll);
                $maxfailedroll=array_flip($maxfailedroll);
                $maxfailedroll=array_values($maxfailedroll);
                $string='';
                for($i=0;$i<count($maxfailedroll);$i++)
                {
                    $string.=strval($maxfailedroll[$i]);
                    $string.=' , ';

                }
                //  print_r($maxfailedroll);
                echo "<body><script> Notiflix.Report.Warning('Imported Sucessfully ','Please Check the below Rollno $string which their Marks Exceed the Maximum Mark.','Okay',function(){ window.location.replace('./Table.php');});</script></body>";

            }



        }
         else 
            {
              
                echo "<body><script> Notiflix.Report.Failure('Invalid Excel Format','Please Check the Format','Okay',function(){ window.location.replace('./Table.php');});</script></body>";
            }
       
    }














?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.semanticui.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.semanticui.min.css">
  <link rel="stylesheet" href="../css/Table.css" type="text/css"/> 

<script src = "https://code.jquery.com/jquery-1.12.4.js"></script>
<script src = "https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.10.16/js/dataTables.semanticui.min.js"></script>
<script src = "https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src = "https://cdn.datatables.net/buttons/1.5.1/js/buttons.semanticui.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src = "https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src = "https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src = "https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
</head>


<script>

// alert($('#table-list').columnCount());
$(document).ready(function() {

    document.onreadystatechange = function() { 
	if (document.readyState !== "complete") { 
		document.querySelector("body").style.visibility = "hidden"; 
		document.querySelector(".preloader").style.visibility = "visible"; 
	} else { 
		document.querySelector(".preloader").style.display = "none"; 
		document.querySelector("body").style.visibility = "visible"; 
	} 
}; 



    // file restrict
// var file = document.getElementById('inputfile');
// console.log(file);
// file.onchange = function(e) {
//   var ext = this.value.match(/\.([^\.]+)$/)[1];
//   switch (ext) {
//     case 'xlsx':
//        break;
//     default:
//       alert('Not allowed');
//       this.value = '';
//   }
// };

var colcount=$($('#table-list thead tr')[0]).find('th').length;
    col=[];
    var i=0;
    for(i=0;i<colcount-1;i++)
    {
      col[i]=i;
    }
    console.log(col)

   
    $('#table-list').DataTable( {
        dom: 'Bfrtip',
        "sort": false,
        "autoWidth": true,
        "searching": false,
        "paging": false,
        "info": false,
        buttons: [
            { extend: 'excelHtml5', 
                text:'Export as Excel',
                pageSize: 'LEGAL',
                exportOptions: {
                columns: col,
                messageTop: "staff name",
       
                               
                
            },
            },
            {
                    extend: 'pdfHtml5',
                    text:'Export as Pdf',
                    download: 'open',
                    pageSize: 'A4',
                    orientation:'portrait' ,
                    "paging":true,
                    "autowidth":true,
                    exportOptions: {
                        columns: col
                    },
                    title: 'CAT Mark Export',
                    messageTop: function(){
                            
                     return "Staff Name     :   " + "<?php  echo $_SESSION['staffname'] ?>"+"\n"+"Course Code  :   "+ "<?php  echo $rows['code'].' - '.substr($_table,0,4);    ?>"+"\n"+"Course Name :   "+"<?php echo $rows['name']   ?>"+"\n "+"Section            :   "+"<?php  echo $class ?>"+"\n"+"Semester        :   "+" <?php echo $rows['sem'] ?>"+"\n"+"Batch               :   "+"<?php echo $rows['batch']   ?>"+"\n";


                        
                    },
                    customize: function ( doc ) {
                // Splice the image in after the header, but before the table
                
                var cols = [];
                cols[0] = {text: '\u00A9Kongu Engineering College. '+'<?php echo $rows['code'].' - '.substr($_table,0,4).' - '.$class  ?>', alignment: 'left', margin:[20] };
                // cols[1] = {text: 'http://student.kongu.edu/', alignment: 'right', margin:[0,0,20] };
                var objFooter = {};
                objFooter['columns'] = cols;
                doc['footer']=objFooter;
            
                var now = new Date();
				var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                doc['header']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'right',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});
                
                doc.content.splice( 0, 0, {
                    margin: [ 0, 0, 0,12 ],
                    alignment: 'center',
                    image: 'data:image/png;base64,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',
                    fit: [70, 70],
                    
                } );
            }
                    
            },
        ]
    } );

    table.buttons().container().appendTo( $('div.eight.column:eq(0)', table.table().container()) );
   


} );

</script>


<style>

  span
  {
      color:white;
      font-size:15px;

  }
  .ui.table
  {
    
    table-layout: auto;
    width: 50%; 
  }
  .ui.table thead tr:first-child > th {
      position: sticky !important;
      top: 0;
      z-index: 2;
      
  }
  .ui.basic.buttons .button {
    background: #767676 none!important;
  }
 .dt-buttons.ui.basic.buttons{

    margin-left:32%;
    
  }



</style>


<body>
<div class="preloader"><body><div class="ui active dimmer" style="position: fixed;"><div class="ui massive active green elastic loader"></div></div></body></div>

<!-- navbar -->
<div class="ui tablet computer only padded grid">
      <div class="ui borderless fluid  inverted menu" style="font-size:16px">
      <a href="../staff/index.php" class="active green item" style="font-size:20px">KEC Student +</a>
        <a class="item" href=""><h4> <?php echo $_SESSION['staffname']; ?></h4></a>
        <a  class="right aligned item"  style="margin-left:900px;"   href="../Logout.php" style="font-size:20px"><i class="share square outline icon"></i>Logout</a>
      
      </div>
    </div>
<!-- navbar end -->

<!-- two cards -->
<br><br>
<center>

  <div class="ui two column stackable center aligned grid">
    
    <div class="middle aligned row">
      <div class="column">

             <table  style="width:600px;margin-left:80px;" class="ui celled selectable table">
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
<!-- end of two cards -->

<!-- pre/abs  -->
<br>
<form class="ui form"  action="<?php echo $_SERVER['PHP_SELF']; ?>"   method="POST">
<div class="abs">
<div class="ui action input">
  <input style="margin-left:80px;" size="20"type="text" name="rol" maxlength="8" placeholder="Enter Roll" required> 
  <button name="absbtn" class="ui negative button">Absent</button>
  <button  name="prebtn" class="ui green button">Present</button>
</div>
</div>
</form>







<!-- end of pre/abs  -->






<!-- <div class="ui grid"> -->
  <!-- <div id="buttons-menu" class="two wide column"></div> -->
  <div class="tablecontent" id="t1">
  <!-- <input type="file" id="inputfile"  name="ifile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" /> -->

<center>
    <table id="table-list" class="ui selectable celled table" >
    <thead>
                <tr>
                    <?php
                    
                    for($i=1;$i<count($columnArr);$i++){ 
                        if($i==count($columnArr))
                        {?>

                           
                            <th class="center aligned"><?php echo strtoupper($columnArr[$i]);?> </th> 
                        <?php 
                        }
                        else{
                    ?>


                             <th class="center aligned"> <?php echo strtoupper($columnArr[$i]);?></th>


                        <?php } 
                    }
                    ?>
                        
                </tr>

                
                
             </thead>
     
      <tbody> 
             
      <?php  
                    $max = $con->query("SELECT * FROM $_table WHERE  `rollno` like 'Max Mark' ");
                    $maxmark = $max->fetch_row();
                    
                    ?>
                      <tr  class="max">
                    <td class="center aligned"style="background-color:#d5f0dc;color:black;"  >Max Mark</td>
                    <td class="center aligned"  style="background-color:#d5f0dc;color:black;" id=<?php echo strtoupper($columnArr[0]);?> value=<?php echo $maxmark[2]; ?>> <?php echo $maxmark[2]; ?></td>
                    <td class="center aligned"style="background-color:#d5f0dc;color:black;;width:10px;"  ></td>
                        

                    </tr> 

                    <?php  
                    $max = $con->query("SELECT * FROM $_table WHERE  `rollno` like 'Exp Mark' ");
                    $maxmark = $max->fetch_row(); 
                    $expmarktotal=0;
                    ?>
                <tr  class="maxmarkrow">

                        <td class="center aligned"  style="background-color:#f9fae1;color:black;"  > Exp Mark</td>
                        <td class="center aligned"  style="background-color:#f9fae1;color:black;" id=<?php echo strtoupper($columnArr[0]);?> value=<?php echo $maxmark[2]; ?>> <?php echo $maxmark[2]; ?></td>
                        <td class="center aligned"  style="background-color:#f9fae1;color:black;"  ></td>

                        

                    </tr>        



             <?php

             while($row1 = $data->fetch_assoc()){
                
                    ?> <tr class="item">
                    <?php
                    for($i=1;$i<count($columnArr);$i++)
                    { ?>
                    <td class="center aligned" id=<?php echo strtoupper($columnArr[$i]);?>> <?php echo $row1[$columnArr[$i]]; ?></td>
                
                    <?php
                    }?> 
                    
                    </tr> 
                    
                    <?php
                    
             }
             ?>

   

                     <?php  
                        $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'Up2ExpLvl".$class."' ");
                        $maxmark = $max->fetch_row(); ?>
                    <tr  class="maxmarkrow">
                            
                                    <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>No of students scores upto expected level </para></td>
                                    
                               
                                    <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[0]; ?></td>
                        
                            
                    <td style="background-color:#dfedf7;color:black;font-size:15px;"></td>
                    </tr>

                   

                    <?php  
                        $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'Up2ExLvl%".$class."' ");
                        $maxmark = $max->fetch_row(); ?>
                    <tr  class="maxmarkrow">
                            
                                    <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>% of scoring above tde attainment level, Total appeared for Test</para></td>
                                    
                               
                                    <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo number_format($maxmark[0],2); ?></td>
                        
                            

                    <td style="background-color:#dfedf7;color:black;font-size:15px;"></td>

                    </tr>

                    <tr >    

                  <?php  $i=0;  ?> 
                <td style="background-color:grey;color:black;font-size:15px;"></td>
                <td style="background-color:#dfedf7;color:black;font-size:15px;" ><pre>  5 >       <   4    >    3   >     2  >    1  </pre></td>
                <td style="background-color:#dfedf7;color:black;font-size:15px;" ></td>

                


                
            </tr>

            <?php
                     
                     $max = $con->query("SELECT `mark` FROM  $_table  WHERE  `rollno` like 'range".$class."' ");
                     $maxmark = $max->fetch_row();
                     $max = $con->query("SELECT `mark` FROM  $_table  WHERE  `rollno` like 'range1".$class."' ");
                     $maxmark1 = $max->fetch_row();
 
 
                 ?>
                 <tr > <?php    ?> 
                 <td style="background-color:grey;color:black;font-size:15px;"><para>Range of attainment</para></td>
                 <td style="background-color:#dfedf7;color:black;font-size:15px;"><pre><?php echo "       ".substr($maxmark1[0],3,2)."         ".substr($maxmark1[0],0,2)."        ".substr($maxmark[0],3,2)."         ".substr($maxmark[0],0,2)  ?></pre> </td><?php $i++; ?>
                 <td style="background-color:#dfedf7;color:black;font-size:15px;"></th>
            
 
  
                 </tr>

                 <?php  
                    $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'ExpAtt".$class."' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        
                                <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Expected attainment for each question</para></td>
                                
                           
                                <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[0]; ?></td>
                    
                        
                <td style="background-color:#dfedf7;color:black;font-size:15px;"></td>
                </tr>

                <?php  
                    $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'SatAtt".$class."' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        
                                <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Satisfaction attainment level based on level indicator</para></td>
                                
                           
                                <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[0]; ?></td>
                    
                        
                <td style="background-color:#dfedf7;color:black;font-size:15px;"></td>
                </tr>

                <tr  class="maxmarkrow">
                        
                                <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Mapping with CO</para></td>
                                <?php
                                    if(substr(strval($_SESSION['exam']),0,5)=="other")
                                    {
                                        $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'CO' ");
                                        $maxmark = $max->fetch_row();   
                                        $co_v=$maxmark[0];
                                        $co_str="";
                                        for($i=0;$i<strlen($co_v);$i++)
                                        {
                                            $co_str.=" CO".$co_v[$i].",";
                                        }
                                        $co_str_f=substr($co_str,0,strlen($co_str)-1);
                                ?>
                           
                                <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $co_str_f; ?></td>

                                <?php }
                                      else{
                                ?>
                                <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo "CO1, CO2, CO3, CO4, CO5"; ?> </td>
                                <?php }?>
                    
                        
                <td style="background-color:#dfedf7;color:black;font-size:16px;"></td>
                </tr> 

                <?php  
                    $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'AttLvlCo".$class."' ");
                    $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                        
                                <td style="background-color:grey;color:black;font-size:15px;" class="center aligned" > <para>Attainment level of Each CO</para></td>
                                
                           
                                <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $maxmark[0]; ?></td>
                    
                        
                <td style="background-color:#dfedf7;color:black;font-size:16px;"></td>
                </tr> 


                <?php
                $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'Attco".$class."' ");
                $maxmark = $max->fetch_row(); ?>
                <tr  class="maxmarkrow">
                <td style="background-color:grey;color:black;font-size:16px;"><para>Attainment level  of All CO  </para></td>
                <?php
                    if(substr(strval($_SESSION['exam']),0,5)=="other")
                    {    
                     ?> 
                     <td style="background-color:#dfedf7;color:black;font-size:15px;" class="center aligned" > <?php echo $co_str_f." = ".$maxmark[0]; ?></td>

                <?php }
                      else{
                      ?>          
                    <td style="background-color:#dfedf7;color:black;font-size:15px;" colspan="0" class="center aligned" > <?php echo "CO1, CO2, CO3, CO4, CO5 = ".$maxmark[0]; ?></td>
                <?php }?>
                        
               
                <td style="background-color:#dfedf7;color:black;font-size:16px;"></td> 
                </tr>

            </tbody>
           
    </table>
    </center>

    <br>
    <center><form class="ui form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" ><button class="ui small positive  button" type="submit" id="b1" name="submit" style="border-radius:5px;"><h2>Submit</h2></button></form></center>
        
    <?php

    if(isset($_POST["submit"]))
    {
           
        $exp = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'Exp Mark' ");
        $expmark = $exp->fetch_row();
        //echo $expmark[0];
        $max = $con->query("SELECT `mark` FROM $_table WHERE  `rollno` like 'Max Mark' ");
        $maxmark = $max->fetch_row();
        //echo $maxmark[0];
        $sql="SELECT `mark` from $_table WHERE `sec` like '".strtolower($class)."' ORDER BY `rollno` ASC ";
        $data1=$con->query($sql);
        $tot_num=0;
        $got=0;
        //echo $sql;
        while($row1 = $data1->fetch_assoc()){
            if($row1['mark']!=NULL){
                $tot_num++;
                //echo $row1['mark']."---";
                if($row1['mark']>=$expmark[0])
                {
                    //echo $row1['mark'];
                $got++;
                }
            }
        }
        $Up2ExpLvl=(int)(($got/$tot_num)*100);
        $exp_att1=($expmark[0]/$maxmark[0])*100;
        $exp_att=(int)(($expmark[0]/$maxmark[0])*100);
        $sat_att=0;
        $AttLvlCo=0;
        $temp=(int)(($exp_att-50)/3);
        $range=[];
        array_push($range,50,50+$temp,$exp_att-$temp,$exp_att);
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
        //echo $exp_att;
        if($exp_att<=$range[0])
        {
            $sat_att=1;
        }
        else if($exp_att>$range[0] && $exp_att<=$range[1])
        {
            $sat_att=2;
        }
        else if($exp_att>$range[1] && $exp_att<=$range[2])
        {
            $sat_att=3;
        }
        else if($exp_att>$range[2] && $exp_att<=$range[3])
        {
            $sat_att=4;
        }
        else
        {
            $sat_att=5;
        }
        if($Up2ExpLvl<=$range[0])
        {
            $AttLvlCo=1;
        }
        else if($Up2ExpLvl>$range[0] && $Up2ExpLvl<=$range[1])
        {
            $AttLvlCo=2;
        }
        else if($Up2ExpLvl>$range[1] && $Up2ExpLvl<=$range[2])
        {
            $AttLvlCo=3;
        }
        else if($Up2ExpLvl>$range[2] && $Up2ExpLvl<=$range[3])
        {
            $AttLvlCo=4;
        }
        else
        {
            $AttLvlCo=5;
        }
        $range_str1=$range[0].'0'.$range[1];
        $range_str2=$range[2].'0'.$range[3];
        //echo "....".$range_str;
        $sql2="UPDATE $_table SET `mark` =".$got." WHERE rollno like 'Up2ExpLvl".$class."'";
        $sql3="UPDATE $_table SET `mark` =".$Up2ExpLvl." WHERE rollno like 'Up2ExLvl%".$class."'";
        $sql4="UPDATE $_table SET `mark` =".$exp_att1." WHERE rollno like 'ExpAtt".$class."'";
        $sql5="UPDATE $_table SET `mark` =".$sat_att." WHERE rollno like 'SatAtt".$class."'";
        $sql6="UPDATE $_table SET `mark` =".$AttLvlCo." WHERE rollno like 'AttLvlCo".$class."'";
        $sql7="UPDATE $_table SET `mark` =".intval($range_str1)." WHERE `rollno` LIKE 'range".$class."'";
        $sql8="UPDATE $_table SET `mark` =".intval($range_str2)." WHERE `rollno` LIKE 'range1".$class."'";
        $sql9="UPDATE $_table SET `mark` =".$AttLvlCo." WHERE rollno like 'Attco".$class."'";
        $con->query($sql2);
        $con->query($sql3);
        $con->query($sql4);
        $con->query($sql5);
        $con->query($sql6);
        $con->query($sql7);
        $con->query($sql8);
        $con->query($sql9);

    }

     ?>
       
  </div>
  



  <script  src="../js/Table1.js"></script>
    
</body>
</html>