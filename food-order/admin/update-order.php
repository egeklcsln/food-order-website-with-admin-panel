<?php
include("partials/menu.php");
?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_order WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if($res && mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
        $food = htmlspecialchars($row['food'], ENT_QUOTES, 'UTF-8');
        $qty = $row['qty'];
        $price = $row['price'];
        $total = $row['total'];
        $status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
        $customer_name = htmlspecialchars($row['customer_name'], ENT_QUOTES, 'UTF-8');
        $customer_contact = htmlspecialchars($row['customer_contact'], ENT_QUOTES, 'UTF-8');
        $customer_email = htmlspecialchars($row['customer_email'], ENT_QUOTES, 'UTF-8');
        $customer_address = htmlspecialchars($row['customer_address'], ENT_QUOTES, 'UTF-8');
    } else {
        header('location:'.SITEURL.'admin/manage-order.php');
        exit;
    }
} else {
    header('Location:'.SITEURL.'admin/manage-order.php');
    exit;
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?>  value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address" cols="30" rows="10"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_address = $_POST['customer_address'];
            $customer_email = $_POST['customer_email'];

            $sql2 = "UPDATE tbl_order SET
                qty=?,
                total=?,  /* Assuming total is calculated based on price and quantity */
                status=?,
                customer_name=?,
                customer_contact=?,
                customer_email=?,
                customer_address=?
                WHERE id=?";

            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "idsssssi", $qty, $price, $status, $customer_name, $customer_contact, $customer_email, $customer_address, $id);
            $res2 = mysqli_stmt_execute($stmt2);

            if ($res2) {
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
                exit;
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Order</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
                exit;
            }
        }
        ?>
    </div>
</div>

<?php
include("partials/footer.php");
?>
