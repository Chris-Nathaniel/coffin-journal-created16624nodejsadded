<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffin Journal-login</title>
    <link rel="stylesheet"  href="css/main.css">
</head>
<body>
    <h1 class="title">Coffin Journal</h1>
    <nav class="horizontalnav">
        <a href="index.php"><ul>Home</ul></a>
        <a href="login.php"><ul>Article</ul></a>
        <a href="login.php"><ul>Catalog</ul></a>
        <a href="login.php"><ul>About</ul></a>
    </nav>
    <div class="wrapper">
        <div class="image">
            <img src="images/myerside.jpg">
            <div class="content regis">
                <form class="regisloginform" action="includes/loginformhandler.php" method="post">
                    <h2>Log In</h2>
                    <?php
                    if (isset($_GET['message'])) {
                        echo '<p style="color:yellow; text-align: left; font-size:13px;">*' . htmlspecialchars($_GET['message']) . '</p>';
                    }
                    if (isset($_GET['emailerror'])) {
                        echo '<p style="color:yellow; text-align: left; font-size:13px;">*' . htmlspecialchars($_GET['emailerror']) . '</p>';
                    }
                    ?>
                    <label>email</label>
                    <input id="email" name="email" type="text" ></input>
                    <br>
                    <label>password</label>
                    <input id="pwd" name="pwd" type="password" ></input>
                    <br>
                    <button type="submit">Sign in</button>
                    
                </form>
                <form class="part2 regisloginform" action="register.php" method="get">
                    <hr>
                    <p class="centered">Don't have an account?</p>
                    <button type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

