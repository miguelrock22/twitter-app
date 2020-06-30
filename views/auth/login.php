<div class="form-wrapper">
    <form method="POST" class="form" action="<?= Request::generateUrl('auth','auth') ?>">
        <h2>Log in</h2>
        <div class="form-field">
            <div class="form-field__control">
                <label for="username" class="form_field__label">Username</label>
                <input type="text" name="username" id="username" class="form_field__input" required />
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <label for="password" class="form_field__label">Password</label>
                <input type="password" name="password" id="password" class="form_field__input" required />
            </div>
        </div>
        <div class="form-field">
            <div class="form-field__control">
                <input type="submit" name="login" class="form_field__button" value="Log in" />
            </div>
        </div>
        <a href="<?php echo Request::generateUrl('auth','register') ?>">Register on Twitter-app</a>
    </form>

</div>    