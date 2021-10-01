<?php include('partials/menu.php'); ?>

<section class="product-search text-center">
    <div class="container">        
        <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for product.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="product-menu">
    <div class="container">
        <h2 class="text-center">Product Menu</h2>
        <?php 
            $sql = "SELECT * FROM product WHERE active='Yes'";
            $res=mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
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
                            <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else{
                echo "<div class='error'>Product not found.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials/footer.php'); ?>