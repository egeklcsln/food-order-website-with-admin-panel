<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your username" required></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
if(isset($_POST["submit"])){
    $fullname = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    // Veri girişlerini temizleme ve güvenli hale getirme
    $fullname = htmlspecialchars($fullname);
    $username = htmlspecialchars($username);

    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$fullname', '$username', '$password')";
    $res = mysqli_query($conn, $sql);

    if ($res){
        $_SESSION['add'] = "Admin Added Successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
        exit();
    }
    else{
        $_SESSION['add'] = "Failed to Add Admin";
        header("location:".SITEURL.'admin/add-admin.php');
        exit();
    }
}
?>
