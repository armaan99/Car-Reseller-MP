<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Car Master</title>
    
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
</head>
<body>
    <?php include 'adminNavbar.php'; ?>
    
    <?php 

        $carId = "";
        $name = "";
        $model = "";
        $description = "";
        $engine = "";
        $price = "";
        $milage = "";
        $fuel = "";
        $expertView = "";
        $status = "";

        $updateMode = false;

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        if(isset($_POST["btnSubmit"])){
            $name = $_POST["txtName"];
            $model = $_POST["txtModel"];
            $description = $_POST["txtDescription"];
            $engine = $_POST["txtEngine"];
            $price = $_POST["txtPrice"];
            $milage = $_POST["txtMilage"];
            $fuel = $_POST["txtFuelType"];
            $expertView = $_POST["txtExpertView"];
            $status = $_POST["ddlStatus"];

            $sql = "insert into car(name, model, description, engine, price, mileage, fuel_type, expert_view, status) VALUES ('$name', '$model', '$description', '$engine', '$price', '$milage', '$fuel', '$expertView', '$status')";
            if($conn->query($sql)){
                if($_FILES["fldCarImage"]["name"]){
                    $targetDirectory = "img/Products/";
                    $ext = pathinfo($_FILES["fldCarImage"]["name"],PATHINFO_EXTENSION);

                    if($ext != "jpg"){
                        echo "<script> alertify.message('Please use only jpg file format'); </script>";
                    }

                    $sql = "select max(car_id) as carId from car";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $carId = $row["carId"];

                    $targetLocation = $targetDirectory . $carId . "." . $ext;

                    try{
                        move_uploaded_file($_FILES["fldCarImage"]["tmp_name"],$targetLocation);
                        clearstatcache();
                    } catch(Throwable $th){
                        echo "<script> alertify.error('Faced some issue. Please try again'); </script>";
                    }
                }

                echo "<script> alertify.success('Data Inserted Successfully'); </script>";
                $carId = "";
                $name = "";
                $model = "";
                $description = "";
                $engine = "";
                $price = "";
                $milage = "";
                $fuel = "";
                $expertView = "";
                $status = "";
            } else {
                echo "<script> alertify.error('Error Saving Data'); </script>";
            }
        }

        if(isset($_GET["edit"])){
            $updateMode = true;

            $editId = $_GET["edit"];

            $sql = "select * from car where car_id=$editId";
            $editResult = $conn->query($sql);
            $editRow = $editResult->fetch_assoc();

            $carId = $editId;
            $name = $editRow["name"];
            $model = $editRow["model"];
            $description = $editRow["description"];
            $engine = $editRow["engine"];
            $price = $editRow["price"];
            $milage = $editRow["mileage"];
            $fuel = $editRow["fuel_type"];
            $expertView = $editRow["expert_view"];
            $status = $editRow["status"];
        }

        if(isset($_POST["btnUpdate"])){
            $carId = $_POST["txtCarId"];
            $name = $_POST["txtName"];
            $model = $_POST["txtModel"];
            $description = $_POST["txtDescription"];
            $engine = $_POST["txtEngine"];
            $price = $_POST["txtPrice"];
            $milage = $_POST["txtMilage"];
            $fuel = $_POST["txtFuelType"];
            $expertView = $_POST["txtExpertView"];
            $status = $_POST["ddlStatus"];

            $sql = "update car set name='$name', model='$model', description='$description', engine='$engine', price='$price', mileage='$milage', fuel_type='$fuel', expert_view='$expertView', status='$status' WHERE car_id=$carId";
            if($conn->query($sql)){
                if($_FILES["fldCarImage"]["name"]){
                    $targetDirectory = "img/Products/";
                    $ext = pathinfo($_FILES["fldCarImage"]["name"],PATHINFO_EXTENSION);

                    if($ext != "jpg"){
                        echo "<script> alertify.message('Please use only jpg file format'); </script>";
                    }

                    $targetLocation = $targetDirectory . $carId . "." . $ext;

                    try{
                        move_uploaded_file($_FILES["fldCarImage"]["tmp_name"],$targetLocation);
                        clearstatcache();
                    } catch(Throwable $th){
                        echo "<script> alertify.error('Faced some issue. Please try again'); </script>";
                    }
                }

                echo "<script> alertify.success('Data Update Successfully'); </script>";
            } else {
                echo "<script> alertify.error('Error Updating Data'); </script>";
            }
            $carId = "";
            $name = "";
            $model = "";
            $description = "";
            $engine = "";
            $price = "";
            $milage = "";
            $fuel = "";
            $expertView = "";
            $status = "";
        }

        if(isset($_GET["del"])){
            $carId = $_GET["del"];

            $sql = "delete from car where car_id=$carId";
            
            if($conn->query($sql)){
                echo "<script> alertify.success('Record Deleted Successfully'); </script>";
                $carId = "";
                $name = "";
                $model = "";
                $description = "";
                $engine = "";
                $price = "";
                $milage = "";
                $fuel = "";
                $expertView = "";
                $status = "";
            } else {
                echo "<script> alertify.error('Error Deleting record'); </script>";
            }        
        }

        $sql = "select * from car";
        $result =$conn->query($sql);
    ?>

    <div class="container">
        <div class="admin-wrapper">
            
            <?php include 'adminSidebar.php'; ?>
            
            <div class="admin-mainContent">
                <h1>Car Master</h1>
                <form action="CarMaster.php" method="POST" enctype="multipart/form-data">
                    <div style="display: flex;">
                        <div class="admin-form">
                            <div class="form-row">
                                <label>Car ID : </label><br>
                                <input type="text" name="txtCarId" value="<?php echo $carId; ?>" readonly>
                            </div>
                            <div class="form-row">
                                <label>Name : </label><br>
                                <input type="text" name="txtName" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-row">
                                <label>Model : </label><br>
                                <input type="text" name="txtModel" value="<?php echo $model; ?>">
                            </div>
                            <div class="form-row">
                                <label>Description : </label><br>
                                <textarea class="form-element" name="txtDescription"><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-row">
                                <label>Engine : </label><br>
                                <input type="text" name="txtEngine" value="<?php echo $engine; ?>">
                            </div>
                            <div class="form-row">
                                <label>Price : </label><br>
                                <input type="text" name="txtPrice" value="<?php echo $price; ?>">
                            </div>
                            <div class="form-row">
                                <label>Milage : </label><br>
                                <input type="text" name="txtMilage" value="<?php echo $milage; ?>">
                            </div>
                            <div class="form-row">
                                <label>Fuel Type : </label><br>
                                <input type="text" name="txtFuelType" value="<?php echo $fuel; ?>">
                            </div>
                            <div class="form-row">
                                <label>Expert View : </label><br>
                                <textarea class="form-element" name="txtExpertView"><?php echo $expertView; ?></textarea>
                            </div>
                            <div class="form-row">
                                <label>Status : </label><br>
                                <select name="ddlStatus" class="form-element">
                                    <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Booked">Booked</option>
                                    <option value="Sold">Sold</option>
                                </select>
                            </div>
                            <div class="form-row text-center">
                                <?php if($updateMode == false) : ?>
                                    <input type="submit" name="btnSubmit" value="Save">
                                <?php else : ?>
                                    <input type="submit" name="btnUpdate" value="Update">
                                <?php endif?>
                                <input type="reset" name="btnReset" onclick="reload()">
                            </div>
                        </div>
                        <div class="signup-image">
                            <div class="car-image">
                                    <img src="<?php echo "img/Products/". $carId . ".jpg" ; ?>" width="100%">
                            </div>
                            <div class="gap-10"></div>
                            <input type="file" name="fldCarImage">
                        </div>
                    </div>
                </form>
                <div class="admin-table">
                     <table>
                        <tr>
                            <th>Car ID</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php 
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>";
                                        echo $row["car_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["name"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["model"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["price"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = /carresellermp/CarMaster.php?edit=". $row["car_id"] .">Edit</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = javascript:del(". $row["car_id"] .")>Delete</a>";
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
            window.location.href='/carresellerMP/CarMaster.php';
        }

        function del(id){
            if(confirm("Are you sure, you want to delete the record?")){
                window.location.href='/carresellerMP/CarMaster.php?del='+id;
            }
        }
    </script>
</body>
</html>