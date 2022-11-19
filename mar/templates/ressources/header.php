<header>
    <?php
    if (isset($ENABLE_LEFT_BOX_MENU)) {
        echo "<div class='header-left-box-menu'>";
        require(ICON_SVG_MENU);
        echo "</div>";
    }
    ?>


    <div class="header-title">
        <h1>My Amazing Reminder</h1>
    </div>

    <div class="header-buttons">
        <button class="blue-button">Sign in</button>
        <button class="blue-button">Login</button>
    </div>
</header>