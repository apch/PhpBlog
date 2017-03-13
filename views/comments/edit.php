<?php $this->title = 'Edit comment'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">

        <div>Username:</div>
        <input type="text" name="comment_user"
               value="<?=htmlspecialchars($this->comment['user'])?>">
        <div>Content:</div>
    <textarea rows="10" name="comment_content"
    ><?=htmlspecialchars($this->comment['content'])?></textarea>
        <div>&nbsp;</div>
        <div>Date (yyyy-MM-dd hh:mm:ss):</div>
        <input type="datetime" name="comment_date"
               value="<?=htmlspecialchars($this->comment['date'])?>">
        <div><input type="submit" value="Edit comment">
            <a href="<?=APP_ROOT?>/comments">[Cancel]</a></div>
    </form>
</main>