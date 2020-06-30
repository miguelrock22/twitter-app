<h2>Posts</h2>
<form method="POST" class="form-search" action="<?= Request::generateUrl('post','list') ?>">
    <div class="form-field">
        <div class="form-field__control">
            <label for="comment" class="form_field__label">Comment</label>
            <input type="text" name="comment" id="comment" class="form_field__input" />
        </div>
    </div>
    <div class="form-field">
        <div class="form-field__control">
            <label for="date" class="form_field__label">date</label>
            <input type="date" name="date" id="date" class="form_field__input" />
        </div>
    </div>  
    <div class="form-field">
        <div class="form-field__control">
            <input type="submit" name="search" class="form_field__button" value="Search" />
        </div>
    </div>
</form>

<div class="posts container">
    <ul>
        <?php foreach($posts as $post): ?>
            <li>
                <p><strong><?= $post->time ?></strong></p>
                <p><?= $post->comment ?></p>
                <p><?= $post->username ?></p>
            </li>  
        <?php endforeach ?>
    </ul>
</div>

<br>

<form method="POST" class="form" action="<?= Request::generateUrl('post','create') ?>">
    <div class="form-field">
        <div class="form-field__control">
            <label for="comment" class="form_field__label">Write a comment</label>
            <textarea name="comment" id="comment" class="form_field__input" rows="10" cols="50"></textarea>
        </div>
        <?php if(isset($_SESSION['formError']['comment'])): ?>
            <div class="form-field__error">
                <span><?= $_SESSION['formError']['comment'] ?></span>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-field">
        <div class="form-field__control">
            <input type="submit" name="login" class="form_field__button" value="Submit" />
        </div>
    </div>
</form>