<?php $this->title = $this->tag['name']; ?>
<h1>Search by tag: <?=htmlspecialchars($this->title)?></h1>

<main>
    <?php foreach ($this->tagPosts as $post) : ?>
        <h1><?= htmlentities($post['title']); ?></h1>
        <p>
            <i>Posted on</i>
            <?= htmlentities($post['date']); ?>
            <i>by</i>
            <?= htmlentities($post['full_name']); ?>
        </p>
        <p><?= $post['content']; ?></p>
    <?php endforeach; ?>


</main>