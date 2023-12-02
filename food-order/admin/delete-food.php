<?php
include('../config/constants.php');

// ID ve image_name'nin varlığını ve numerik olup olmadığını kontrol etmek için is_numeric kullanılır
if(isset($_GET['id']) AND isset($_GET['image_name']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Güvenlik: SQL enjeksiyonlarına karşı koruma için mysqli_real_escape_string kullanılır
    $id = mysqli_real_escape_string($conn, $id);
    $image_name = mysqli_real_escape_string($conn, $image_name);

    if($image_name != "") {
        $path = "../images/food/".$image_name;
        $remove = unlink($path);

        if($remove == false){
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
            header("location:".SITEURL.'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id='$id'";
    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION["delete"] = "<div class='success'>Food Deleted Successfully.</div>";
        header("location:".SITEURL.'admin/manage-food.php');
    } else {
        $_SESSION["delete"] = "<div class='error'>Failed to Delete Food.</div>";
        header("location:".SITEURL.'admin/manage-food.php');
    }
} else {
    // ID geçerli bir sayı değilse ya da hiçbir şekilde belirtilmemişse, hata mesajı görüntüle ve yönlendir
    $_SESSION["delete"] = "<div class='error'>Invalid or missing ID parameter.</div>";
    header("location:".SITEURL.'admin/manage-food.php');
}
?>
