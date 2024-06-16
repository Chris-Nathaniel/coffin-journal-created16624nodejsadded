

<div class="post">
    <?php 
    $itemIDs = getFinalId($pdo, 4);
    include "templates/genres.php"; ?>
    <div class="recentPost">
        <div class="recentPostHeader">
            <?php displayCategoryHeader($_POST['genre']); ?>
            <div class="subPostHeaderWrapper">
                <div class="subPostHeader">
                    <?php
                    foreach(range(1,20) as $number){
                        echo "<div class='headitem'>Channel$number</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="showingCount">
            <?php
            $count = count($itemIDs);
            display_section($count);
            ?>
        </div>
        <div class="articles">
            <?php
            postResultFeedback($count);
            processItems($pdo, $itemIDs);
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


