<?php
session_start();
require_once "connection.php";

// Get image data from database
$result = "SELECT * FROM product";
$handle = $conn->prepare($result);
$handle->execute();
$row = $handle->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/footer.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
        * {box-sizing: border-box;}
        body {font-family: Verdana, sans-serif;}
        .mySlides {display: none;}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
        }

        /* The dots/bullets/indicators */
        .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
        margin-bottom: 50px;
        }

        .active {
        background-color: #717171;
        }

        /* Fading animation */
        .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
        from {opacity: .4}
        to {opacity: 1}
        }

        @keyframes fade {
        from {opacity: .4}
        to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
        .text {font-size: 11px}
        }

        /* Product Display */

        body{
      margin: 0;
      font-family:Nunito Sans;
      }
      h3{
      text-align: left;
      font-size: 30px;
      margin: 0;
      padding-top: 10px;
      padding-left: 20px;
      }
      a{
      text-decoration: none;
      }
      .product{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      justify-content: center;
      align-items: center;
      margin: 20px 0;
      }
      .content{
      width: 15%;
      margin: 10px;
      box-sizing: border-box;
      float: left;
      text-align: center;
      border-radius:10px;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      padding-top: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: .4s;
      }
      .content:hover{
      box-shadow: 0 0 11px rgba(33,33,33,.2);
      transform: translate(0px, -8px);
      transition: .6s;
      }
      img{
      width: 150px;
      height: 150px;
      text-align: center;
      margin: 0 auto;
      display: block;
      }
      h6{
      font-size: 26px;
      text-align: left;
      color: #222f3e;
      margin: 0;
      padding-left: 20px;
      }
      ul{
      list-style-type: none;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0px;
      }
      li{
      padding: 5px;
      }
      .fa{
      color: #ff9f43;
      font-size: 26px;
      transition: .4s;
      }
      .fa:hover{
      transform: scale(1.3);
      transition: .6s;
      }
      button{
      text-align: center;
      font-size: 24px;
      color: #000000;
      width: 100%;
      padding: 15px;
      border:0px;
      outline: none;
      cursor: pointer;
      margin-top: 5px;
      border-bottom-right-radius: 10px;
      border-bottom-left-radius: 10px;
      }
      .buy-prd{
      background-color: #fae29c;
      font-size: 20px;
      }

      .prd-div {
        margin-top: 10px;
        margin-left: 80px;
        padding-left: 20px;
      }

      @media(max-width: 1000px){
      .content{
      width: 46%;
      }
      }
      @media(max-width: 750px){
      .content{
      width: 100%;
      }
      }

      .product a{
          color: #bda55a;
      }

        </style>
        <title>Beetriv</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Search bar -->
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/user-profile.css">
        <link rel="stylesheet" href="css/about.css">

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" style='color:black' > 
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="store.php">Beetriv</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="store.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
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
                    <li><a class="nav-item nav-link" style='color:black' aria-current="page" href="wishlist.php">
                    <i class="bi bi-heart" style='color:black'><?php echo (isset($_SESSION['wish_items']) && count($_SESSION['wish_items'])) > 0 ? count($_SESSION['wish_items']):''; ?></i>
                    <li><a class="nav-item nav-link" style='color:black' aria-current="page" href="user-profile.php"><i class="bi-person-circle"></i></a></li>
                    <li><a class="nav-item nav-link" style='color:black' aria-current="page" href="cart.php">
                    <i class="bi bi-cart4" style='color:black'><?php echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']):''; ?></i>
                    <li><a class="nav-item nav-link" style='color:black' aria-current="page" href="login.php"><i class="bi bi-box-arrow-right"></i></a></li>
                    </a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- header -->
        <div class="page-header">
            <div class="container">
                    <div class="col-12 pt-5">
                        <h2>About Us</h2>
                    </div>
                    <div class="col-12">
                        <a href="store.php">Home</a>
                        <a href="about.php">About Us</a>
                        <div class="about">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-6">
                                    <div class="about-img">
                                        <img src="img/about.jpg" alt="Image">
                                        </div>
                                        </div>
                                            <!-- Content -->
                                            <div class="col-lg-5 col-md-5">
                                            <div class="section-header text-left">
                                            <h2>Beetriv</h2>
                                            </div>
                                            <div class="about-text">
                                            <p>Beetriv is a marketplace in Brunei Darussalam that allows users to sell and buy as easy as taking a photo and as simple as chatting.</p>
                                            <p>Beetriv has a diverse range of products across a variety of categories such as fashion, home and living,cars,gadgets as well as lifestyle.</p>
                                            <a class="btn" href="">Learn More</a>
                                        </div>               
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beetriv Member -->
            <div class="team">
                        <div class="container">
                            <div class="section-header text-center">
                                <p>Introducing</p>
                                <h2>Beetriv Member</h2>
                            </div>
                            <div class="d-flex justify-content-center row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="team-item">
                                        <div class="team-img">
                                            <img src="img/team-1.jpg" alt="Team Image">
                                        </div>
                                        <div class="team-text">
                                            <h2>Azimah</h2>
                                            <p>Leader of Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="team-item">
                                        <div class="team-img ">
                                            <img src="img/team-2.png" alt="Team Image">
                                        </div>
                                        <div class="team-text">
                                            <h2>Afiqah</h2>
                                            <p>Master Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-2 col-md-6">
                                    <div class="team-item">
                                        <div class="team-img">
                                            <img src="img/team-3.jpg" alt="Team Image">
                                        </div>
                                        <div class="team-text">
                                            <h2>Yusnadi</h2>
                                            <p>Expert Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="team-item">
                                        <div class="team-img">
                                            <img src="img/team-4.jpg" alt="Team Image">
                                        </div>
                                        <div class="team-text">
                                            <h2>Haziq</h2>
                                            <p>Professional Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
        <!-- Footer-->
        <footer class="site-footer">

            <div class="container">
                <div class="row">
                <!-- first section -->
                <div class="col-xs-6 col-md-3">
                    <h6>CORPORATE</h6>
                    <ul class="footer-links">
                        <li><a href="about.php">About Beetriv</a></li>
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

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>