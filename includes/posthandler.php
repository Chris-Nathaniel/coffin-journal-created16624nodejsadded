<?php

// ************************Main Functions*****************************

function getFinalId($database, $limit){
    $xitemIDs = [];
    //1. fetch item ID
    $unsanitizedIds = fetchIds($database, $xitemIDs, $limit);

    //2. Santized ID
    $sanitizeditemIDs = sanitizeArrayId($unsanitizedIds, $xitemIDs);

    //3. store it in session
    $_SESSION['itemIDs'] = !isset($_POST['see_more']) && !isset($_POST['generate']) && !isset($_POST['saved'])? $sanitizeditemIDs: $_SESSION['itemIDs'];
    
    //3. reorder ID and set limit
    $xitemIDs = sliceId($_SESSION['itemIDs'], $_SESSION['filter_limit']);

    //4. return ID
    return $xitemIDs;
}

function processItems($pdo, $itemIDs) {
    // Loop through each item ID
    foreach ($itemIDs as $index => $itemID) {

        // Fetch item details
        $globalitem = get_globalitem($pdo, $itemID);
        $itemcontent = escapeshellarg($globalitem['content']);
        $channel = get_channel($pdo, $globalitem['user_id'])['name'];
        $timepassed = timepassed($globalitem['created_at']);
        
        // Generate audio for the item content
        generateAudio($itemcontent, $itemID, $index);
        
        // Save the processed item
        savedItem($pdo, $itemID, $index);
        
        // Display the card with the item details
        display_card($globalitem, $index, $itemID, $timepassed, $channel);
    }
}



//*****************support functions**************************

function retrieve_id($database, $condition, $input){
    if ($condition === "genre"){
        return get_item_id_genre($database, $input);
    }elseif ($condition === "searching"){
        return get_item_idsearch($database, $input);
    }else{
        return get_item_id($database);
    }
}

function fetchIds($database, $xitemIDs, $limit){
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        return post_handler($database, $xitemIDs, $limit);
        
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" ){
        return initialize_post($database, $xitemIDs, $limit);
    } 
}

function initialize_post($database, $xitemIDs, $limit){
    if (empty($xitemIDs)) {
        $xitemIDs = retrieve_id($database, null, null);
        $_SESSION['filter_limit'] = $limit;
        return $xitemIDs; 
    }   
}

function post_handler($database, $xitemIDs, $limit){  
    if (isset($_POST['genre'])){
        $xitemIDs = retrieve_id($database, $_POST['genre'] === 'All' ? NULL : "genre", $_POST['genre'] === 'All' ? NULL : $_POST['genre']);
        $_SESSION['filter_limit'] = $limit;
        return $xitemIDs;
    }
    if (isset($_POST['searching'])){
        $xitemIDs = retrieve_id($database, "searching", $_POST['searching']);
        $_SESSION['filter_limit'] = $limit;
        return $xitemIDs;
    }

    if (isset($_POST['see_more'])) {
        if (!isset($_SESSION['filter_limit'])) {
            $_SESSION['filter_limit'] = 4;
        } else {
            $_SESSION['filter_limit'] += 4; 
        }
    } else {
        if (!isset($_SESSION['filter_limit'])) {
            $_SESSION['filter_limit'] = 4; 
        }
    }
}

function sanitizeArrayId($arrayid, $xitemIDs){
    foreach($arrayid as $index => $id){
        if (empty($id['id'])){
            $xitemIDs[] = $id['item_id'];
        
        }else{
            $xitemIDs[] = $id['id'];
            
        }
    }
    return $xitemIDs;
}

function sliceId($arrayid, $filter){
    $reversedId = array_reverse($arrayid);
    $slicedId = array_slice($reversedId, 0, $filter);
    return $slicedId;
}


function generateAudio($itemcontent, $itemID, $index){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['generate']) && $_POST['generate'] == $index) {
            $python_path = "python/elevenlabs.py";
            exec("python3 $python_path $itemcontent $itemID", $output, $result);
            foreach($output as $index => $i){
                $logContent .= "log output\n";
                $logContent .= "Index: " . $index . "\n";
                $logContent .= "Content: " . $i . "\n";
                $logContent .= "-----------------\n";
                
            }
            file_put_contents("audio/log_output.txt", $logContent, FILE_APPEND);
        }
    }
}

function savedItem($database, $itemID, $index){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['saved']) && $_POST['saved'] == $index) {
            $userid = $_SESSION['userid']['id'];
            savedPost($database, $userid, $itemID);
            
        }
    }
}

//**************** display ******************

function displayCategoryHeader($postGenre){
    $genre_title = !isset($postGenre)? 'All': $postGenre;
    echo "<h1>$genre_title</h1>";
}

function display_section($countPost){

    echo "<div class='bubble'>";
    echo "<ul>podcast</ul>";
    echo "<ul>channel</ul>";
    echo "</div>";
    echo "<h4>Showing: $countPost posts</h4>";

}

function postResultFeedback($countPost){
    if ($countPost == 0){
        echo "<h3 style='display:flex'>No posts found</h3>";
    }
}


function display_card($globalitem, $index, $itemID, $timepassed, $channel) {
    echo "<div class='card'>
            <div class='card-image'>
                <div class='music-player'>
                    <img src='" . htmlspecialchars($globalitem['image_path']) . "' alt='Song Cover' class='cover'>
                    <div class='info'>
                        <div class='progress-container'>
                            <input type='range' class='progress-bar' value='0' min='0' max='100'>
                            <div class='time'>
                                <span class='current-time'>0:00</span> <span class='duration'>0:00</span>
                            </div>
                        </div>
                        <div class='controls'>
                            <form class='control-form' action='#' method='POST'>
                                <i class='fas fa-play play'>
                                    <button type='submit' name='generate' value='" . htmlspecialchars($index) . "' style='display:none'></button>
                                </i>
                                <i class='fas fa-pause pause' style='display: none;'></i>
                                <i class='fas fa-stop stop'></i>
                            </form>
                        </div>
                    </div>
                    <audio class='audio' src='audio/" . htmlspecialchars($itemID) . ".mp3'></audio>
                </div>
            </div>
            <div class='card-title'>
                <h3><a href='content.php?itemID=" . htmlspecialchars($itemID) . "'>" . htmlspecialchars($globalitem['name']) . "</a></h3>
                
            </div>
            <div class='card-body'>
                <p>" . htmlspecialchars($globalitem['description']) . "</p>
            </div>
            <div class='card-bottom'>
                <p class='channel'>" . htmlspecialchars($channel) . "  |  " . htmlspecialchars($timepassed) . "</p>
                <form class='save-form' action='#' method='POST'>
                    <i class='fas fa-plus'>
                        <button type='submit' name='saved' value='" . htmlspecialchars($index) . "' style='display:none'></button>
                    </i>
                    <i class='fas fa-check' style='display:none;'></i>
                </form>
            </div> 
        </div>";
}