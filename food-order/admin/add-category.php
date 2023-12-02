<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title" required></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No" required>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No" required>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $featured = mysqli_real_escape_string($conn, $_POST['featured']);
            $active = mysqli_real_escape_string($conn, $_POST['active']);

            // Dosya yükleme işlemi
            $image_name = "";
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                if($image_name != ""){
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "Food_category" . rand(0, 9999) . "." . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = '../images/category/' . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                    }
                }
            }

            $sql = "INSERT INTO tbl_category (title, image_name, featured, active) 
                    VALUES ('$title', '$image_name', '$featured', '$active')";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php
include('partials/footer.php');
?>
