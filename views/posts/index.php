<?php $this->title = 'Posts'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>
<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr

    <?php foreach ($this->posts as $post) : ?>
        <tr>
            <td><?= htmlspecialchars($post['id'])?></td>
            <td><?= htmlspecialchars($post['title'])?></td>
            <td><?= cutLongText($post['content'])?></td>
            <td><?= htmlspecialchars($post['full_name'])?></td>
            <td><?= htmlspecialchars($post['category'])?></td>
            <td><?= htmlspecialchars($post['date'])?></td>

	<?php  if($post['user_id'] == $_SESSION['user_id']) { ?>
            <td>
                <a href="<?=APP_ROOT?>/posts/edit/<?=$post['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/posts/delete/<?=$post['id']?>">[Delete]</a>
            </td>
                <?php }else{echo "<td></td>";} ?>
        </tr>
    <?php endforeach; ?>
    </table>
</main>

