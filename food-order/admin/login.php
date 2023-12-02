<?php include("../config/constants.php"); ?>
<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/adm.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>
        
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <p class="text-center">Created By - <a style="color: blue;" href="https://www.linkedin.com/in/egeklcsln/">Ege Kılıçaslan Şalk</a></p>
    </div>

</body>
</html>
<?php

if(isset($_POST['submit'])){
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = md5($_POST["password"]);

    $sql = "SELECT * FROM tbl_admin WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    $count = mysqli_num_rows($res);
    
    if($count == 1){
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $user;
        header('location:'.SITEURL.'admin/');
    }
    else{
        $_SESSION['login'] = "<div class='error'>Username or Password Did not Match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

    mysqli_stmt_close($stmt);
}

?>
