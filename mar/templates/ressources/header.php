<header>
    <?
    if (isset($enableLeftBoxMenu)) {
        echo "<div class='header-left-box-menu' id='left-box-button'>";
        include(ICON_SVG_MENU);
        echo "</div>";
    }
    ?>

    <? if (isset($_GET['notification'])) {
        echo "<div id='notification'><p>" . $_GET['notification'] . "</p></div>";
    } ?>


    <div class="header-title">
        <h1>My Amazing Reminder</h1>
    </div>
    
    <div class="header-buttons">
        <?
        if (!empty($headerButtonsLinks)) {
            ob_start();

            foreach ($headerButtonsLinks as $buttonName => $buttonLink) {
        ?>
            <a href="<?= $buttonLink ?>">
                <button class="blue-button"><?= $buttonName ?></button>
            </a>
        <?
            }
            ob_end_flush();
        }
        else {
            echo '<a href="index.php"><button class="blue-button">Home</button></a>';
        }
        ?>
    </div>
    
</header>