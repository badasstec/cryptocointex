<?php
// Start the session


// Check if the necessary session variables are set
if (isset($_SESSION["bitcoin"]) && isset($_SESSION["ethereum"]) && isset($_SESSION["bnb"]) && isset($_SESSION["usdt"])) {
    // Get the session values
    $bitcoin = $_SESSION["bitcoin"];
    $ethereum = $_SESSION["ethereum"];
    $bnb = $_SESSION["bnb"];
    $usdt = $_SESSION["usdt"];

    // Calculate the total
    $total = $bitcoin + $ethereum + $bnb + $usdt;

    // Display the total
 
 } else {
     echo "Some session variables are not set.";
 }
?>
