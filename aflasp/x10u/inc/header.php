<?php
$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
?>
<header class="header">
  <div class="header__inner flex">
    <?php if( empty($LOGIN_ID ) ) : ?>
    <?php include(__DIR__ . '/header__login_before.php'); ?>
    <?php else: ?>
    <?php include(__DIR__ . '/header__login_after.php'); ?>
    <?php endif; ?>
  </div>
  <div class="js-btn_gnaviMenu btn_gnaviMenu sp"><i></i></div>
</header>
