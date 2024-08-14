<head>
    <link rel="stylesheet" href="assets/css/info.css">
</head>
<div class="info__wrapper">
    <div class="avatar__wrapper">
        <div class="avatar__container" style="background-image: url(uploadFiles/<?php echo $_SESSION['auth']['avatar'] ?>);">
            <form action="" class="form__avatar" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id-avatar" value="<?php echo $_SESSION['auth']['id'] ?>">
                <input name="avatar" id="avatar__value" type="file" style="display: none;">
                <label for="avatar__value">
                    <i class="fa-solid fa-camera-retro"></i>
                </label>
            </form>
        </div>
    </div>
    <div class="personal__information--wrapper">
        <form action="" method="post" class="ps__form--container">
            <div class="ps__form__group">
                <label for="">Tên khách hàng:</label>
                <input required name="full-name" value="<?php echo $_SESSION['auth']['full_name'] ?>" type="text">
                <span></span>
            </div>
            <div class="ps__form__group">
                <label for="">Email:</label>
                <input name="email" value="<?php echo $_SESSION['auth']['email'] ?>" type="email">
                <span></span>
            </div>
            <div class="ps__form__group">
                <label for="">Số điện thoại:</label>
                <input required name="tel" value="<?php echo $_SESSION['auth']['tel'] ?>" type="text">
                <span></span>
            </div>
            <div class="ps__form__group">
                <label for="">Birthday:</label>
                <input required name="birthday" value="<?php echo $_SESSION['auth']['birthday'] ?>" type="date">
                <span></span>
            </div>
            <div class="ps__form__group">
                <label for="">Địa chỉ: </label>
                <input required name="address" value="<?php echo $_SESSION['auth']['address'] ?>" type="text">
                <span></span>
            </div>
            <div class="success">
                <?php
                if (isset($notification)) {
                    echo $notification;
                    unset($notification);
                } ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $_SESSION['auth']['id'] ?>">

            <div class="ps__submit">
                <input type="submit" value="Cập nhật">
            </div>

        </form>
    </div>
</div>
<script>
    const formAvatar = document.querySelector('.form__avatar');
    const avatar = document.querySelector('#avatar__value');
    avatar.onchange = () => {
        formAvatar.submit();
    }
</script>