<?php include('partials/menu.php'); ?>

<section class="product-search text-center">
    <div class="container">          
        <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for product.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<?php 
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore products</h2>
        <?php 
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?> 
                    <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name==""){
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else{
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
            }
            else{
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<section class="product-menu">
    <div class="container">
        <h2 class="text-center">product Menu</h2>
        <?php          
        $sql2 = "SELECT * FROM product WHERE active='Yes' AND featured='Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if($count2>0)
        {
            while($row=mysqli_fetch_assoc($res2))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="product-menu-box">
                    <div class="product-menu-img">
                        <?php 
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
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
                        <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>product not available.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="#">See All products</a>
    </p>
</section>
<?php include('partials/footer.php'); ?>