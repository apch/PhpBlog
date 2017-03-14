<?php $this->title = 'Delete comment'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Username:</div>
        <input type="text" name="comment_user" disabled
               value="<?=htmlspecialchars($this->comment['user'])?>">
        <div>Content:</div>
    <textarea rows="10" name="comment_content" disabled
    ><?=htmlspecialchars($this->comment['content'])?></textarea>
        <div><input type="submit" value="Delete comment">
            <a href="<?=APP_ROOT?>/comments">[Cancel]</a></div>
    </form>

</main>