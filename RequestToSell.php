<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Your Car</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="selling-heading">
            <h1>Sell Your Car</h1>
            <div class="gap-10"></div>
            <p>Please fill the form to provide details about your car. Our company executive will contact you for further process.</p>
            <div class="gap-10"></div>
            <hr><hr>
        </div>
        <div class="signup-wrapper">
            <div class="signup-main">
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
            </div>
            <div class="signup-image">
                <div class="car-image">
    
                </div>
                <div class="gap-10"></div>
                <input type="file" name="fldCarImage">
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>