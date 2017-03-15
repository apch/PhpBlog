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
    <?php if ($this->isLoggedIn) : ?>
        <form method="post" id="comments-form">
            <div>Content:</div>
            <textarea rows="10" name="comment_content"></textarea>
            <div><input type="submit" value="Post comment"></div>
        </form>
    <?php else : ?>
        <p>Please Login or Register to comment</p>
    <?php endif ?>
</main>