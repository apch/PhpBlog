<?php $this->title = 'Categories'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>
<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr

    <?php foreach ($this->categories as $category) : ?>
        <tr>
            <td><?= htmlspecialchars($category['id'])?></td>
            <td><?= htmlspecialchars($category['category'])?></td>

            <td>
                <a href="<?=APP_ROOT?>/categories/edit/<?=$category['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/categories/delete/<?=$category['id']?>">[Delete]</a>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="3"><a href="<?=APP_ROOT?>/categories/create/">[Create new category]</a></td>
        </tr>
    </table>
</main>

