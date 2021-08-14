<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="contactUsWrapper">
            <div class="contactUsMap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.858845253381!2d75.80073581479303!3d22.621745685157457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962f9423ee63999%3A0x27662778b2818cb4!2sMedicaps%20university%20rau!5e0!3m2!1sen!2sin!4v1624873571385!5m2!1sen!2sin" width="650" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="contactUsAddress">
                <h2>Address</h2>
                <hr><hr>
                <h3>Indore</h3>
                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda</h3>
                <div class="gap-10"></div>
                <h3>Bhopal</h3>
                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda</h3>
            </div>
        </div>
        <hr>
        <div class="contactUsForm">
            <h2>Write To Us</h2>
            <p>If you have any query, please fill form, our executive will contact you.</p>
            <div class="form-row">
                <label>Name : </label><br>
                <input type="text" name="txtName">
            </div>
            <div class="form-row">
                <label>Message : </label><br>
                <textarea name="message" class="form-element"></textarea>
            </div>
            <div class="form-row text-center">
                <input type="submit" name="btnSubmit">
                <input type="reset" name="btnReset">
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>