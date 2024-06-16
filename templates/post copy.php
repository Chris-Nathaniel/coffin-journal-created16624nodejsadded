<div class="post">
    <?php
    include "templates/genres.php";
    ?>
    <div class="recentPost">
        <div class="recentPostHeader">
            <?php
                // Initialize itemIDs array
                $itemIDs = [];

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['genre'])) {
                        if ($_POST['genre'] == "All") {
                            echo "<h1>" . $_POST['genre'] . "</h1>";
                            $ids = get_item_id($pdo);
                            foreach ($ids as $id) {
                                $itemIDs[] = $id['id'];
                            }
                            
                        } elseif ($_POST['genre'] != "All") {
                            echo "<h1>" . $_POST['genre'] . "</h1>";
                            $ids = get_item_id_genre($pdo, $_POST['genre']);
                            foreach ($ids as $index => $id) {
                                $itemIDs[] = $id['item_id'];
                            }
                           
                        } 
                        
                    }else{
                        echo "<h1>All</h1>";
                    }
                } else {
                    echo "<h1>All</h1>";
                }
            ?>
        </div>
        <div class="showingCount">
            <div class="bubble">
                <ul>podcast</ul>
                <ul>channel</ul>
            </div>
            <?php
            
                
                //get item ids for searching, seemore and audio clicked
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['searching'])) {
                        // Handle the search functionality
                        $searchInput = strtolower($_POST['searching']);
                        $ids = get_item_idsearch($pdo, $searchInput);
                        foreach ($ids as $id) {
                            $itemIDs[] = $id['id'];
                        }
                        
                    } elseif (isset($_POST['see_more'])) {
                        // Handle the see more functionality
                        if (!isset($_SESSION['n'])) {
                            $_SESSION['n'] = 4;
                        }else{
                            $_SESSION['n'] += 4;
                        }
                    } elseif (isset($_POST['generate']) || (isset($_POST['saved']))){
                        $ids = get_item_id($pdo);
                        foreach ($ids as $id) {
                            $itemIDs[] = $id['id'];
                        }
                        
                    }
                }
                // get initial item ids
                if ($_SERVER["REQUEST_METHOD"] != "POST" || isset($_POST['see_more'])) {
                    if (!isset($_SESSION['n'])) {
                        $_SESSION['n'] = 4;
                    }
                
                    if (empty($itemIDs)) {
                        $ids = get_item_id($pdo);
                        foreach ($ids as $id) {
                            $itemIDs[] = $id['id'];
                        }
                        
                    }   

                }

                // Slice the itemIDs array according to the session variable 'n'
                
                $itemIDs = array_reverse($itemIDs);
                $itemIDs = array_slice($itemIDs, 0, $_SESSION['n']);
                $count = count($itemIDs);

                echo "<h3>Showing: $count posts</h3>";

            ?>
            
            
        </div>
        <div class="articles">
            <?php
            
            if ($count == 0){
                echo "<h3 style='display:flex'>No posts found</h3>";
            }

            // Loop through each item ID
            foreach ($itemIDs as $index => $itemID) {
                // Fetch item details
                $image_path = get_item_image($pdo, $itemID)['image_path'];
                $name = get_item_name($pdo, $itemID)['name'];
                $desc = get_item_desc($pdo, $itemID)['description'];
                $content = get_item_content($pdo, $itemID)['content'];
                $user_id = get_item_userid($pdo, $itemID)['user_id'];
                $created_at = get_item_createdat($pdo, $itemID)['created_at'];
                $itemcontent =  escapeshellarg($content);
                
            
               
            //generate audio file
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['generate']) && $_POST['genuseerate'] == $index) {
                    $python_path = "python/elevenlabs.py";
                    //$temptextfile = "text/temp.txt";
                    //file_put_contents($temptextfile, $content);
                    //$command = escapeshellcmd("python $python_path $content $itemID");
                    exec("python3 $python_path $itemcontent $itemID", $output, $result);
                    foreach($output as $index => $i){
                        //echo "<p>main content: " . $itemcontent . "</p>";
                        $logContent .= "log output\n";
                        $logContent .= "Index: " . $index . "\n";
                        $logContent .= "Content: " . $i . "\n";
                        $logContent .= "-----------------\n";
                        
                    }
                    file_put_contents("audio/log_output.txt", $logContent, FILE_APPEND);
                }
            }
            ?>
            <?php 
            //saved item
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['saved']) && $_POST['saved'] == $index) {
                    $userid = $_SESSION['userid']['id'];
                    savedPost($pdo, $userid, $itemID);
                    //echo "<p>" . $itemID . "</p>";
                    //echo "<p>" . $_SESSION['userid']['id'] . "</p>";
                    //echo "saved successfully";
                    /*foreach ($_SESSION['userid'] as $userid){
                        echo "<p>" . $userid . "</p>";
                    }*/
                    
                }
            } 
            ?>
            <div class="card">
                <div class="card-image">
                    <div class="music-player">
                        <img src="<?php echo $image_path; ?>" alt="Song Cover" class="cover">
                        <div class="info">
                            <div class="progress-container">
                                <input type="range" class="progress-bar" value="0" min="0" max="100">
                                <div class="time">
                                    <span class="current-time">0:00</span> <span class="duration">0:00</span>
                                </div>
                            </div>
                            <div class="controls">
                                <form class="control-form" action="#" method="POST">
                                    <i class="fas fa-play play"><button type="submit" name="generate" value="<?php echo $index;?>" style='display:none' ></button></i>
                                    <i class="fas fa-pause pause" style="display: none;"></i>
                                    <i class="fas fa-stop stop"></i>
                                </form>
                            </div>
                        </div>
                        <audio class="audio" src="<?php echo 'audio/' . $itemID . '.mp3'; ?>"></audio>
                    </div>
                </div>
                <div class="card-title">
                    <h3><a href="content.php?itemID=<?php echo $itemID; ?>"><?php echo $name; ?></a></h3>
                </div>
                <div class="card-body">
                    <p><?php echo $desc; ?></p>
                </div>
                <div class="card-bottom">
                    <?php
                        $channel = get_channel($pdo, $user_id)['name'];
                        $timepassed = timepassed($created_at);
                        echo "<p class='channel'>" . $channel . "  |  " . $timepassed . "</p>";
                    ?>
                    <form class="save-form" action="#" method="POST">
                        <i class="fas fa-plus"><button type="submit" name="saved" value="<?php echo $index;?>" style='display:none'></button></i>
                        <i class="fas fa-check" style="display:none;"></i>
                    </form>
                </div> 
            </div> 
            <?php
            }
            ?>   
        </div>


        <div class="seemore">
            <form action="#" method="post">
                <button type="submit" name="see_more" class="button">
                    <p>see more</p>
                </button>
            </form>
        </div>
        
    </div>

</div>


