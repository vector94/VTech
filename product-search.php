<?php include('partials/menu.php'); ?>

<section class="product-search text-center">
    <div class="container">
        <?php 
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>
        <h2>Products on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>

<section class="product-menu">
    <div class="container">
        <h2 class="text-center">Product Menu</h2>
        <?php 
            $sql = "SELECT * FROM product WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="product-menu-box">
                        <div class="product-menu-img">
                            <?php 
                                if($image_name==""){
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php 
                                }
                            ?>
                        </div>
                        <div class="product-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="product-price">$<?php echo $price; ?></p>
                            <p class="product-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else{
                echo "<div class='error'>product not found.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials/footer.php'); ?>