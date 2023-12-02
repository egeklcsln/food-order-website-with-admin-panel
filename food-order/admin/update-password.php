<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
            $id=$_GET['id'];
        ?>
        
        <form action="" method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="cur_pass" placeholder="Current Password"> </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_pass" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_pass" placeholder="Confirm Password"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $current_pass = md5($_POST["cur_pass"]);
        $new_pass = md5($_POST["new_pass"]);
        $con_pass = md5($_POST["confirm_pass"]);
        
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pass'";
        $res=mysqli_query($conn,$sql);
        if($res==True){
            $count=mysqli_num_rows($res);
            if($count==1){
                if($new_pass==$con_pass){
                    $sql2="UPDATE tbl_admin SET password=' $new_pass'
                    where id=$id";
                    $res2=mysqli_query($conn,$sql2);
                    if($res2==True){
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully.</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change-pwd']="<div class='error'>Failed to Change Password.</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }

                }
                else{
                    $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Patch.</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }

                
            }
            else{
                    $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
            }
             }
        
    }

?>



<?php
include("partials/footer.php");
?>