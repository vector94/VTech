<?php include('partials/menu.php'); ?>

<?php 
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else{
        header('location:'.SITEURL);
    }
?>
<section class="product-search text-center">
    <div class="container">          
        <h2>products on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">product Menu</h2>
        <?php         
            $sql2 = "SELECT * FROM product WHERE category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0){
                while($row2=mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
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
                echo "<div class='error'>product not Available.</div>";
            }     
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials/footer.php'); ?>