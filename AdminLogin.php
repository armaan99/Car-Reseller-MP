<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
</head>

<?php
    if(isset($_POST["btnSubmit"])){
        require 'DbConn.php';

        $obj = new DbConn();
        $conn = $obj->connect();

        $userId = $_POST["txtLoginId"];
        $pwd = $_POST["txtPassword"];

        $sql = "select * from admin where email_id='$userId' and password='$pwd'";

        $result = $conn->query($sql);

        if($result->num_rows == 0){
            echo("<script> alertify.error('Invalid UserId or Password'); </script>");
        } else {
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION["Admin"] = $row;
            echo("<script> window.location.href='/carresellerMP/CarMaster.php'; </script>");
        }
    }
?>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="login-main">
            
            <h1>ADministrator Login</h1>
            
            <form action="AdminLogin.php" method="POST">
            
                <div class="form-row">
                    <label>Login ID : </label><br>
                    <input type="text" name="txtLoginId">
                </div>
            
                <div class="form-row">
                    <label>Password : </label><br>
                    <input type="password" name="txtPassword">
                </div>
            
                <div class="form-row text-center">
                    <input type="submit" name="btnSubmit">
                    <input type="reset" name="btnReset">
                </div>
            </form>
        
        </div>
    </div>

    <div class="gap-10"></div>
    
    <?php include 'footer.php'; ?>
</body>
</html>