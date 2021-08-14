<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarResellerMP</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <?php 

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        $sql = "select * from car where status != 'Sold'";
        $result = $conn->query($sql);
    ?>
    
    <div class="container">
        <div class="cover">
            <input type="text">
            <input type="button" value="Search">
        </div>
        <div class="main-content">
            <h2 style="text-align: center; margin: 10px;">Available Cars</h2>
            <div class="car-view">
                <?php
                    while($row = $result->fetch_assoc()){
                        echo '<div class="item">';
                            echo '<a href="ProductDetails.php?id='. $row["car_id"] .'">';
                                echo '<img src="img/Products/'. $row["car_id"] .'.jpg">';
                                echo '<h2>'. $row["name"] .'</h2>';
                                echo '<h2> &#8377;'. $row["price"] .'/-</h2>';
                            echo '</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>