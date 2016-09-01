<?php

class HomeModel extends BaseModel
{
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
            "WHERE posts.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
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

    public function createComment(string $user, string $content, int $posts_id) :bool
    {
        $statement = self::$db->prepare(
            "INSERT INTO comments(user, content, posts_id) VALUES (?, ?, ?)"
        );
        $statement->bind_param("ssi", $user, $content, $posts_id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
}
