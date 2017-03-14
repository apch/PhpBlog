<?php $this->title = 'Edit category'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <form method="post">

        <div>Category:</div>
        <input type="text" name="category_title"
               value="<?=htmlspecialchars($this->category['category'])?>">
        <div><input type="submit" value="Edit category">
            <a href="<?=APP_ROOT?>/categories">[Cancel]</a></div>
    </form>
</main>