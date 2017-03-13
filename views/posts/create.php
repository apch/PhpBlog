<?php $this->title = 'Create new post'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Title:</div>
        <input type="text" name="post_title">
        <div>Choose Category:</div>
        <select name="post_category">
            <?php foreach ($this->categories as $category) : ?>
                <option value="<?= htmlspecialchars($category['id'])?>"><?= htmlspecialchars($category['category'])?></option>
            <?php endforeach; ?>
        </select>
        <div>&nbsp;</div>
        <div>Content:</div>
        <textarea rows="10" name="post_content"></textarea>
        <div><input type="submit" value="Create post">
            <a href="<?=APP_ROOT?>/posts">[Cancel]</a></div>
    </form>
</main>
