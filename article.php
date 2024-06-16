<?php
require_once "includes/session.php";
require_once "includes/functions.php";
require_once "includes/database.php";
require_once "includes/posthandler.php";

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
        <meta http-equiv="Cache-Control" content="no-store"/>
        <title>Coffin Journal-home</title>
        <script src="javascript/main.js"></script>
        <link rel="stylesheet"  href="css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
    </head>
    
    <body>
        <header>
            <?php include "templates/profile.php"?>
            <?php include "templates/slimheader.php"?>
            <?php include "templates/sidebar.php"?>
        </header>
        <main>
            <?php include "templates/post.php"?>
        </main>
        <footer>
            <div class="footer-container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h2>Follow Us</h2>
                        <div class="social-links">
                            <a href="https://facebook.com" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com" target="_blank" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="footer-section">
                        <p>&copy; 2024 Your Company. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        
    </body>
</html>