<div id="menu">
    <div id="top_menu">
        <div class="top_menu_contents">
            <img src="./asset/image/title_logo.png" alt="logo" onclick="location.href='u_index.php'" />
        </div>
        <div class="top_menu_contents">
            <img src="./asset/image/title_login.png" alt="logo" onclick="location.href='u_login.php'" />
        </div>
        <div class="top_menu_contents">
            <?php if($menuflg=="on"){ ?>
            <img src="./asset/image/title_menu.png" alt="logo" onclick="location.href='u_info.php'" />
            <?php }else{ ?>
            <img src="./asset/image/title_menu_off.png" alt="logo" />
            <?php } ?>
        </div>
    </div>
</div>