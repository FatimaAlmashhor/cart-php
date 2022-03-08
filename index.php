<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="./dist/css/main.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <title>Products</title>
</head>

<body>
    <header class="header container">
        <div class="header-warrper flex ju-center h-full it-center ju-between">
            <div>LOGO</div>
            <a href='cart.php' class="cart-icon">
                <ion-icon name="cart-outline"></ion-icon>
            </a>
        </div>
    </header>
    <main class=" flex flex-col ">
        <h1 class="title">Projects</h1>
        <div class="w-full ">
            <div class="items-products">
                <div class="flex ">
                    <!-- list of the products -->
                    <?php 
                        session_start();

                        // include the database connection
                        include ('./controller/conn.php');
                        
                        // check if there is already cart exist 
                        if(isset($_SESSION['cart']))
                            $cart = $_SESSION['cart'];
                        else 
                            $_SESSION['cart'] = [];

                        // fetch all data
                        $sql = $con->prepare("SELECT * 
                            FROM products
                        ");

                    $sql->execute();
                    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['products'] = $rows ;


                    if(isset($_GET['cart'])){
                        // first search if the product already exist 
                        // create array to put the pty of the item inside the cart
                        // asign the cart to push the new array
                        $check = false ;
                        $index = -1 ;
                        foreach($_SESSION['cart'] as $key => $product){
                           if($product['product_id'] == trim($_GET['cart']))
                           {
                               $check = true ;
                               $existProduct = $product ;
                               $index = $key ;
                               break ;
                           }
                        }
                        if($check){
                            // increase the qty
                            $existProduct['qty'] += 1  ; 
                            $_SESSION['cart'][$index] = $existProduct ;
                        }
                        else{
                            // give me the product
                            $existProduct = [] ;
                            foreach($_SESSION['products'] as $product){
                                if($product['product_id'] == trim($_GET['cart']) ){
                                     $existProduct = $product ;
                                     break;
                                }
                                
                            }
                           
                            $existProduct['qty'] = 1  ; 
                            array_push($_SESSION['cart'] , $existProduct) ;
                        }
                    }


                    foreach( $_SESSION['products'] as $key => $products){
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
                                            <a href="?cart=
                                                <?php echo $products['product_id'] ;?>
                                                "
                                            class="btn add-to-cart">Add to cart</a>
                                        </div>
                                        <div>
                                            <h3>
                                                $
                                                <?php echo $products['product_price'] ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="filter"></div>
        </div>
    </main>
</body>

</html>