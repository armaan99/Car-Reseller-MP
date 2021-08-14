<?php 

    session_start();

    if(!isset($_SESSION["Admin"])){
        echo("<script> window.location.href='/carresellerMP/AdminLogin.php'; </script>");
    }

    if(isset($_POST["btnLogout"])){
        session_unset();
        session_destroy();
        echo("<script> window.location.href='/carresellerMP/Index.php'; </script>");
    }

?>

<div class="NavBar">
    <div class="logo">
        <h2>User Reseller MP</h2>
    </div>
    <div class="menu">
        <?php 
            if(isset($_SESSION["Admin"])){
                ?>
                <p style="display: inline;">Welcome <?php echo $_SESSION["Admin"]["name"]; ?> &nbsp;
                    <form action="navbar.php" method="POST"  style="display: inline;">
                        <input type="submit" value="Logout" name="btnLogout">
                    </form>
                </p>
                <?php 
            }
        ?>
    </div>
</div>