<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    try {
        require_once "database.php";
        require_once "functions.php";
        $validateEmail = get_email($pdo, $email);
        $validatePassword = get_pwd($pdo, $email);
        $validateUsername = get_username($pdo, $email);
        $userid = get_userid($pdo, $email);

        //verify email
        if (empty($validateEmail)){
            $message = "Incorrect password or Email";
            header("location:../login.php?message=" . urlencode($message));
        }

        //verify password
        $hashedPwd = $validatePassword['pwd'];
        if(password_verify($pwd, $hashedPwd)){
            session_start();
            $_SESSION['username'] = $validateUsername['username'];
            $_SESSION['email'] = $validateEmail;
            $_SESSION['userid'] = $userid;

            header("location:../article.php");
        }else{
            $message = "Incorrect password or Email";
            header("location:../login.php?message=" . urlencode($message));
        }

        $pdo = null;
        $stmt = null;

    
    } catch (PDOException $e){
        echo die("Error: " . $e->getMessage());
    }

     
    
} else{
    header("location:../register.php");
}
