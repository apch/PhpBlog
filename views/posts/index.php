<<<<<<< HEAD
=======
<?php $this->title = 'Posts'; ?>

<h1><?=htmlspecialchars($this->title)?></h1>
>>>>>>> origin/master
<main>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
<<<<<<< HEAD
=======
            <th>Category</th>
>>>>>>> origin/master
            <th>Date</th>
            <th>Actions</th>
        </tr

    <?php foreach ($this->posts as $post) : ?>
        <tr>
            <td><?= htmlspecialchars($post['id'])?></td>
            <td><?= htmlspecialchars($post['title'])?></td>
            <td><?= cutLongText($post['content'])?></td>
            <td><?= htmlspecialchars($post['full_name'])?></td>
<<<<<<< HEAD
            <td><?= htmlspecialchars($post['date'])?></td>

=======
            <td><?= htmlspecialchars($post['category'])?></td>
            <td><?= htmlspecialchars($post['date'])?></td>

	<?php  if($post['user_id'] == $_SESSION['user_id']) { ?>
>>>>>>> origin/master
            <td>
                <a href="<?=APP_ROOT?>/posts/edit/<?=$post['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/posts/delete/<?=$post['id']?>">[Delete]</a>
            </td>
<<<<<<< HEAD
=======
                <?php }else{echo "<td></td>";} ?>
>>>>>>> origin/master
        </tr>
    <?php endforeach; ?>
    </table>
</main>

