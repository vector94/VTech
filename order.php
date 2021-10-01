<?php include('partials/menu.php'); ?>
    <?php 
        if(isset($_GET['product_id'])){
            $product_id = $_GET['product_id'];
            $sql = "SELECT * FROM product WHERE id=$product_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else{
                header('location:'.SITEURL);
            }
        }
        else{
            header('location:'.SITEURL);
        }
    ?>

    <section class="product-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected product</legend>
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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="product" value="<?php echo $title; ?>">
                        <p class="product-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Asif Ahmed" class="input-responsive" required>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +88016xxxxxxxx" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. asif.ahmed2@northsouth.edu" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $product = $_POST['product'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered"; 
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $sql2 = "INSERT INTO order_list SET 
                        product = '$product',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2==true){
                        $_SESSION['order'] = "<div class='success text-center'>product Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order product.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>
        </div>
    </section>
    
    <?php include('partials/footer.php'); ?>