
<div class="profile">
    <div class="profileheader">
        <div class="floatingprofileimg">
            <img src="images/profilepic.png">
        </div>
        <div class="profiletext">
            <?php
                echo "<p>" . $_SESSION['username'] . "</p>";
                echo "<p>" . $_SESSION['email']['email'] . "</p>";
            ?>
            <br>
            <p id="createchannel" style="color:green">create channel</p>
        </div>
    </div>
    <div class="profilesection">
        <div class="profilecontent">
            <a href="membership.php">
                <i class="fas fa-user-plus"></i><span class="sidetext">Purchases & Membership<span>
            </a>  
        </div>
    </div>
    <div class="profilesection">
    </div>
    <div class="profilefooter">
        <div class="profilecontent">
            <a href="register.php">
                <a href="includes/logout.php"><i class="fas fa-sign-out-alt"></i><span class="sidetext"> sign out<span></a>
            </a>  
        </div>
    </div>
</div>
