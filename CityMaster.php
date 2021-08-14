<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Master</title>
    <link rel="stylesheet" href="main.css">
    <?php include 'alertify.php'; ?>
    <script src="alertify.js"></script>
</head>
<body>
    <?php include 'adminNavbar.php'; ?>

    <?php 

        $cityId = "";
        $city = "";
        $state = "";
        
        $updateMode = false;

        require_once 'DbConn.php';
        $obj = new DbConn();
        $conn = $obj->connect();

        if(isset($_GET["btnSubmit"])){
            $city = $_GET["txtCityName"];
            $state = $_GET["txtState"];

            $sql = "insert into city(name, state) values ('$city', '$state')";
            if($conn->query($sql)){
                echo "<script> alertify.success('Data Inserted Successfully'); </script>";
                $cityId = "";
                $city = "";
                $state = "";
            } else {
                echo "<script> alertify.error('Error Saving Data'); </script>";
            }
        }

        if(isset($_GET["edit"])){
            $updateMode = true;

            $editId = $_GET["edit"];

            $sql = "select * from city where city_id=$editId";
            $editResult = $conn->query($sql);
            $editRow = $editResult->fetch_assoc();

            $cityId = $editRow["city_id"];
            $city = $editRow["name"];
            $state = $editRow["state"];
        }

        if(isset($_GET["btnUpdate"])){
            $cityId = $_GET["txtCityId"];
            $city = $_GET["txtCityName"];
            $state = $_GET["txtState"];

            $sql = "update city set name='$city', state='$state' where city_id=$cityId";
            if($conn->query($sql)){
                echo "<script> alertify.success('Data Update Successfully'); </script>";
                $cityId = "";
                $city = "";
                $state = "";
            } else {
                echo "<script> alertify.error('Error Updating Data'); </script>";
            }
        }

        if(isset($_GET["del"])){
            $cityId = $_GET["del"];

            $sql = "delete from city where city_id=$cityId";
            
            if($conn->query($sql)){
                echo "<script> alertify.success('Record Deleted Successfully'); </script>";
                $cityId = "";
                $city = "";
                $state = "";
            } else {
                echo "<script> alertify.error('Error Deleting record'); </script>";
            }        
        }

        $sql = "select * from city";
        $result =$conn->query($sql);
    ?>
    
    <div class="container">
        <div class="admin-wrapper">
            
            <?php include 'adminSidebar.php'; ?>
            
            <div class="admin-mainContent">
                
                <h1>City Master</h1>
                
                <div class="admin-form">
                
                    <form action="CityMaster.php" method="GET">

                        <div class="form-row">
                            <label>City ID : </label><br>
                            <input type="text" name="txtCityId" value="<?php echo $cityId; ?>" readonly>
                        </div>

                        <div class="form-row">
                            <label>City Name : </label><br>
                            <input type="text" name="txtCityName" value="<?php echo $city; ?>">
                        </div>
                    
                        <div class="form-row">
                            <label>State : </label><br>
                            <input type="text" name="txtState" value="<?php echo $state; ?>">
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
                            <th>City ID</th>
                            <th>Name</th>
                            <th>State</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php 
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>";
                                        echo $row["city_id"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["name"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $row["state"];
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = /carresellermp/CityMaster.php?edit=". $row["city_id"] .">Edit</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href = javascript:del(". $row["city_id"] .")>Delete</a>";
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
            window.location.href='/carresellerMP/CityMaster.php';
        }

        function del(id){
            if(confirm("Are you sure, you want to delete the record?")){
                window.location.href='/carresellerMP/CityMaster.php?del='+id;
            }
        }
    </script>
</body>
</html>