<?php 
    include_once('../db.php');
    session_start();
    $co=["","","","",""];
    $po=[0,0,0,0,0,0,0,0,0,0,0,0];
    $poc=[0,0,0,0,0,0,0,0,0,0,0,0];
    $poa=[0,0,0,0,0,0,0,0,0,0,0,0];
    $pso=[0,0];
    $psoc=[0,0];
    $psoa=[0,0];
    for($i=1;$i<=5;$i++){
        $co[$i]="PO= ";
        for($j=1;$j<=12;$j++){
            if($_POST['co'.$i.'po'.$j]>0){
                $co[$i].=$j.",";
                $po[$j-1]+=$_POST['co'.$i.'po'.$j];
                $poc[$j-1]++;
            }
        }
        $co[$i]=substr($co[$i],0,-1);
        $co[$i].=" : PSO= ";
        if($_POST['co'.$i.'pso1']>0){
            $co[$i].="1,";
            $pso[0]+=$_POST['co'.$i.'pso1'];
            $psoc[0]++;
        }
        if($_POST['co'.$i.'pso2']>0){
            $co[$i].="2,";
            $pso[1]+=$_POST['co'.$i.'pso2'];
            $psoc[1]++;
        }
        $co[$i]=substr($co[$i],0,-1);

    }
    for($j=0;$j<12;$j++){
        if($poc[$j]>0){
        $poa[$j]=$po[$j]/$poc[$j];
        }
    }
    $psoa[0]=$pso[0]/$psoc[0];
    $psoa[1]=$pso[1]/$psoc[1];
    // print_r($co);
    // print_r($poa);
    // print_r($psoa);
    $sql="INSERT INTO `copo`(`code`, `co1`, `co2`, `co3`, `co4`, `co5`, `po1`, `po2`, `po3`, `po4`, `po5`, `po6`, `po7`, `po8`, `po9`, `po10`, `po11`, `po12`, `pso1`, `pso2`) VALUES ('".$_GET['code']."','".$co[1]."','".$co[2]."','".$co[3]."','".$co[4]."','".$co[5];
    for($j=0;$j<12;$j++){
        $sql.="','".$poa[$j];     
    }
    $sql.="','".$psoa[0]."','".$psoa[1]."')";
    //echo $sql;
    if($con->query($sql))
    {
            //echo "COPO Mapped successfuly!";
            echo '<script>alert("COPO Mapped successfuly!")<script>';
            header("Location: ./index.php");
    }       
    else{
        //echo $sql;
        //echo "Error occurred...Try again!";
        echo '<script>alert("Error occurred...Try again!")<script>';
        header("Location: ./copo.php");
    }
?>