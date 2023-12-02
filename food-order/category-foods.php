<?php
include('partials-front/menu.php');

if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']); // Kategori ID'sini güvenli hale getirme
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $category_title = htmlspecialchars($row['title']); // XSS önleme
    } else {
        header('location:' . SITEURL); // SQL sorgusunda hata olursa ana sayfaya yönlendirme
        exit();
    }
} else {
    header('location:' . SITEURL);
    exit();
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = htmlspecialchars($row2['id']); // XSS önleme
                    $title = htmlspecialchars($row2['title']); // XSS önleme
                    $price = htmlspecialchars($row2['price']); // XSS önleme
                    $description = htmlspecialchars($row2['description']); // XSS önleme
                    $image_name = htmlspecialchars($row2['image_name']); // XSS önleme
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error'>Food not Available.</div>";
            }
        } else {
            echo "<div class='error'>Error in SQL query.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
