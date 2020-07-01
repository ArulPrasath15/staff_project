<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body
    {
        margin:0;
        padding:0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background:url("kec.jpeg") ;
        background-size: cover; 
    }
    .inbox
    {
        position:absolute;
        top: 0%;
        left: 20%;
        padding:40px;
        text-align: center;
        font-size: 30px;
        color:white;
    }
    .box
    {
        position: absolute;
        top: 30%;
        left: 21%;
        text-align: center;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 25px;
        color:black;
    }
    input[type=button]
    {
        border:none;
        width:190px;
        background:white;
        color:#000;
        font-size: 16px;
        line-height: 25px;
        padding: 10px 0;
        border-radius: 15px;
        cursor: pointer;
    }
    input[type=button]:hover
    {
        color:white;
        background-color:black;
    }
    
</style>
<body>
    <div class="card">
    <div class="inbox">
        <h1>KONGU ENGINEERING COLLEGE</h1>
    </div>
       <div class="box">
        <h1>STUDENTS MARK MANAGEMENT SYSTEM</h1>
    </div>
    <form>
        <input type="button"name="sub" value="LOGIN" id="login" onclick="myFunction()">
    </form>

</body>
<script>
    function myFunction()
    {
        window.location.replace("login.php");
    }
</script>
</html>