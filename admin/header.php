
<div class="header__wrapper">
    <div class="header__avatar" style="background-image: url(../uploadFiles/<?php echo $_SESSION['auth']['avatar'] ?>);">
    </div>
    <div class="header__name"><?php echo $_SESSION['auth']['full_name'] ?> - <?php echo $_SESSION['auth']['role'] ?></div>
    <div class="header__menu"><a href="../index.php?page=login"><i class="fa-solid fa-caret-down"></i></a></div>
</div>