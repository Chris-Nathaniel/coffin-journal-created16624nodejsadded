<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    $pwd = password_hash($pwd, PASSWORD_DEFAULT,['cost'=>12]);
    $email = $_POST['email'];
    

    if($name == "" or $pwd =="" or $email == ""){
        $message = "Please fill in all the fields.";
        header("location:../register.php?message=" . urlencode($message));
    }else{
        try {
            require_once "database.php";
            $query = "INSERT INTO users (username, pwd, email) VALUES (:username,:pwd,:email);";
    
            $stmt = $pdo->prepare($query);
            
            $stmt->bindParam(":username", $name);
            $stmt->bindParam(":pwd", $pwd);
            $stmt->bindParam(":email", $email);
    
            $stmt->execute();
    
            $pdo = null;
            $stmt = null;
    
            header("location:../login.php");
            die();
    
        } catch (PDOException $e){
            if ($e->errorInfo[1] == 1062){
            $emailerror = "This email address is already registered. Please use a different email";
            header("location:../register.php?emailerror=" . urlencode($emailerror));
            }else{
                echo die("Error: " . $e->getMessage());
            }
        }

    
    }
   
    
} else{
    header("location:../register.php");
}