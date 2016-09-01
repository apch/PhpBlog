<?php $this->title = $this->post['title']; ?>

<main>
    <h1><?= htmlentities($this->post['title']); ?></h1>
    <p>
        <i>Posted on</i>
        <?= htmlentities($this->post['date']); ?>
        <i>by</i>
        <?= htmlentities($this->post['full_name']); ?>
    </p>
    <p><?= $this->post['content']; ?></p>

    <h2>Comments</h2>
    <?php foreach ($this->commentsByPost as $comment) : ?>
        <a href="<?=APP_ROOT?>/home/view/<?=$comment['id']?>"><?= htmlentities($comment['title']); ?></a>
    <?php endforeach; ?>

    <div>Leave comment</div>
    <form method="post">
        <div>Title:</div>
        <input type="text" name="comment_title">
        <div>Content:</div>
        <textarea rows="10" name="comment_content"></textarea>
        <div><input type="submit" value="Leave comment"></div>
    </form>
</main>