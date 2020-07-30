<?php
include_once("./db.php");
session_start();
if(isset($_SESSION["staffid"]))
{
  header("Location: ./staff/index.php");
}
?>

<?php
    
    if (isset($_POST["sub1"]))
    {
        
        $mail=$_POST["mail"];
        // echo $mail;
        $sql="select * from staff where mail like '$mail'";
        $res=$con->query($sql);
        $count=$res->num_rows;
        echo $count;
        $row=$res->fetch_assoc();        //$data=$res->fetch_assoc();
       if( $count==1)
       {
             
            $_SESSION["staffid"]=$row['staffid'];
            $_SESSION["staffname"]=$row['name'];
            header("Location: ./staff/index.php");
       }
       else{

           echo "<script>alert('Details mismatch');</script>";
       }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
     <link rel="stylesheet" href="./assets/Fomantic/dist/semantic.min.css" type="text/css"/> 
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
    .box
    {
        position:absolute;
        top: 50%;
        left: 50%;
        transform:translate(-50%,-50%);
        width:400px;
        padding:40px;
        background:rgba(0,0,0,.8);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.5);
        border-radius: 10px;
    }
    .box h2
    {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }
    .box .inputBox
    {
        position:relative;
    }
    .box .inputBox input
    {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        letter-spacing: 1px;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid;
        outline: none;
        background: transparent;
    }
    .box .inputBox label
    {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }
    .box .inputBox input:focus ~ label,
    .box .inputBox input:valid ~ label
    {
        top: -18px;
        left: 0;
        color: #03a9f4;
        font-size: 12px;
    }
    .box input[type="submit"]
    {
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        background: #03a9f4;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    
</style>
<body>

    <div class="box">
        <h2 class="animate__animated animate__bounce "> Staff Login</h2>
        <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class="inputBox">
                <input type="mail" name="mail" id="mail" required="">
                <label>Email</label>
            </div>
            <div class="inputBox">
                <input type="password" name="pass" required="">
                <label>Password</label>
            </div>
            <center><button type="submit" name="sub1" class="ui positive button"value="Submit" onclick="myFunction()">Submit</button></center>
            
</form>
    </div>
    <script>
        function myFunction()
        {
          var mail;
          mail=document.getElementById("mail").value;
          if(mail=='')
          {
            alert('Please enter a valid detail');
            return false;
          }
        }
    </script>
    
</body>
</html>