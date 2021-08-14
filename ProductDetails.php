<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
    <style>
        .productDetail input[type="submit"] {
            background-color: blue;
            color: white;
            font-size: 20px;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.5s;
            margin-top: 20px;
        }

        .productDetail input[type="submit"]:hover {
            background-color: white;
            color: blue;
            border: 2px solid blue;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'navBar.php'; ?>
    
    <?php 

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        if(isset($_GET["id"])){
            $_SESSION["Car"] = $_GET["id"];
            $carId = $_GET["id"];

            $sql = "select * from car where car_id = $carId";
            $Result = $conn->query($sql);
            $Row = $Result->fetch_assoc();


            $name = $Row["name"];
            $model = $Row["model"];
            $description = $Row["description"];
            $engine = $Row["engine"];
            $price = $Row["price"];
            $expertView = $Row["expert_view"];
        } else {
            echo "<script> alertify.error('Car Details not found'); </script>";
            echo "<script> window.location.href='/carresellerMP/Index.php' </script>";
        }

        if(isset($_GET["btnBookNow"])){
            $customerId = $_SESSION["User"]["customer_id"];
            $carId = $_SESSION["Car"];
            $date = date("y/m/d");

            $sql = "insert into booking(car_id, customer_id, date) values('$carId', '$customerId', '$date')";
            if($conn->query($sql)){
                echo "<script> alertify.success('Booking Successful'); </script>";
                unset($_SESSION["Car"]);
                echo "<script> window.location.href='/carresellerMP/Index.php' </script>";
            }
        }

    ?>

    <div class="container">
        <h1 style="text-align: center; margin-top: 10px;">Product Details</h1>
        <hr><hr>
        <div class="productDetails-main">
            <div class="productImage">
                <img src="img/Products/<?php echo $carId ?>.jpg">
            </div>
            <div class="productDetail">
                <h2>Name : <?php echo $name; ?></h2>
                <h3>Model : <?php echo $model; ?></h3>
                <h3>Engine : <?php echo $engine; ?></h3>
                <h3>Price : <?php echo $price; ?></h3>
                <form action="ProductDetails.php" method="GET">
                    <input type="submit" value="Book Now" name="btnBookNow" />
                </form>
            </div>
        </div>
        <hr><hr>
        <div class="productDetails-other">
            <h3>Description : </h3>
            <!-- To put Dummy Data - use lorem*(no. of lines) -->
            <p><?php echo $description; ?></p>
            <div class="gap-10"></div>
            <h3>Expert's Comments : </h3>
            <!-- To put Dummy Data - use lorem*(no. of lines) -->
            <p><?php echo $expertView; ?></p>
            <div class="gap-10"></div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>