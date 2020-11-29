<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FrontPage</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
    body
    {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background-image:url("./Images/bg.jpg");
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
    .box input[type="button"]
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
        <h2>KONGU ENGINEERING COLLEGE</h2><br>
        <h2>STAFF MARK ENTRY(CSE)</h2><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" name="admin" value="Admin Login" onclick="location.href = './admin/index.php';">
        &nbsp;&nbsp;&nbsp; <input type="button" name="staff" value="Staff Login" onclick="location.href = './staff/index.php';"><br><br>
            
    </div>