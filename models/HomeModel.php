<?php

class HomeModel extends BaseModel
{
    function getCategoryById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * " .
            "FROM categories ".
            "WHERE categories.id = ? ");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    function getCategories()
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM categories ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getLatestPosts(int $maxCount){
        $statement = self::$db->query(
            "SELECT posts.id, title, content, date, full_name ".
            "FROM posts ".
            "LEFT JOIN users ".
            "On posts.user_id = users.id ".
            "ORDER BY date DESC ".
            "LIMIT ". $maxCount);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getPostById(int $id){
        $statement = self::$db->prepare(
            "SELECT posts.id, title, content, date, full_name ".
            "FROM posts LEFT JOIN users On posts.user_id = users.id ".
            "WHERE posts.id = ? ");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    function getPostsByCategory(int $id){
        $statement = self::$db->prepare(
        "SELECT posts.id, title, content, date, full_name, category FROM posts ".
        "LEFT JOIN users ".
        "On posts.user_id = users.id ".
        "LEFT JOIN categories ".
        "On posts.category_id = categories.id ".
        "WHERE categories.id = ? ".
        "ORDER BY date DESC ");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    function getCommentsByPost(int $id){
        $statement = self::$db->prepare(
            "SELECT * FROM comments WHERE posts_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    function getUsernameById(int $id){
        $statement = self::$db->prepare(
            "SELECT full_name FROM users WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function createComment(string $user, string $content, int $posts_id, int $user_id) :bool
    {
        $statement = self::$db->prepare(
            "INSERT INTO comments(user, content, posts_id, user_id) VALUES (?, ?, ?, ?)"
        );
        $statement->bind_param("ssii", $user, $content, $posts_id, $user_id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
}
