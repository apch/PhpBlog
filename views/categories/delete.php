<?php $this->title = 'Delete category'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">
        <div>Category:</div>
        <input type="text" name="category_title" disabled
               value="<?=htmlspecialchars($this->category['category'])?>">
        <div><input type="submit" value="Delete category">
            <a href="<?=APP_ROOT?>/categories">[Cancel]</a></div>
    </form>
</main>
