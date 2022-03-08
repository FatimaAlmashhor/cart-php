<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="./dist/css/main.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <title>Cart</title>
</head>
<body>
    <header class="header container">
        <div class="header-warrper flex ju-center h-full it-center ju-between">
            <div>LOGO</div>
            <a href='/cart' class="cart-icon">
            <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
        </div>
    </header>
    <main class='main'>
        <h1>Cart </h1> 
        <div class='flex'>
            <div class='total_section'>
                <h3>Totla</h3>
            </div>
            <div class=''>
                <?php 
                    session_start();
                    // deletion
                    if(isset($_GET['delete'])){
                        $index = trim($_GET['delete']) ;
                        unset($_SESSION['cart'][$index]);
                    }

                    if(isset($_GET['qty'])){
                        if(isset($_GET['index'])) {
                            $index = trim($_GET['index']);
                            $qty = $_SESSION['cart'][$index]['qty'];
                            $product_qty = $_SESSION['cart'][$index]['product_qty'] ;
                            print_r( $product_qty);
                            if($_GET['qty'] == 'inc'){
                                if($product_qty > $qty){
                                    $qty += 1;
                                }
                            }
                            else if($_GET['qty'] == 'dec'){
                                if($qty > 1)
                                    $qty -= 1;
                            }
                            $_SESSION['cart'][$index]['qty']= $qty ;
                        }
                        
                    }
                    foreach( $_SESSION['cart'] as $key => $products){
                        // print_r($key)
                        ?>
                            <div class="project_cart">
                                <div class="project_cart_warpper">
                                    <div class="product_image">
                                        <div class="product_image_warrper">
                                            <img src="https://images.pexels.com/photos/3018845/pexels-photo-3018845.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                alt="product" />
                                        </div>
                                    </div>
                                    <div class="product_content flex ju-between">
                                        <div class='left'>
                                            <h3><?php echo $products['product_title'] ?></h3>
                                            <p class="product_content_des">
                                                <?php echo $products['product_des'] ?>
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                            </p>
                                            <a href="cart.php?delete=
                                                <?php echo $key ;?>
                                                "
                                            class="btn add-to-cart">Delete</a>
                                        </div>
                                        <div>
                                            <h3>
                                                $
                                                <?php echo $products['product_price'] ?>
                                            </h3>
                                            <p>
                                                <?php 
                                                    echo $products['qty'] ;
                                                ?>
                                                <a href='cart.php?qty=inc&index=
                                                        <?php echo $key ;?>
                                                '> + </a>
                                                <a href='cart.php?qty=dec&index=
                                                        <?php echo $key ;?>
                                                '> - </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
</body>
</html>