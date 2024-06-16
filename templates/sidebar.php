<nav class="sidebar">
    <!--
    <ul class="top-menu">
        <h2>Menu</h2>
        <span id="menu-toggle" class="menu-toggle"><i class="fas fa-bars"></i></span>
    </ul>-->
    <form class="search" action=# method="post">
        <div class="iconwrapperside">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" name="searching" id="search" placeholder="Browse articles..">
    </form>
    <ul>
        <li><a href="home.php" class="active"><i class="fas fa-home"></i><span class="sidetext">Home<span></a></li>
        <li>
            <a class= "globsidearrow" >
                <i class="fas fa-globe"></i>
                <span class="sidetext"> Explore </span>
                <i class="fas fa-angle-double-right"></i>
            </a>
        </li>
        <li>
            <a href="article.php">
                <i class="fas fa-newspaper"></i>
                <span class="sidetext"> Article</span>

            </a>
        </li>
        <li>
            <a href="saved.php">
                <i class="fas fa-heart fa-inverse"></i>
                <span class="sidetext"> Saved catalog</span>

            </a>
        </li>
        <li>
            <a href="about.php">
                <i class="fas fa-info-circle"></i>
                <span class="sidetext"> About</span>

            </a>
        </li>
        
    </ul>
    <ul class="bottom-menu">
        <li class="#"><a href="#"><i class="fas fa-cog"></i><span class="sidetext"> Settings<span></a></li>
        <li><a href="includes/logout.php"><i class="fas fa-sign-out-alt"></i><span class="sidetext"> Logout<span></a></li>
    </ul>
</nav>
<nav class="sidebar sidebar2">
    <!--
    <ul class="top-menu">
        <h2>Menu</h2>
        <span id="menu-toggle" class="menu-toggle"><i class="fas fa-bars"></i></span>
    </ul>-->
   <?php
   include "genres.php"
   ?>
    <ul class="bottom-menu">
        <li class="#"><a href="#"><i class="fas fa-cog"></i><span class="sidetext"> Settings<span></a></li>
        <li><a href="includes/logout.php"><i class="fas fa-sign-out-alt"></i><span class="sidetext"> Logout<span></a></li>
    </ul>
</nav>

