<?php $this->title = 'Welcome to Our Blog'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<aside>
    <h2>Recent Posts</h2>
    <?php foreach ($this->postsSidebar as $post) : ?>
        <a href="<?=APP_ROOT?>/home/view/<?=$post['id']?>"><?= htmlentities($post['title']); ?></a>
    <?php endforeach; ?>
    <div>&nbsp;</div>
    <h2>Categories</h2>
    <?php foreach ($this->categoriesSidebar as $category) : ?>
        <a href="<?=APP_ROOT?>/home/category/<?=$category['id']?>"><?= htmlentities($category['category']); ?></a>
    <?php endforeach; ?>
</aside>

<main>
    <?php foreach ($this->posts as $post) : ?>
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


