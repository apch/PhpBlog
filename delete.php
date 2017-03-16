<?php $this->title = 'Delete post'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Title:</div>
        <input type="text" name="post_title" disabled
               value="<?=htmlspecialchars($this->post['title'])?>">
        <div>
            <?php if($this->post['picture_url'] != "none" && $this->post['picture_url'] != null): ?>
                <p>Uploaded picture: </p>
                <img class="deletePostPicture" src="<?=POSTED_PICTURES?><?=$this->post['picture_url']?>">
            <?php endif; ?>
        </div>
        <div>Content:</div>
    <textarea rows="10" name="post_content" disabled
    ><?=htmlspecialchars($this->post['content'])?></textarea>

        <div><input type="submit" value="Delete post">
            <a href="<?=APP_ROOT?>/posts">[Cancel]</a></div>
    </form>

</main>