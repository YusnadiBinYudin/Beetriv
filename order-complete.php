<?php
ob_start();
session_start();
require_once "connection.php";
$email = $_SESSION['email'];
//echo $email
// $id = $_GET['product'];
$result = $conn->query("SELECT * FROM product");
$row = $result->fetch(PDO::FETCH_ASSOC);

$result1 = $conn->query("SELECT * FROM users WHERE email = '$email'");
$row1 = $result1->fetch(PDO::FETCH_ASSOC);
echo $row1['username'];
// $select = "SELECT * From PRODUCT WHERE 1";
$orderID = $conn->lastInsertId();
if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
  {
        foreach($_SESSION['cart_items'] as $item)
          {
            //$totalPrice+=$item['total_price'];
            $paramOrderDetails = [
              'product_id' =>  $item['product_id'],
              'product_name' =>  $item['product_name'],
              'product_price' =>  $item['product_price'],
              'qty' =>  $item['qty'],
              'email' => $_SESSION['email'],
              'username' => $row1['username'],
              'user_id' => $row1['user_id']
               ];
            // $test1 = [
            //     'user_id' => $row1['user_id']
            //    ];
               
            $sqlDetails = 'insert into order_details (prd_id, prd_name, prd_price, prd_qty, user_id, email, username) values(:product_id,:product_name,:product_price,:qty,:user_id,:email,:username) ';
            // $sqlDetails1 = 'insert into order_detail (user_id) values(:user_id)';

            // $orderDetailStmt = $conn->prepare($sqlDetails1);
            // $orderDetailStmt->execute($test1);

            $orderDetailStmt = $conn->prepare($sqlDetails);
            
            $orderDetailStmt->execute($paramOrderDetails);
          }
                        
          //  $updateSql = 'update orders set total_price = :total where id = :id';

            // $rs = $db->prepare($updateSql);
            // $prepareUpdate = [
            // 'total' => $totalPrice,
            // 'id' =>$getOrderID
            //  ];

            // $rs->execute($prepareUpdate);
                        
            unset($_SESSION['cart_items']);
            // $_SESSION['confirm_order'] = true;
            // header('location:thank-you.php');
            // exit();
                    }
                  
                  

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Checkout - Payment Succesful</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/user-profile.css">
  <style>
    .checkout-progress{
      margin: 80px auto;
    }

    ul{
      text-align: center;
    }
    
    ul li{
      display: inline-block;
      width: 200px;
      position: relative;
      
    }

    ul li .fas{
        background: #000;
        /* width: 8px;
        height: 8px;  */
        color: #fff;
        border-radius: 50%;
        padding: 6px;
    }

    ul li .fas::after{
      content: '';
      background: #ccc;
      height: 7px;
      width: 250px;
      display: block;
      position: absolute;
      left: 0;
      top: 10px;
      z-index: -1;
    }

    ul li:nth-child(1) .fas, 
    ul li:nth-child(2) .fas,
    ul li:nth-child(3) .fas,
    ul li:nth-child(4) .fas{
      background: #148e14;
    }

    ul li:nth-child(1) .fas::after,
    ul li:nth-child(2) .fas::after,
    ul li:nth-child(3) .fas::after,
    ul li:nth-child(4) .fas::after{
      background: #148e14;
      
    }

    ul li:first-child .fas::after{
      width: 105px;
      left: 100px;
    }

    ul li:last-child .fas::after{
      width: 105px;
    }

    .checkout-form{
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="store.php">Beetriv</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="store.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bid</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Active Bid</a></li>
                                <li><a class="dropdown-item" href="#!">Ending Soon</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end">
                    <a class="nav-item nav-link" style='color:black' aria-current="page" href="wishlist.php">
                    <i class="bi bi-heart" style='color:black'><?php echo (isset($_SESSION['wish_items']) && count($_SESSION['wish_items'])) > 0 ? count($_SESSION['wish_items']):''; ?></i>
                    <a class="nav-item nav-link" style='color:black' aria-current="page" href="cart.php">
                    <i class="bi bi-cart4" style='color:black'><?php echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']):''; ?></i>
                    <a class="nav-item nav-link" style='color:black' aria-current="page" href="user-profile.php"><i class="bi-person-circle"></i></a>
                    <a class="nav-item nav-link" style='color:black' aria-current="page" href="login.php"><i class="bi bi-box-arrow-right"></i></a>
                    </a>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="checkout-progress">
        <ul>
          <li>
            <i class="fas fa-check-circle"></i>
            <p>Shopping Cart</p>
          </li>

          <li>
            <i class="fas fa-check-circle"></i>
            <p>Place Order</p>
          </li>

          <li>
            <i class="fas fa-check-circle"></i>
            <p>Pay</p>
          </li>

          <li>
            <i class="fas fa-check-circle"></i>
            <p><b>Order Completed</b></p>
          </li>
        </ul>
      </div>

      <div class="text-center">
          <h3>Your order has been submitted.</h3>
      </div>


          <br><br>

        <!-- Footer-->
        <footer class="site-footer">

            <div class="container">
                <div class="row">
                <!-- first section -->
                <div class="col-xs-6 col-md-3">
                    <h6>CORPORATE</h6>
                    <ul class="footer-links">
                        <li><a href="footer/about.php">About Beetriv</a></li>
                        <li><a href="footer/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="footer/termsco.php">Terms and Conditions</a></li>
                    </ul>
                </div>

                <!-- second section -->
                <div class="col-xs-6 col-md-3">
                    <h6>DEALS, PAYMENT & DELIVERY</h6>
                    <ul class="footer-links">
                        <li><a href="footer/deals.php">Our Deals</a></li>
                        <li><a href="footer/delivery.php">Delivery Services</a></li>
                        <li><a href="footer/payment.php">Payment</a></li>
                    </ul>
                </div>

                <!-- third section -->
                <div class="col-xs-6 col-md-3">
                    <h6>CUSTOMER CARE</h6>
                    <ul class="footer-links">
                        <li><a href="footer/be-seller.php">Become Our Seller</a></li>
                        <li><a href="footer/buy-guides.php">How to Buy on Beetriv</a></li>
                        <li><a href="footer/sell-guides.php">How to Sell on Beetriv</a></li>
                        <li><a href="footer/bid-guides.php">How Bidding Works</a></li>
                        <li><a href="footer/customer-protection.php">Customer Protection</a></li>
                        <li><a href="footer/faq.php">FAQ</a></li>
                    </ul>
                </div>

                <!-- fourth section -->
                <div class="col-xs-6 col-md-3">
                    <h6>CONTACT US</h6>
                    <p>Phone: 257 3663</p>
                    <p>Email: beetrivteam@gmail.com</p>
                    <p>Instagram: @beetriv</p>
                    <p>Facebook: @beetriv</p>
                </div>
              </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>