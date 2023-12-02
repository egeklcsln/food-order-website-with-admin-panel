<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br />
        <br />

        <?php
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($res);
            $sn = 1;
            
            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $food = htmlentities($row['food'], ENT_QUOTES, 'UTF-8');
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $orderdate = $row['order_date'];
                    $status = htmlentities($row['status'], ENT_QUOTES, 'UTF-8');
                    $customer_name = htmlentities($row['customer_name'], ENT_QUOTES, 'UTF-8');
                    $customer_contact = htmlentities($row['customer_contact'], ENT_QUOTES, 'UTF-8');
                    $customer_email = htmlentities($row['customer_email'], ENT_QUOTES, 'UTF-8');
                    $customer_address = htmlentities($row['customer_address'], ENT_QUOTES, 'UTF-8');
                    ?>

                    <tr>
                        <td><?php echo $sn++;?></td> 
                        <td><?php echo $food;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $orderdate;?></td>
                        <td><?php
                            if($status == "Ordered"){
                                echo "<label>$status</label>";
                            }
                            elseif($status == "On Delivery"){
                                echo "<label style='color:orange;'>$status</label>";
                            }
                            elseif($status == "Delivered"){
                                echo "<label style='color:green;'>$status</label>";
                            }
                            elseif($status == "Cancelled"){
                                echo "<label style='color:red;'>$status</label>";
                            }
                            ?></td>
                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $customer_contact;?></td>
                        <td><?php echo $customer_email;?></td>
                        <td><?php echo $customer_address;?></td>
                        <td> 
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td> 
                    </tr>

                    <?php
                }
            }
            else{
                echo "<tr><td colspan='12' class='error'>Orders not Available.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
