<?php

include_once("../db.php");
session_start();
if(!isset($_SESSION['admin']))
{

    header("Location: ./index.php");

}

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
    <div class="ui raised segment" style="width:93%;margin:3%;height:67%" id=""><br><br>

        <form class="ui fluid form" id="frm" method="POST" action="./admin.php">
            <div class="field">
                <div class="ui two column grid">
                    <div class="row">
                        <div class="four wide column">
                            <h3 class="ui center aligned header" style="margin:3%">Course Code</h3>
                        </div>
                        <div class="twelve wide column">
                            <input type="text" name="code" required>
                        </div>
                    </div>
                </div>

                <div class="ui two column grid">
                    <div class="row">
                        <div class="four wide column">
                            <h3 class="ui center aligned header" style="margin:3%">Course Name</h3>
                        </div>
                        <div class="twelve wide column">
                            <input type="text"  name="name" required>
                        </div>
                    </div>
                </div>


                <div class="ui four column grid">
                    <div class="row">
                        <div class="column">
                            <h3 class="ui center aligned header" style="margin:3%">Batch</h3>
                        </div>
                        <div class="column">
                            <input type="text" name="batch" required>
                        </div>
                        <div class="column">
                            <h3 class="ui center aligned header" style="margin:3%">Year</h3>
                        </div>

                        <div class="column">
                            <input type="text"  name="year" required>
                        </div>
                    </div>

                </div>

                <div class="ui four column grid">
                    <div class="row">
                        <div class="column">
                            <h3 class="ui center aligned header" style="margin:3%">Semester</h3>
                        </div>
                        <div class="column">
                            <input type="text"  name="sem" required>
                        </div>
                        <div class="column">
                            <h3 class="ui center aligned header" style="margin:3%">Credit</h3>
                        </div>
                        <div class="column">
                            <input type="text"  name="cred" required>
                        </div>
                    </div>
                </div>

                
                    
                        <div class="ui two column grid">
                            <div class="row">
                                <div class="four wide column">
                                    <h3 class="ui center aligned header" style="margin:3%">Course Co-Ordinator</h3>
                                </div>
                                <div class="twelve wide column">
                                    <div class="ui action input">
                                       
                                        
                                    <tr>
                                
                                <select name='staff' class="ui fluid search dropdown" id="drop" required>
                                    <option value="">Select Staff</option>
                                    <option value="CSE001SF">Dr.N.Shanthi</option>
                                    <option value="CSE002SF">Dr.R.R.Rajalaxmi</option>
                                    <option value="CSE003SF">Dr.K.Kousalya</option>
                                    <option value="CSE004SF">Dr.S.Malliga</option>
                                    <option value="CSE005SF">Dr.R.C.Suganthe</option>
                                    <option value="CSE006SF">Dr.P.Natesan</option>
                                    <option value="CSE007SF">Dr.C.S.Kanimozhi Selvi</option>
                                    <option value="CSE008SF">Dr.E.Gothai</option>
                                    <option value="CSE009SF">Dr.P.Jayanthi</option>
                                    <option value="CSE010SF">Dr.S.Shanthi</option>
                                    <option value="CSE011SF">Mr.N.P.Saravanan</option>
                                    <option value="CSE012SF">Dr.K.Nirmala Devi</option>
                                    <option value="CSE013SF">Ms.PCD.Kalaivaani</option>
                                    <option value="CSE014SF">Dr.R.S.Latha</option>
                                    <option value="CSE015SF">Dr.N.Krishnamoorthy</option>
                                    <option value="CSE016SF">Dr.K.Sangeetha</option>
                                    <option value="CSE017SF">Dr.S.V.Kogilavani</option>
                                    <option value="CSE018SF">Dr.P.Vishnu Raja</option>
                                    <option value="CSE019SF">Dr.P.Keerthika</option>
                                    <option value="CSE020SF">Dr.S.K.Nivetha</option>
                                    <option value="CSE021SF">Dr.R.S.Mohana</option>
                                    <option value="CSE022SF">Ms.M.Geetha</option>
                                    <option value="CSE023SF">Dr.R.Manjula Devi</option>
                                    <option value="CSE024SF">Mr.T.Kumaravel</option>
                                    <option value="CSE025SF">Ms.S.Ramya</option>
                                    <option value="CSE026SF">Mr.K.Devendran</option>
                                    <option value="CSE027SF">Ms.N.Sasipriyaa</option>
                                    <option value="CSE028SF">Mr.B.Bizu</option>
                                    <option value="CSE029SF">Mr.R.Sureshkumar</option>
                                    <option value="CSE030SF">Ms.D.Deepa</option>
                                    <option value="CSE031SF">Mr.S.Selvaraj</option>
                                    <option value="CSE032SF">Ms.M.Sangeetha</option>
                                    <option value="CSE033SF">Ms.O.R.Deepa</option>
                                    <option value="CSE034SF">Mr.P.S.Prakash</option>
                                    <option value="CSE035SF">Ms.K.S.Kalaivani</option>
                                    <option value="CSE036SF">Mr.S.Santhoshkumar</option>
                                    <option value="CSE037SF">Ms.C.Sagana</option>
                                    <option value="CSE038SF">Mr.B.Krishnakumar</option>
                                    <option value="CSE039SF">Ms.S.Mohana Saranya</option>
                                    <option value="CSE040SF">Ms.S.Mohanapriya </option>
                                    <option value="CSE041SF">Ms.P.S.Nandhini</option>
                                    <option value="CSE042SF">Ms.K.Tamil Selvi </option>
                                    <option value="CSE043SF">Ms.M.K.Dharani</option>
                                    <option value="CSE044SF">Ms.Vani Rajasekar</option>
                                    <option value="CSE045SF">Ms.K.Venu</option>
                                    <option value="CSE046SF">Dr.K.Dinesh</option>
                                </select>
                                
                               
                            </tr>
                        
                        


            
        <br><br><br><br><br>
       
    </div>
    <button class="ui circular right floated  blue icon button"name="submit" type="submit"> Assign & Create </button>
    </form>
    <!-- <script>
        $(document).ready(function(){

            $("#frm").on("submit",function(){
              var ans= $("#frm").serialize();
              console.log(ans);
              $.ajax({
                url:'../Ajax/admin.php',
                data:ans,
                type:'POST',
                success:function(res){
                    alert(res);
                    $("#frm")[0].reset();
                }
              });
             
              return false;
            });

        });
        
    </script> -->
</body>

</html>
