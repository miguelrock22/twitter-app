
<div class="form-wrapper">
    <form method="POST" class="form" action="<?= Request::generateUrl('auth','create') ?>">
        <h2>Create Account</h2>
        <div class="form-field">
            <div class="form-field__control">
                <label for="username" class="form_field__label">Username</label>
                <input type="text" name="username" id="username" class="form_field__input" value="<?= (isset($_SESSION['registerData']['username']) ? $_SESSION['registerData']['username'] : ''); ?>" required />
                <?php if(isset($_SESSION['formError']['username'])): ?>
                    <div class="form-field__error">
                        <span><?= $_SESSION['formError']['username'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <label for="email" class="form_field__label">Email</label>
                <input type="email" name="email" id="email" class="form_field__input" value="<?= (isset($_SESSION['registerData']['email']) ? $_SESSION['registerData']['email'] : ''); ?>" required />
                <?php if(isset($_SESSION['formError']['email'])): ?>
                    <div class="form-field__error">
                        <span><?= $_SESSION['formError']['email'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <label for="phone" class="form_field__label">phone</label>
                <input type="text" name="phone" id="phone" class="form_field__input" required value="<?= (isset($_SESSION['registerData']['phone']) ? $_SESSION['registerData']['phone'] : ''); ?>" />
                <?php if(isset($_SESSION['formError']['phone'])): ?>
                    <div class="form-field__error">
                        <span><?= $_SESSION['formError']['phone'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <label for="password" class="form_field__label">Password</label>
                <input type="password" name="password" id="password" class="form_field__input" required />
                <?php if(isset($_SESSION['formError']['password'])): ?>
                    <div class="form-field__error">
                        <span><?= $_SESSION['formError']['password'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <label for="confirm_password" class="form_field__label">Confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form_field__input" required />
                <?php if(isset($_SESSION['formError']['confirm_password'])): ?>
                    <div class="form-field__error">
                        <span><?= $_SESSION['formError']['confirm_password'] ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <input type="submit" name="login" class="form_field__button" value="Register" />
            </div>
        </div>
        <a href="<?= Request::generateUrl('auth','login') ?>">Login on Twitter-app</a>
    </form>
</div>
