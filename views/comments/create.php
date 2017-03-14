<?php $this->title = 'Create new post'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Title:</div>
        <input type="text" name="comment_title">
        <div>Content:</div>
        <textarea rows="10" name="comment_content"></textarea>
        <div><input type="submit" value="Leave comment">
            <a href="<?=APP_ROOT?>/posts">[Cancel]</a></div>
    </form>
</main>
