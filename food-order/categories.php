<?php
include('partials-front/menu.php');

$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
$res = mysqli_query($conn, $sql);

?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        if ($res) {
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = htmlspecialchars($row['id']); // XSS önleme
                    $title = htmlspecialchars($row['title']); // XSS önleme
                    $image_name = htmlspecialchars($row['image_name']); // XSS önleme
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Found.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<div class='error'>No active categories found.</div>";
            }
        } else {
            echo "<div class='error'>Error in SQL query.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
