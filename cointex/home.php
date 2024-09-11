<?php
session_start();

// Check if the user is logged in and is a client, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'client') {
    header("location: log-in.php");
    exit;
}


?>

<?php
require_once "../config.php";


// $sql = "SELECT id, username, email, password, bitcoin, ethereum, bnb, usdt, created_at FROM crypto ORDER BY created_at DESC";
// $stmt = $link->prepare($sql);
// $stmt->execute();
// $result = $stmt->get_result();
?>




<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themesflat.co/html/cointexcrypto/cointex/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 22:10:33 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <!-- font -->
    <link rel="stylesheet" href="fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="fonts/font-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet"type="text/css" href="css/styles.css"/>

   
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/48.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo/48.png" />

    <title>home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="fonts/font-icons.css">
    <link rel="shortcut icon" href="images/logo/48.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo/48.png" />
</head>

<body>
     <!-- preloade -->
     <div class="preload preload-container">
        <div class="preload-logo" style="background-image: url('images/logo/144.png')">
          <div class="spinner"></div>
        </div>
      </div>
      <!-- /preload --> 

 


      <div class="header-style2 fixed-top bg-menuDark">
        <div class="d-flex justify-content-between align-items-center">
            <a class="box-account" href="user-info.php">
                <img src="images/avt/avt2.jpg" alt="img" class="avt">
                <div class="info">
                    <p class="text-xsmall text-secondary">Welcome back!</p>
                    <h5 class="mt-4"><?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
                    <?php
