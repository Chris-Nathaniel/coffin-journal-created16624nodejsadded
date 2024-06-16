<nav class="genres">
    <?php
        $genres = get_genres($pdo);
        foreach ($genres as $genre){
        ?>
            <form action="<?php echo "?" . $genre['genre']?>" method="POST">
                <li class="genre">
                    <button type="submit" class="genre-button" name="genre" value="<?php echo $genre['genre']?>" style="display:none"></button>
                    <?php echo $genre['genre'];?>
                </li>
            </form>
    <?php
        }
    ?>
</nav>
