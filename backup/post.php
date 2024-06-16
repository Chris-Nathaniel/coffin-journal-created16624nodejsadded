<div class="post">
<div class="recentPost">
        <div class="recentPostHeader">
            <h1>Articles</h1>
            
        </div>
        <div class="showingCount">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $searchInput = $_POST['searching'];
                $searchInput = strtolower($searchInput);
                $itemIDs = [];
                $ids = get_item_idsearch($pdo,$searchInput);
                foreach ($ids as $ids){
                    $itemIDs[] = $ids['id'];
                };
                $count = count($itemIDs);
                echo "<h3>Showing: $count posts</h3>";
                
            }else{
                $itemIDs = [];
                $ids = get_item_id($pdo);
                foreach ($ids as $ids){
                    $itemIDs[] = $ids['id'];
                };
                $count = count($itemIDs);
                echo "<h3>Showing: $count posts</h3>";

            }
            ?>
            <form class="postsearch" action=# method="post">
                <i class="fas fa-search" style="position: relative; left: -10px;"></i>
                <input type="text" name="searching" id="searching" placeholder="Browse articles..">
            </form>
            
        </div>
        <div class="articles">
            <?php
            // Shuffle itemIDs array to generate random Post
            shuffle($itemIDs);
            if ($count == 0){
                echo "<h3 style='display:flex'>No posts found</h3>";
            }

            // Loop through each item ID
            foreach ($itemIDs as $itemID) {
                // Fetch item details
                $image_path = get_item_image($pdo, $itemID)['image_path'];
                $name = get_item_name($pdo, $itemID)['name'];
                $desc = get_item_desc($pdo, $itemID)['description'];
            ?>
            <div class="card">
                <div class="card-image">
                    <img src="<?php echo $image_path; ?>">
                </div>
                <div class="card-title">
                    <h3><a href="content.php?itemID=<?php echo $itemID; ?>"><?php echo $name; ?></a></h3>
                </div>
                <div class="card-body">
                    <p><?php echo $desc; ?></p>
                </div>
            </div> 
            <?php
            }
            ?>   
        </div>
        
    </div>
    
</div>