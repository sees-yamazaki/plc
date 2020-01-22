    <div id="top_menu">
        <div class="top_menu_contents">
            <img src="./asset/image/title_logo.png" alt="logo" onclick="location.href='u_index.php'" />
        </div>
        <div class="top_menu_contents inln">
            <img src="<?php echo $menu_m_url; ?>" alt="logo" onclick="<?php echo $menu_m_click; ?>" />
            <?php include('./u_xmenu.php'); ?>
        </div>
        <?php if(!empty($point)){ ?>
        <div id="point">
            <img id="img_pt1" src="./asset/image/u_home_pt_1.png" />
            <?php echo $point; ?>
            <img id="img_pt2" src="./asset/image/u_home_pt_2.png" />
        </div>
        <?php } ?>
    </div>