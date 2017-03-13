<?php $this->title = 'Create new category'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Category:</div>
        <input type="text" name="category_title">
        <div><input type="submit" value="Create category">
            <a href="<?=APP_ROOT?>/categories">[Cancel]</a></div>
    </form>
</main>
