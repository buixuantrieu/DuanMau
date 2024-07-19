<head>
    <link rel="stylesheet" href="assets/css/change-password.css">
</head>
<?php
if ($_GET['id']) {
?>

    <div class="change__password--container">
        <div class="change__password--wrapper">
            <div class="change__password--title">
                Thay đổi mật khẩu
            </div>
            <form action="" class="form__change--password" method="post">
                <div class="ud__form--group">
                    <label for="">Mật khẩu mới:</label>
                    <input class="new__password" name="password" type="password">
                    <span class="error"></span>
                </div>
                <div class="ud__form--group">
                    <label for="">Nhập lại mật khẩu mới:</label>
                    <input class="confirm__new--password" type="password">
                    <span class="success">
                        <?php
                        if (isset($notification)) {
                            echo $notification;
                        } ?>
                    </span>
                </div>
                <input type="hidden" name="id" value="<?php echo $_SESSION['auth']['id'] ?>">
                <input type="submit" type="text" value="Cập nhật mật khẩu">
            </form>
        </div>
    </div>
    <script>
        const formChangePassword = document.querySelector(".form__change--password");
        const oldPassword = document.querySelector(".old__password");
        const newPassword = document.querySelector('.new__password');
        const confirmNewPassword = document.querySelector('.confirm__new--password');
        formChangePassword.onsubmit = (e) => {
            let newRequired = isPassword();
            let confirmPassword = isConfirmPassword();
            if (!newRequired || !confirmPassword) {
                e.preventDefault();
            }

        }

        function showError(input, message) {
            let parent = input.parentElement;
            let error = parent.querySelector('.error');
            error.innerHTML = message;
        }

        function showSuccess(input) {
            let parent = input.parentElement;
            let error = parent.querySelector('.error');
            error.innerHTML = '';
        }
        isRequiredValue = (item) => {
            if (item.value.trim().length == 0) {
                showError(item, `Không được để trống`);
                return false;
            }
            showSuccess(item);
            return true;
        }
        isPassword = () => {
            let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/
            if (newPassword.value.trim().length == 0) {
                showError(newPassword, `Không được để trống!!!`);
                return false;
            } else if (newPassword.value.trim().length < 8) {
                showError(newPassword, `Tối thiểu 8 kí tự`);
                return false;
            } else if (!regex.test(newPassword.value.trim())) {
                showError(newPassword, `Mật khẩu ít nhất 1 chữ hoa, 1 chữ thường và số`);
                return false;
            }
            showSuccess(newPassword);
            return true;
        }
        isConfirmPassword = () => {
            if (confirmNewPassword.value.trim() !== newPassword.value.trim()) {
                showError(confirmNewPassword, `Mật khẩu không trùng khớp`);
                return false;
            }
            showSuccess(confirmNewPassword);
            return true;
        }
    </script>
<?php
} else {
?>
    <div class="change__password--container">
        <div class="change__password--wrapper">
            <div class="change__password--title">
                Quên mật khẩu
            </div>
            <form action="" class="form__change--password" method="post">
                <div class="ud__form--group">
                    <label for="">Nhập tên tài khoản:</label>
                    <input class="new__password" name="user_name" type="text" required>
                    <span class="error"></span>
                </div>
                <input type="submit" type="text" value="Gửi mail">
            </form>
        </div>
    </div>
<?php
}
?>