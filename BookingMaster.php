<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Booking Verification</title>
    
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
</head>
<body>
    <?php include 'adminNavbar.php'; ?>

    <?php 

        $bookingId = "";
        $customerId = "";
        $carId = "";
        $carName = "";
        $customerName = "";
        $contactNo = "";
        $price = "";
        $modelYear = "";
        $status = "";

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        if(isset($_GET["edit"])){
            $bookingId = $_GET["edit"];

            $sql = "select * from booking where booking_id=$bookingId";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $customerId = $row["customer_id"];
            $carId = $row["car_id"];
            $status = $row["status"];
            
            $sql = "select * from customer where customer_id=$customerId";
            $result = $conn->query($sql);
            $CustomerData = $result->fetch_assoc();

            $sql = "select * from car where car_id=$carId";
            $result = $conn->query($sql);
            $CarData = $result->fetch_assoc();

            $carName = $CarData["name"];
            $customerName = $CustomerData["name"];
            $contactNo = $CustomerData["contact_no"];
            $price = $CarData["price"];
            $modelYear = $CarData["model"];
        }

        if(isset($_POST["btnUpdate"])){
            $bookingId = $_POST["txtBookingId"];
            $status = $_POST["txtStatus"];
            
            $sql = "update booking set status='$status' where booking_id=$bookingId";
            if($conn->query($sql)){
                echo "<script> alertify.success('Data Update Successfully'); </script>";
                $bookingId = "";
                $customerId = "";
                $carId = "";
                $carName = "";
                $customerName = "";
                $contactNo = "";
                $price = "";
                $modelYear = "";
                $status = "";
            } else {
                echo "<script> alertify.error('Error Updating Data'); </script>";
            }
        }

        $sql = "select * from booking";
        $result = $conn->query($sql);

    ?>

    <div class="container">
        <div class="admin-wrapper">
            
            <?php include 'adminSidebar.php'; ?>

            <div class="admin-mainContent">
                <h1>Booking Verification</h1>
                <form action="BookingMaster.php" method="POST">
                    <div class="admin-form">
                        <div class="form-row">
                            <label>Booking ID : </label><br>
                            <input type="text" name="txtBookingId" value="<?php echo $bookingId ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Car Name : </label><br>
                            <input type="text" name="txtCarName" value="<?php echo $carName ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Customer Name : </label><br>
                            <input type="text" name="txtCustomerName" value="<?php echo $customerName ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Contact No : </label><br>
                            <input type="text" name="txtContactNo" value="<?php echo $contactNo ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Price : </label><br>
                            <input type="text" name="txtPrice" value="<?php echo $price ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Model Year : </label><br>
                            <input type="text" name="txtModelYear" value="<?php echo $modelYear ?>" readonly>
                        </div>
                        <div class="form-row">
                            <label>Status : </label><br>
                            <input type="text" name="txtStatus" value="<?php echo $status ?>">
                        </div>
                        <div class="form-row text-center">
                            <input type="submit" name="btnUpdate" value="Update">
                            <input type="reset" name="btnReset" onclick="reload()">
                        </div>
                    </div>
                </form>
                <div class="admin-table">
                     <table>
                        <tr>
                            <th>Booking ID</th>
                            <th>Car ID</th>
                            <th>Customer ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php 
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>";
                                        echo $row["booking_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["car_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["customer_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["date"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["status"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = /carresellermp/BookingMaster.php?edit=". $row["booking_id"] .">Edit</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = javascript:del(". $row["booking_id"] .")>Delete</a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                     </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function reload(){
            window.location.href='/carresellerMP/BookingMaster.php';
        }

        function del(id){
            if(confirm("Are you sure, you want to delete the record?")){
                window.location.href='/carresellerMP/BookingMaster.php?del='+id;
            }
        }
    </script>
</body>
</html>