<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br/>
        <br/>

        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br/>
        <br/>
        <br/>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']); 
        } 
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']); 
        } 
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']); 
        } 
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); 
        } 
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']); 
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']); 
        }
        if(isset($_SESSION['no-food-found'])){
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']); 
        }
        ?>
        
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sn=1;
            $sql = "SELECT * FROM tbl_food";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($res);
            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = htmlentities($row['title'], ENT_QUOTES, 'UTF-8');
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = htmlentities($row['featured'], ENT_QUOTES, 'UTF-8');
                    $active = htmlentities($row['active'], ENT_QUOTES, 'UTF-8');
                    ?>
                    <tr>
                        <td><?php echo $sn++;?>  </td> 
                        <td><?php echo $title; ?></td> 
                        <td><?php echo $price; ?></td> 
                        <td>
                            <?php
                            if($image_name!=""){
                                ?>
                                <img src="<?php echo SITEURL?>images/food/<?php echo htmlentities($image_name, ENT_QUOTES, 'UTF-8');?>" width="100px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td> 
                            <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td> 
                    </tr>
                    <?php
                }
            }
            else{
                echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
