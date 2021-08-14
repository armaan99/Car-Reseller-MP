<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <?php 

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        if(isset($_POST["btnSubmit"])){
            $name = $_POST["txtName"];
            $dob = $_POST["txtDOB"];
            $email = $_POST["txtEmail"];
            $address = $_POST["txtAddress"];
            $city = $_POST["txtCity"];
            $contactNo = $_POST["txtContactNo"];
            $password = $_POST["txtPassword"];

            $sql = "insert into customer(name, dob, email, address, city, contact_no, password) VALUES ('$name', '$dob', '$email', '$address', '$city', '$contactNo', '$password')";
            if($conn->query($sql)){
                echo "<script> alertify.success('User Successfully Registered'); </script>";
            } else {
                echo "<script> alertify.error('Error Registering User'); </script>";
            }
        }
    ?>

    <div class="container">
        <div class="signup-main">
            <h1>Customer Registration</h1>

            <form action="Signup.php" method="POST">
                <div class="form-row">
                    <label>Name : </label><br>
                    <input type="text" name="txtName" class="form-element">
                </div>
                <div class="form-row">
                    <label>Date of Birth : </label><br>
                    <input type="date" name="txtDOB" class="form-element">
                </div>
                <div class="form-row">
                    <label>Email-ID : </label><br>
                    <input type="text" name="txtEmail" class="form-element">
                </div>
                <div class="form-row">
                    <label>Address : </label><br>
                    <textarea name="txtAddress" class="form-element"></textarea>
                </div>
                <div class="form-row">
                    <label>City : </label><br>
                    <input type="text" name="txtCity" class="form-element">
                </div>
                <div class="form-row">
                    <label>Contact Number : </label><br>
                    <input type="text" name="txtContactNo" class="form-element">
                </div>
                <div class="form-row">
                    <label>Password : </label><br>
                    <input type="password" name="txtPassword" class="form-element">
                </div>
                <div class="form-row">
                    <label>Re-enter Password : </label><br>
                    <input type="password" name="txtRePassword" class="form-element">
                </div>
                <div class="form-row text-center">
                    <input type="submit" name="btnSubmit">
                    <input type="reset" name="btnReset">
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>