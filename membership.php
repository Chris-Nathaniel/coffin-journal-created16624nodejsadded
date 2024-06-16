<?php
require_once "includes/session.php";
require_once "includes/functions.php";
require_once "includes/database.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffin Journal-home</title>
    <link rel="stylesheet"  href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="javascript/main.js"></script>
</head>

<body>
    <header>
        <?php include "templates/profile.php"?>
        <?php include "templates/slimheader.php"?>
        <?php include "templates/sidebar.php"?>
    </header>
    <main>
        <section class="membership-section">
            <div class="membership-plan">
                <div class="plan basic">
                    <h2>Basic</h2>
                    <p class="price">$10/month</p>
                    <ul>
                        <li>Access to basic features</li>
                        <li>Email support</li>
                        <li>Community access</li>
                    </ul>
                    <button>Sign Up</button>
                </div>
                <div class="plan premium">
                    <h2>Premium</h2>
                    <p class="price">$30/month</p>
                    <ul>
                        <li>Access to all features</li>
                        <li>Priority email support</li>
                        <li>Exclusive community access</li>
                        <li>Monthly webinars</li>
                    </ul>
                    <button>Sign Up</button>
                </div>
            </div>
        </section>
    </main>
    
</body>
</html>