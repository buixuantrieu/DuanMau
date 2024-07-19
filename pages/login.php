<head>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<div class="form__contact--wrapper">
    <div class="form__contact--container">
        <div class="bg__contact--online"></div>
        <div class="bg__contact--offline"></div>
        <div class="box__contact--online">
            <div class="box__online--title">Đăng nhập</div>
            <form class="form__login" action="" method="post">
                <div class="form__group">
                    <label for="">Tên tài khoản:</label>
                    <input name="user-login" class="user__name--login" type="text" />
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Mật khẩu:</label>
                    <input name="password-login" class="password__login" type="password" />
                    <span class="error">
                        <?php
                        if (isset($notification)) {
                            echo $notification;
                        } ?>
                    </span>
                </div>
                <p style="display: flex;justify-content: end; font-size: 12px;text-decoration: none;"><a style="color: white;" href="index.php?page=forgot-password">Quên mật khẩu?</a></p>
                <br />
                <button type="submit">
                    Đăng nhập
                    <div class="border__top"></div>
                    <div class="border__right"></div>
                    <div class="border__bottom"></div>
                    <div class="border__left"></div>
                </button>
            </form>
        </div>
        <div class="box__contact--offline">
            <div class="box__online--title">Đăng kí</div>
            <form action="" class="form__register" method="post">
                <div class="form__group">
                    <label for="">Tên tài khoản:</label>
                    <input class="user__name--register" name="user-name-register" type="text" />
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Mật khẩu:</label>
                    <input name="password-register" class="password__register" type="password" />
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Nhập lại mật khẩu:</label>
                    <input class="confirm__password--register" type="password" />
                    <span class="error"></span>
                </div>
                <div class="form__group">
                    <label for="">Email:</label>
                    <input name="email-register" type="email" required />
                </div>
                <br />
                <button type="submit">
                    Đăng kí
                    <div class="border__top"></div>
                    <div class="border__right"></div>
                    <div class="border__bottom"></div>
                    <div class="border__left"></div>
                </button>
            </form>
        </div>
        <div class="title__contact--online">
            <div class="title__online">Đăng nhập</div>
            <div class="des__online">
                Nếu bạn đã có tài khoản trước đó, bạn có thể đăng nhập tại đây.
            </div>
            <div class="button__online">Đăng nhập</div>
        </div>
        <div class="title__contact--offline">
            <div class="title__offline">Đăng kí</div>
            <div class="des__offline">
                Nếu bạn chưa có tài khoản, bạn có thể đăng kí tài khoản tại đây để có thể mua hàng và thực hiện 1 số chức năng khác.
            </div>
            <div class="button__offline">Đăng kí</div>
        </div>
    </div>
</div>
<script>
    const formRegister = document.querySelector('.form__register');
    const userNameRegister = document.querySelector('.user__name--register');
    const passwordRegister = document.querySelector('.password__register');
    const confirmPasswordRegister = document.querySelector('.confirm__password--register');
    const formLogin = document.querySelector('.form__login');
    const userNameLogin = document.querySelector('.user__name--login');
    const passwordLogin = document.querySelector('.password__login');
    formRegister.onsubmit = (e) => {
        let userName = isUserName();
        let password = isPassword();
        let confirmPassword = isConfirmPassword();
        if (!userName || !password || !confirmPassword) {
            e.preventDefault();
            console.log();
            console.log(passwordRegister.value);
        }

    }
    formLogin.onsubmit = (e) => {
        let userName = isUserNameLogin();
        let password = isPasswordLogin();
        if (!userName || !password) {
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
    isUserNameLogin = () => {
        if (userNameLogin.value.trim().length == 0) {
            showError(userNameLogin, `Không được để trống!!!`);
            return false;
        }
        showSuccess(userNameLogin);
        return true;
    }
    isPasswordLogin = () => {
        if (passwordLogin.value.trim().length == 0) {
            showError(passwordLogin, `Không được để trống!!!`);
            return false;
        }
        showSuccess(passwordLogin);
        return true;
    }
    isUserName = () => {
        let regex = /[a-zA-Z\s]+$/
        if (userNameRegister.value.trim().length == 0) {
            showError(userNameRegister, `Không được để trống!!!`);
            return false;
        } else if (userNameRegister.value.trim().length < 5) {
            showError(userNameRegister, `Tối thiểu 5 kí tự`);
            return false;
        } else if (!regex.test(userNameRegister.value.trim())) {
            showError(userNameRegister, `Tên không được chứa kí tự đặc biệt!!!`)
            return false;
        }
        showSuccess(userNameRegister);
        return true;
    }
    isPassword = () => {
        let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/
        if (passwordRegister.value.trim().length == 0) {
            showError(passwordRegister, `Không được để trống!!!`);
            return false;
        } else if (passwordRegister.value.trim().length < 8) {
            showError(passwordRegister, `Tối thiểu 8 kí tự`);
            return false;
        } else if (!regex.test(passwordRegister.value.trim())) {
            showError(passwordRegister, `Mật khẩu ít nhất 1 chữ hoa, 1 chữ thường và số`);
            return false;
        }
        showSuccess(passwordRegister);
        return true;
    }
    isConfirmPassword = () => {
        if (confirmPasswordRegister.value.trim() !== passwordRegister.value.trim()) {
            showError(confirmPasswordRegister, `Mật khẩu không trùng khớp`);
            return false;
        }
        showSuccess(confirmPasswordRegister);
        return true;
    }

    function contactForm() {
        const inputs = document.querySelectorAll("input");
        const formContainer = document.querySelector(".form__contact--wrapper");
        const buttonOffline = document.querySelector(".button__offline");
        const buttonOnline = document.querySelector(".button__online");
        inputs.forEach((item) => {
            const labelFocus = item.parentElement.querySelector("label");
            item.onfocus = () => {
                labelFocus.classList.add("label__focus");
                item.classList.add("input__focus");
            };
            item.onblur = () => {
                if (item.value == "") {
                    labelFocus.classList.remove("label__focus");
                    item.classList.remove("input__focus");
                }
            };
        });
        buttonOffline.onclick = () => {
            formContainer.classList.add("active__form");
        };
        buttonOnline.onclick = () => {
            formContainer.classList.remove("active__form");
        };
    }
    contactForm();
</script>