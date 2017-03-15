<?php $this->title = 'Posts';?>

<h1><?=htmlspecialchars($this->title)?></h1>
<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Category</th>
            <th>Picture</th>
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
            <td>
                <?php if($post['picture_url'] == "none" || $post['picture_url'] == null): ?>
                    <p>none</p>
                <?php else: ?>
                    <img class="postPicture" src="<?=POSTED_PICTURES?><?=$post['picture_url']?>">
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($post['date'])?></td>

            <td>
                <a href="<?=APP_ROOT?>/posts/edit/<?=$post['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/posts/delete/<?=$post['id']?>">[Delete]</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</main>