include"total.php";
?>
                </div>
            </a>
            <div class="d-flex align-items-center gap-8">
                <a href="choose-cryptocurrency.html" class="icon-search"></a>
                <a href="#notification" class="icon-noti box-noti" data-bs-toggle="modal"></a>
            </div>
        </div>
    </div>
    <div class="pt-68 pb-80">
    <!-- Wallet Section -->
    <div class="bg-menuDark tf-container">
        <div class="pt-12 pb-12 mt-4">
            <h5>
                <span class="text-primary">My Wallet</span> - 
                <a href="#" class="choose-account" data-bs-toggle="modal" data-bs-target="#accountWallet">
                    <span class="dom-text">Account 1 </span> &nbsp;<i class="icon-select-down"></i>
                </a>
            </h5>
            <h1 class="mt-16"><a href="#"><?php echo " Btc  " . number_format($total, 3); ?></a></h1>
            <ul class="mt-16 grid-3 m--16">
                <li>
                    <a href="buy-quantity.php" class="tf-list-item d-flex flex-column gap-8 align-items-center">
                        <span class="box-round bg-surface d-flex justify-content-center align-items-center"><i class="icon icon-way"></i></span>
                        Send
                    </a>
                </li>
                <li>
                    <a href="qr-code2.html" class="tf-list-item d-flex flex-column gap-8 align-items-center">
                        <span class="box-round bg-surface d-flex justify-content-center align-items-center"><i class="icon icon-way2"></i></span>
                        Receive
                    </a>
                </li>
                <li>
                    <a href="https://www.paxful.com" class="tf-list-item d-flex flex-column gap-8 align-items-center">
                        <span class="box-round bg-surface d-flex justify-content-center align-items-center"><i class="icon icon-wallet"></i></span>
                        Buy
                    </a>
                </li>
                <!-- <li>
                    <a href="earn.html" class="tf-list-item d-flex flex-column gap-8 align-items-center">
                        <span class="box-round bg-surface d-flex justify-content-center align-items-center"><i class="icon icon-exchange"></i></span>
                        Earn
                    </a>
                </li> -->
            </ul>
        </div>
    </div>

    <!-- Market Section -->
    <div class="bg-menuDark tf-container">
        <div class="pt-12 pb-12 mt-2">
            <h5>Market</h5>
            <div class="swiper tf-swiper mt-16">
                <div class="swiper-wrapper" id="crypto-market">
                    <!-- Dynamically inserted slides will go here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Asset Section -->
    <div class="bg-menuDark tf-container">
        <div class="pt-12 pb-12 mt-4">
            <div class="wrap-filter-swiper">
                <h5>
                    <a href="cryptex-rating.html" class="cryptex-rating"><i class="icon-star"></i>Asset</a>
                </h5>
                <div class="swiper-wrapper1 menu-tab-v3 mt-12" role="tablist">
                    <div class="swiper-slide1 nav-link active" data-bs-toggle="tab" data-bs-target="#favorites" role="tab" aria-controls="favorites" aria-selected="true">
                        Coins    
                    </div>
                    <div class="swiper-slide1 nav-link" data-bs-toggle="tab" data-bs-target="#new" role="tab" aria-controls="new" aria-selected="false">
                        NFT    
                    </div>
                </div>
            </div>

            <div class="tab-content mt-8">
                <div class="tab-pane fade show active" id="favorites" role="tabpanel">
                    <!-- <div class="d-flex justify-content-between">
                        Name
                        <p class="d-flex gap-8">
                            <span>Last price</span>
                            <span>Change</span>
                        </p>
                    </div>
                    <h5 class="mt-12">Popular search</h5> -->
            <ul class="mt-16">
                <li>
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-3.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Ethereum</p>
                                <span class="text-secondary text-small">ETH</span>
                            </div>
                            <span class="text-small"><?php echo $ethereum = $_SESSION["ethereum"]; ?></span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-1.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Bitcoin</p>
                                <span class="text-secondary text-small">BTC</span>
                            </div>
                            <span class="text-small"><?php echo $bitcoin = $_SESSION["bitcoin"]; ?></span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-14.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">TetherUS</p>
                                <span class="text-secondary text-small">USDT</span>
                            </div>
                            <span class="text-small"><?php echo $usdt = $_SESSION["usdt"]; ?></span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-7.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">BNB</p>
                                <span class="text-secondary text-small">BNB</span>
                            </div>
                            <span class="text-small"><?php echo $bnb = $_SESSION["bnb"]; ?></span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-9.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Ripple</p>
                                <span class="text-secondary text-small">XRP</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-4.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Cardano</p>
                                <span class="text-secondary text-small">ADA</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-11.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">BUSD</p>
                                <span class="text-secondary text-small">BUSD</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-8.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">trueUSD</p>
                                <span class="text-secondary text-small">TUSD</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-5.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Coin98</p>
                                <span class="text-secondary text-small">C98</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
                <li class="mt-16">
                    <a href="#" class="coin-item style-2 gap-12">
                        <img src="images/coin/coin-6.jpg" alt="img" class="img">
                        <div class="content">
                            <div class="title">
                                <p class="mb-4 text-large">Kurama</p>
                                <span class="text-secondary text-small">KRM</span>
                            </div>
                            <span class="text-small">0</span>
                        </div>
                    </a>
                </li>
            </ul>
            
        </div>
    </div>
                </div>

                <div class="tab-pane fade" id="new" role="tabpanel">
                    <div class="d-flex justify-content-between">
                        Name
                        <p class="d-flex gap-8">
                            <span>Last price</span>
                            <span>Change</span>
                        </p>
                    </div>
                    <ul class="mt-16">
                        <li>
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-6.jpg" alt="ETH" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">ETH</p>
                                        <span class="text-secondary">$360.6M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$1,878.80</span>
                                        <span class="coin-btn decrease">-1.62%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mt-16">
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-7.jpg" alt="arb_ETH" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">arb_ETH</p>
                                        <span class="text-secondary">$132.18M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$1,878.80</span>
                                        <span class="coin-btn increase">+1.62%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mt-16">
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-8.jpg" alt="WBTC" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">WBTC</p>
                                        <span class="text-secondary">$50.56M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$30,001.96</span>
                                        <span class="coin-btn decrease">-1.64%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mt-16">
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-3.jpg" alt="ARB" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">ARB</p>
                                        <span class="text-secondary">$31.55M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$1.11</span>
                                        <span class="coin-btn increase">+3.71%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mt-16">
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-9.jpg" alt="WETH" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">WETH</p>
                                        <span class="text-secondary">$24.34M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$1,878.56</span>
                                        <span class="coin-btn decrease">-1.62%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mt-16">
                            <a href="choose-payment.html" class="coin-item style-2 gap-12">
                                <img src="images/coin/coin-10.jpg" alt="MATIC" class="img">
                                <div class="content">
                                    <div class="title">
                                        <p class="mb-4 text-button">MATIC</p>
                                        <span class="text-secondary">$19.36M</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-12">
                                        <span class="text-small">$0.666</span>
                                        <span class="coin-btn decrease">-4.42%</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    
    <div class="menubar-footer footer-fixed">
        <ul class="inner-bar">
            <li class="active">
                <a href="home.php">
                    <i class="icon icon-home2"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="exchange-trade.html">
                    <i class="icon icon-exchange"></i>
                    Exchange
                </a>
            </li>
            <li>
                <a href="https://www.google.com">
                    <i class="icon icon-globe"></i>
                    Dapp
                </a>
            </li>
            <li>
                <a href="wallet.html">
                    <i class="icon icon-history"></i>
                    History
                </a>
            </li>
        </ul>
    </div>

    <!-- account -->
    <div class="modal fade action-sheet" id="accountWallet">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Wallet</span>
                    <span class="icon-cancel" data-bs-dismiss="modal"></span>
                </div>
                <ul class="mt-20 pb-16">
                    <li data-bs-dismiss="modal"><div class="d-flex justify-content-between align-items-center gap-8 text-large item-check active dom-value">Account 1 <i class="icon icon-check-circle"></i> </div></li>
                    <li class="mt-4" data-bs-dismiss="modal"><a href="../cointex/register.php" class="d-flex  justify-content-between gap-8 text-large item-check dom-value">Account 2<i class="icon icon-check-circle"></i></a></li>
                </ul>
            </div>
            
        </div>
    </div>
 
    <!-- notification -->
    <div class="modal fade modalRight" id="notification">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="header fixed-top bg-surface d-flex justify-content-center align-items-center">
                    <span class="left" data-bs-dismiss="modal"  aria-hidden="true"><i class="icon-left-btn"></i></span>
                    <h3>Notification</h3>
                </div>
                <div class="overflow-auto pt-45 pb-16">
                    <div class="tf-container">
                        <ul class="mt-12">
                            <li>
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt d-flex">
                                        <p class="text-button fw-6">Cointex to just tick size and trading amount precision of spots/margins and perpetual swaps</p>
                                        <i class="dot-lg bg-primary"></i>
                                    </div>
                                    <span class="d-block mt-8">5 minutes ago</span>
                                </a>
                            </li>
                            <li class="mt-12">
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt d-flex">
                                        <p class="text-button fw-6">Cointex to adjust components of several indexes</p>
                                        <i class="dot-lg bg-primary"></i>
                                    </div>
                                    <span class="d-block mt-8">5 minutes ago</span>
                                </a>
                            </li>
                            <li class="mt-12">
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt d-flex">
                                        <p class="text-button fw-6">Cointex to just tick size and trading amount precision of spots/margins and perpetual swaps</p>
                                        <i class="dot-lg bg-primary"></i>
                                    </div>
                                    <span class="d-block mt-8">5 minutes ago</span>
                                </a>
                            </li>
                            <li class="mt-12">
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt">
                                        <p class="text-button fw-6 text-secondary">Cointex to adjust components of several indexes</p>
                                    </div>
                                    <span class="d-block mt-8 text-secondary">1 day ago</span>
                                </a>
                            </li>
                            <li class="mt-12">
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt">
                                        <p class="text-button fw-6 text-secondary">Cryptex wallet uses Achain network service</p>
                                    </div>
                                    <span class="d-block mt-8 text-secondary">1 day ago</span>
                                </a>
                            </li>
                            <li class="mt-12">
                                <a href="#" class="noti-item bg-menuDark">
                                    <div class="pb-8 line-bt">
                                        <p class="text-button fw-6 text-secondary">Cointex to adjust components of several indexes</p>
                                    </div>
                                    <span class="d-block mt-8 text-secondary">1 day ago</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    <!-- noti popup -->
    <div class="modal fade modalCenter" id="modalNoti">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content modal-sm">
              <div class="p-16 line-bt text-center">
                  <h4>“Cointex” Would Like To Send You Notifications</h4>
                  <p class="mt-8 text-large">Notifications may include alerts, sounds, and icon badges. These can be configured in Settings.</p>
              </div>
              <div class="grid-2">
                 <a href="#" class="line-r text-center text-button fw-6 p-10 text-secondary btn-hide-modal" data-bs-dismiss="modal" >Don’t Allow</a>
                 <a href="#" class="text-center text-button fw-6 p-10 text-primary btn-hide-modal"  data-bs-toggle="modal" data-bs-target="#notiPrivacy"> Allow</a> 
              </a>
              </div>
           </div>
        </div>
    </div>

    <!-- noti popup 2-->
    <div class="modal fade modalCenter" id="notiPrivacy">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-20">
             <div class="heading">
              <h3>Privacy</h3>
              <div class="mt-4 text-small">
                  <p>A mobile app privacy policy is a legal statement that must be clear, conspicuous, and consented to by all users. It must disclose how a mobile app gathers, stores, and uses the personally identifiable information it collects from its users.</p>
                  <p>A mobile privacy app is developed and presented to users so that mobile app developers stay compliant with state, federal, and international laws. As a result, they fulfill the legal requirement to safeguard user privacy while protecting the company itself from legal challenges.</p>
              </div>
              <h3 class="mt-12">Authorized Users</h3>
              <p class="mt-4 text-small">
                  A mobile app privacy policy is a legal statement that must be clear, conspicuous, and consented to by all users. It must disclose how a mobile app gathers, stores, and uses the personally identifiable information it collects from its users.
              </p>
              <div class="cb-noti mt-12">
                <input type="checkbox" class="tf-checkbox" id="cb-ip"> 
                <label for="cb-ip">I agree to the Term of service and Privacy policy</label>
              </div>
           
             </div>
             <div class="mt-20">
                <a href="#" class="tf-btn md primary" data-bs-dismiss="modal">I Accept</a>
             </div>
          </div>
       </div>
    </div>




    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <script type="text/javascript" src="js/jquery.min.js"></script>


    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/apexcharts.js"></script>
    <script type="text/javascript" src="js/chart.bundle.min.js"></script>
    <script type="text/javascript" src="js/line-chart.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/chart.bundle.min.js"></script>
    <script src="js/apexcharts.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <script src="js/swiper.js"></script>
    <script>
        // Fetch and update crypto market data
        async function fetchCryptoData() {
            try {
                const response = await fetch('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1&sparkline=false');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                updateCryptoMarket(data);
            } catch (error) {
                console.error('Error fetching crypto data:', error);
            }
        }

        // Update the market section with fetched data
        function updateCryptoMarket(data) {
            const marketContainer = document.getElementById('crypto-market');
            marketContainer.innerHTML = '';

            data.forEach(coin => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                slide.innerHTML = `
                    <a href="exchange-market.html" class="coin-box d-block">
                        <div class="coin-logo">
                            <img src="${coin.image}" alt="${coin.name}" class="logo">
                            <div class="title">
                                <p>${coin.name}</p>
                                <span>${coin.symbol.toUpperCase()}</span>
                            </div>
                        </div>
                        <div class="mt-8 mb-8 coin-chart">
                            <div id="line-chart-${coin.id}"></div>
                        </div>
                        <div class="coin-price d-flex justify-content-between">
                            <span>$${coin.current_price.toFixed(2)}</span>
                            <span class="${coin.price_change_percentage_24h >= 0 ? 'text-primary' : 'text-danger'} d-flex align-items-center gap-2">
                                <i class="icon-select-${coin.price_change_percentage_24h >= 0 ? 'up' : 'down'}"></i>
                                ${coin.price_change_percentage_24h.toFixed(2)}%
                            </span>
                        </div>
                        <div class="blur bg1"></div>
                    </a>
                `;
                marketContainer.appendChild(slide);
            });

            // Initialize Swiper after adding slides
            new Swiper('.tf-swiper', {
                slidesPerView: 2.8,
                spaceBetween: 16,
                breakpoints: {
                    640: {
                        slidesPerView: 2.8,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        }

        // Fetch data and update market section on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetchCryptoData();
        });
    </script>

</body>

</html>