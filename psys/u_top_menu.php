<div id="menu">
    <div id="top_menu">
        <div class="top_menu_contents">
            <img src="./asset/image/title_logo.png" alt="logo" onclick="location.href='u_index.php'" />
        </div>
        <div class="top_menu_contents">
            <img src="<?php echo $menu_m_url; ?>" alt="logo" onclick="<?php echo $menu_m_click; ?>" />
        </div>
        <div class="top_menu_contents">
        <?php include('./u_xmenu.php'); ?>
        </div>
    </div>
</div>