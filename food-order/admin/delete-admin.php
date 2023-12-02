<?php
include('../config/constants.php');

// ID'nin varlığını ve numerik olup olmadığını kontrol etmek için is_numeric kullanılır
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Güvenlik: SQL enjeksiyonlarına karşı koruma için mysqli_real_escape_string kullanılır
    $id = mysqli_real_escape_string($conn, $id);

    // SQL sorgusu güncellendi
    $sql = "DELETE FROM tbl_admin WHERE id='$id'";
    $res = mysqli_query($conn, $sql);

    if($res == true) {
        $_SESSION["delete"] = "<div class='success'>Admin Deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION["delete"] = "<div class='error'>Failed to Delete Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
} else {
    // ID geçerli bir sayı değilse ya da hiçbir şekilde belirtilmemişse, hata mesajı görüntüle ve yönlendir
    $_SESSION["delete"] = "<div class='error'>Invalid or missing ID parameter.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>
