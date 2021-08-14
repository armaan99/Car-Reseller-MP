<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Master</title>
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
</head>
<body>
    <?php include 'adminNavbar.php'; ?>

    <?php 

        $customerId = "";
        $name = "";
        $dob = "";
        $email = "";
        $address = "";
        $city = "";
        $contactNo = "";

        $updateMode = false;

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

            $sql = "insert into customer(name, dob, email, address, city, contact_no) values ('$name', '$dob', '$email', '$address', '$city', '$contactNo')";
            if($conn->query($sql)){
                echo "<script> alertify.success('Data Inserted Successfully'); </script>";
                $customerId = "";
                $name = "";
                $dob = "";
                $email = "";
                $address = "";
                $city = "";
                $contactNo = "";
            } else {
                echo "<script> alertify.error('Error Saving Data'); </script>";
            }
        }

        if(isset($_GET["edit"])){
            $updateMode = true;

            $editId = $_GET["edit"];

            $sql = "select * from customer where customer_id=$editId";
            $editResult = $conn->query($sql);
            $editRow = $editResult->fetch_assoc();

            $customerId = $editRow["customer_id"];
            $name = $editRow["name"];
            $dob = $editRow["dob"];
            $email = $editRow["email"];
            $address = $editRow["address"];
            $city = $editRow["city"];
            $contactNo = $editRow["contact_no"];
        }

        if(isset($_POST["btnUpdate"])){
            $customerId = $_POST["txtCustomerId"];
            $name = $_POST["txtName"];
            $dob = $_POST["txtDOB"];
            $email = $_POST["txtEmail"];
            $address = $_POST["txtAddress"];
            $city = $_POST["txtCity"];
            $contactNo = $_POST["txtContactNo"];

            $sql = "update customer set name='$name', dob='$dob', email='$email', address='$address', city='$city', contact_no='$contactNo' where customer_id=$customerId";
            if($conn->query($sql)){
                echo "<script> alertify.success('Data Update Successfully'); </script>";
                $customerId = "";
                $name = "";
                $dob = "";
                $email = "";
                $address = "";
                $city = "";
                $contactNo = "";
            } else {
                echo "<script> alertify.error('Error Updating Data'); </script>";
            }
        }

        if(isset($_GET["del"])){
            $customerId = $_GET["del"];

            $sql = "delete from customer where customer_id=$customerId";
            
            if($conn->query($sql)){
                echo "<script> alertify.success('Record Deleted Successfully'); </script>";
                $customerId = "";
                $name = "";
                $dob = "";
                $email = "";
                $address = "";
                $city = "";
                $contactNo = "";
            } else {
                echo "<script> alertify.error('Error Deleting record'); </script>";
            }        
        }

        $sql = "select * from customer";
        $result =$conn->query($sql);

    ?>
    
    <div class="container">
        <div class="admin-wrapper">
            
            <?php include 'adminSidebar.php'; ?>
            
            <div class="admin-mainContent">

                <h1>User Master</h1>
            
                <div class="admin-form">
            
                    <form action="UserMaster.php" method="POST">
            
                        <div class="form-row">
                            <label>Customer ID : </label><br>
                            <input type="text" name="txtCustomerId" value="<?php echo $customerId; ?>" readonly>
                        </div>
            
                        <div class="form-row">
                            <label>Name : </label><br>
                            <input type="text" name="txtName" value="<?php echo $name; ?>">
                        </div>
            
                        <div class="form-row">
                            <label>DOB : </label><br>
                            <input type="date" name="txtDOB" class="form-element" value="<?php echo $dob; ?>">
                        </div>
            
                        <div class="form-row">
                            <label>Email : </label><br>
                            <input type="text" name="txtEmail" value="<?php echo $email; ?>">
                        </div>
            
                        <div class="form-row">
                            <label>Address : </label><br>
                            <textarea class="form-element" name="txtAddress"><?php echo $address; ?></textarea>
                        </div>
            
                        <div class="form-row">
                            <label>City : </label><br>
                            <input type="text" name="txtCity" value="<?php echo $city; ?>">
                        </div>
            
                        <div class="form-row">
                            <label>Contact No. : </label><br>
                            <input type="text" name="txtContactNo" value="<?php echo $contactNo; ?>">
                        </div>
            
                        <div class="form-row text-center">
                            <?php if($updateMode == false) : ?>
                                <input type="submit" name="btnSubmit" value="Save">
                            <?php else : ?>
                                <input type="submit" name="btnUpdate" value="Update">
                            <?php endif?>
                            <input type="reset" name="btnReset" onclick="reload()">
                        </div>
            
                    </form>
                </div>
                <div class="admin-table">
                     <table>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Contact No</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php 
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>";
                                        echo $row["customer_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["name"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["city"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["contact_no"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = /carresellermp/UserMaster.php?edit=". $row["customer_id"] .">Edit</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = javascript:del(". $row["customer_id"] .")>Delete</a>";
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
            window.location.href='/carresellerMP/UserMaster.php';
        }

        function del(id){
            if(confirm("Are you sure, you want to delete the record?")){
                window.location.href='/carresellerMP/UserMaster.php?del='+id;
            }
        }
    </script>
</body>
</html>