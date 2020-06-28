<?php
    session_start();
    $con=new mysqli("localhost","root","","student");
    if($con->connect_error)
    {
        die("Connection failed:".$con->connect_error);
    }
    if (isset($_POST["sub1"]))
    {
        $mail=$_POST["mail"];
        $sql="select * from staff where mail like '$mail'";
        $res=$con->query($sql);
        $count=$res->num_rows;
        echo $count;
        //$data=$res->fetch_assoc();
       if( $res->num_rows==1)
       {
        header("Location: staff.html");
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
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
    body
    {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background:url("kec.jpeg") ;
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
        <h2> Staff Login</h2>
        <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class="inputBox">
                <input type="mail" name="mail" id="mail" required="">
                <label>E-Mail Id</label>
            </div>
            <div class="inputBox">
                <input type="password" name="pass" required="">
                <label>Password</label>
            </div>
            <input type="submit" name="sub1" value="Submit" onclick="myFunction()"><br><br>
            <a href="#" style="color:blue">Forgot Password?</a>
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