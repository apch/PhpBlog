<?php

class PostsModel extends HomeModel
{
    function getAll()
    {
        $statement = self::$db->query(
            "SELECT posts.id, title, content, date, full_name, user_id, category, picture_url " .
            "FROM posts " .
            "LEFT JOIN users " .
            "On posts.user_id = users.id " .
            "LEFT JOIN categories " .
            "On posts.category_id = categories.id " .
            "ORDER BY date DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getAllCategories()
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM categories ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getAllTags()
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM tags ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getTagByName(string $tag)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM tags WHERE name = ?");
        $statement->bind_param("s", $tag);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    function getById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, int $user_id, int $category_id, string $picture_url) :int
    {
        $statement = self::$db->prepare(
            "INSERT INTO posts(title, content, user_id, category_id, picture_url) VALUES (?, ?, ?, ?, ?)"
        );
        $statement->bind_param("ssiis", $title, $content, $user_id, $category_id, $picture_url);
        $statement->execute();
        $postId = self::$db->insert_id;
        if ($statement->affected_rows != 1){
            return false;
        }
        return $postId;
    }

    public function delete($id) :bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM posts WHERE id = ?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function edit(int $id, string $title, string $content, string $date, int $user_id, int $category_id, string $new_picture_url) :bool
    {
        $statement = self::$db->prepare(
            "UPDATE posts SET title = ?, content = ?, date = ?, user_id = ?, category_id = ?, picture_url = ? ".
            "WHERE id = ?");
        $statement->bind_param("sssiisi", $title, $content, $date, $user_id, $category_id, $new_picture_url, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }

    public function insertTag(string $tag) :int
    {
        $statement = self::$db->prepare(
            "INSERT INTO tags(name) VALUES (?)"
        );
        $statement->bind_param("s", $tag);
        $statement->execute();

        $tagId = self::$db->insert_id;
        if ($statement->affected_rows != 1){
            return false;
        }
        return $tagId;
    }

    public function insertTagPost(int $tagId, int $postId) :bool
    {
        $statement = self::$db->prepare(
            "INSERT INTO tags_posts(tags_id, posts_id) VALUES (?, ?)"
        );
        $statement->bind_param("ii", $tagId, $postId);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
}