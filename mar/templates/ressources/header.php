<header>
    <?php
    if (isset($enableLeftBoxMenu)) {
        echo "<div class='header-left-box-menu'>";
        require(ICON_SVG_MENU);
        echo "</div>";
    }
    ?>


    <div class="header-title">
        <h1>My Amazing Reminder</h1>
    </div>
    
    <div class="header-buttons">
        <?php
        if (!empty($headerButtonsLinks)) {
            ob_start();

            foreach ($headerButtonsLinks as $buttonName => $buttonLink) {
        ?>
            <a href="<?= $buttonLink ?>">
                <button class="blue-button"><?= $buttonName ?></button>
            </a>
        <?php
            }
            ob_end_flush();
        }
        else {
            echo '<a href="index.php"><button class="blue-button">Home</button></a>';
        }
        ?>
    </div>
    
</header>