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
        <p><i>Posted on</i> <?= htmlentities($comment['date']); ?> <i>by</i> <?= htmlentities($comment['user']); ?></p>
        <p><?php echo $comment['content']; ?></p>
        <p>&nbsp;</p>
    <?php endforeach; ?>

    <h3>Leave your comment</h3>
    <form method="post">
        <div>Your name:</div>
        <input type="text" name="comment_user" value="<?= htmlentities($this->fullname['full_name']); ?>">
        <div>Content:</div>
        <textarea rows="10" name="comment_content"></textarea>
        <div><input type="submit" value="Post comment"></div>
    </form>
</main>