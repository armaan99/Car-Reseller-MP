<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selling Requests Master</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/alertify.css">
    <link rel="stylesheet" href="css/themes/bootstrap.css">
</head>
<body>
    <?php include 'adminNavbar.php'; ?>
    
    <div class="container">
        <div class="admin-wrapper">
            
            <?php include 'adminSidebar.php'; ?>

            <div class="admin-mainContent">
                <h1>Selling Requests</h1>
                <div class="admin-form">
                    <div class="form-row">
                        <label>Request ID : </label><br>
                        <input type="text" name="txtRequestId">
                    </div>
                    <div class="form-row">
                        <label>Car Name : </label><br>
                        <input type="text" name="txtCarName">
                    </div>
                    <div class="form-row">
                        <label>Description : </label><br>
                        <input type="text" name="txtDescription">
                    </div>
                    <div class="form-row">
                        <label>Model Year : </label><br>
                        <input type="text" name="txtModelYear">
                    </div>
                    <div class="form-row">
                        <label>Customer ID : </label><br>
                        <input type="text" name="txtCustomerId">
                    </div>
                    <div class="form-row">
                        <label>Customer Name : </label><br>
                        <input type="text" name="txtCustomerName">
                    </div>
                    <div class="form-row">
                        <label>Expected Price : </label><br>
                        <input type="text" name="txtFinalPrice">
                    </div>
                    <div class="form-row">
                        <label>Engine : </label><br>
                        <input type="text" name="txtEngine">
                    </div>
                    <div class="form-row text-center">
                        <input type="submit" name="btnSubmit">
                        <input type="reset" name="btnReset">
                    </div>
                </div>
                <div class="admin-table">
                     <table>
                        <tr>
                            <th>Request ID</th>
                            <th>Car Name</th>
                            <th>Customer Name</th>
                            <th>Expected Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>xyz</td>
                            <td>Indore</td>
                            <td>xxxxxx9898</td>
                            <td><a href="#">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>abc</td>
                            <td>Indore</td>
                            <td>xxxxxx8765</td>
                            <td><a href="#">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>pqr</td>
                            <td>Indore</td>
                            <td>xxxxxx7865</td>
                            <td><a href="#">Edit</a></td>
                            <td><a href="#">Delete</a></td>
                        </tr>
                     </table>
                     <button onclick="alertDemo()">OK</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>

    <script src="alertify.js"></script>
    <script>
        function alertDemo(){
            alertify.confirm("Are you sure?",
                function(){
                    alertify.success('Saved');
                },
                function(){
                    alertify.error('Cancelled');
                });
        }
    </script>
</body>
</html>