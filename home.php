<?php
require_once "includes/session.php";
require_once "includes/functions.php";
require_once "includes/database.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];

    $image_path = get_item_image($pdo, $itemID)['image_path'];
    $name = get_item_name($pdo, $itemID)['name'];
    $content = get_item_content($pdo, $itemID)['content'];
    
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
        <?php include "template/profile.php"?>
        <?php include "templates/slimheader.php"?>
        <?php include "templates/sidebar.php"?>
    </header>
   
    <main>
        <h1 style="color:white; text-align:center;">Welcome to Homepage</h1>
    </main>
</body>
</html>