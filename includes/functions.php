<?php
function get_email(object $pdo, string $email){
    
    $query = "SELECT email FROM users WHERE :email = email";

    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}

function get_username(object $pdo, string $email){
    
    $query = "SELECT username FROM users WHERE :email = email";

    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;

}

function get_pwd(object $pdo, string $email){
    $query = "SELECT pwd FROM users WHERE :email = email";

    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;

}

function get_userid(object $pdo, string $email){
    
    $query = "SELECT id FROM users WHERE :email = email";

    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}



function get_item_id(object $pdo){
    $query = "SELECT id FROM items";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function get_globalitem(object $pdo, string $itemId){
    $query = "SELECT name, description, image_path, content, created_at, user_id FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $itemId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;


}


function get_item_idsearch(object $pdo, string $userinput){
    $query = "SELECT id FROM items WHERE name LIKE :name OR id = :id OR description LIKE :desc";
    $stmt = $pdo->prepare($query);

    $nameParam = '%' . $userinput . '%'; 
    $descParam = '%' . $userinput . '%';

    $stmt->bindParam(":name", $nameParam);
    $stmt->bindParam(":id", $userinput);
    $stmt->bindParam(":desc", $descParam);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $results;
}

function get_item_id_genre(object $pdo, string $genre){
    $query = "SELECT item_id FROM item_genres WHERE genre_id = (SELECT id FROM genres WHERE genre = :genre)";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":genre", $genre);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;

}

function savedPost(object $pdo, string $user_id, string $item_id){
    $query = "INSERT INTO saved (user_id, post_id) VALUES (:userid, :postid);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":userid", $user_id);
    $stmt->bindParam(":postid", $item_id);
   

    $stmt->execute();

    $pdo = null;
    $stmt = null;
   
}

function get_genres(PDO $pdo){
    $query = "SELECT genre FROM genres";
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $genres;
}

function get_channel(object $pdo, string $user_id){
    $query = "SELECT name FROM channels WHERE :user_id = user_id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;

}

function timePassed($str) {
    $sec = time() - strtotime($str);
    if($sec < 60) {
      /* if less than a minute, return seconds */
      return $sec . " seconds ago";
    }
    else if($sec < 60*60) {
      /* if less than an hour, return minutes */
      return intval($sec / 60) . " minutes ago";
    }
    else if($sec < 24*60*60) {
      /* if less than a day, return hours */
      return intval($sec / 60 / 60) . " hours ago";
    }
    else {
      /* else returns days */
      return intval($sec / 60 / 60 / 24) . " days ago";
    }
  }



/*
function get_item_name(object $pdo, string $itemId){
    $query = "SELECT name FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":id", $itemId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}

function get_item_desc(object $pdo, string $itemId){
    $query = "SELECT description FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":id", $itemId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}

function get_item_image(object $pdo, string $itemId){
    $query = "SELECT image_path FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":id", $itemId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}

function get_item_content(object $pdo, string $itemId){
    $query = "SELECT content FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":id", $itemId);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;
}



function get_item_userid(object $pdo, string $item_id){
    $query = "SELECT user_id FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $item_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;


}


function get_item_createdat(object $pdo, string $item_id){
    $query = "SELECT created_at FROM items WHERE :id = id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $item_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results = $results[0];
    return $results;


}
*/