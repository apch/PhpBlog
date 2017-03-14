<?php $this->title = 'Comments'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>

<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Content</th>
            <th>Date</th>
            <th>Actions</th>
        </tr

    <?php foreach ($this->comments as $comment) : ?>
        <tr>
            <td><?= htmlspecialchars($comment['id'])?></td>
            <td><?= htmlspecialchars($comment['user'])?></td>
            <td><?= cutLongText($comment['content'])?></td>
            <td><?= htmlspecialchars($comment['date'])?></td>

            <td>
                <a href="<?=APP_ROOT?>/comments/edit/<?=$comment['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/comments/delete/<?=$comment['id']?>">[Delete]</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</main>

