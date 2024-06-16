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

    $image_path = get_globalitem($pdo, $itemID)['image_path'];
    $name = get_globalitem($pdo, $itemID)['name'];
    $content = get_globalitem($pdo, $itemID)['content'];

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
<header>
    <?php include "templates/profile.php"?>
</header>
<body>
    <?php include "templates/header.php"?>
    <?php include "templates/sidebar.php"?>
    <div class="posthead">
        <div class="postContent">
            
            <div class="post-title">
                <h1><?php echo $name?></h1>
            </div>
            <div class="post-body">
                <p><?php echo $content?></p>
            </div>
        </div>
        <div class="postImg">
            <img src="<?php echo $image_path?>">
            <img src="<?php echo $image_path?>">
            <img src="<?php echo $image_path?>">
        </div>
        
    </div>
    
</body>
</html>