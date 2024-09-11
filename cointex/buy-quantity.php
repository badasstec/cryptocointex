<?php
session_start();

// Check if the user is logged in and is a client, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'client') {
    header("location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themesflat.co/html/cointexcrypto/cointex/buy-quantity.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 22:10:56 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">

    <!-- font -->
    <link rel="stylesheet" href="fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="fonts/font-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet"type="text/css" href="css/styles.css"/>

   
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/48.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo/48.png" />

    <title>buy quantity</title>
</head>

<body>
    <?php
    include"total.php";
    
    ?>

    <!-- preloade -->
    <div class="preload preload-container">
      <div class="preload-logo" style="background-image: url('images/logo/144.png')">
          <div class="spinner"></div>
      </div>
    </div>
    <!-- /preload --> 

    <div class="header fixed-top bg-surface d-flex justify-content-between align-items-center">
        <a href="javascript:void(0);" class="left back-btn"><i class="icon-left-btn"></i></a>
        <a href="sell-quantity.html" class="right">Send</a>
    </div>
    <div class="pt-45 pb-16">
        <div class="tf-container">
          <div class="mt-4 coin-item style-2 gap-8">
            <img src="images/logo/144.png" alt="img" class="img">
            <h5>send cryptocurency</h5>
          </div>
          <div class="mt-16 d-flex justify-content-between">
            <span>I want to send</span>
            <span class="text-primary d-flex align-items-center gap-4">By quantity <i class="icon-leftRight"></i></span>
          </div>
          <div class="mt-8 group-ip-select">
                <input type="text" placeholder="Please enter wallet address">
                <div class="select-wrapper">
                    <select class="tf-select">
                        <option value="">choose-crypto</option>
                        <option value="">BTC</option>
                        <option value="">ETH</option>
                        <option value="">BNB</option>
                        <option value="">USDT</option>
                    </select>
                </div>  
          </div>

          <div class="mt-8 group-ip-select">
            <input type="text" placeholder="Please enter wallet address">
            <div class="select-wrapper">
                 <select class="tf-select">
                    <option hidden value=""></option>
                    <option hidden value="">BTC</option>
                </select>
            </div>  
      </div> 
          <p class="mt-8"><?php echo " $" . number_format($total, 1); ?> </p>
          <a href="choose-payment.html" class="tf-btn lg primary mt-40">Buy</a>
        </div>
    </div>

    





    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    
</body>

<!-- Mirrored from themesflat.co/html/cointexcrypto/cointex/buy-quantity.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 22:10:56 GMT -->
</html>