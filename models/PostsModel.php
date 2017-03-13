<?php

class PostsModel extends HomeModel
{
    function getAll()
    {
        $statement = self::$db->query(
            "SELECT posts.id, title, content, date, full_name, user_id, category " .
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

    function getById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, int $user_id, int $category_id) :bool
    {
        $statement = self::$db->prepare(
            "INSERT INTO posts(title, content, user_id, category_id) VALUES (?, ?, ?, ?)"
        );
        $statement->bind_param("ssii", $title, $content, $user_id, $category_id);
        $statement->execute();
        return $statement->affected_rows == 1;
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

    public function edit(int $id, string $title, string $content, string $date, int $user_id, int $category_id) :bool
    {
        $statement = self::$db->prepare(
            "UPDATE posts SET title = ?, content = ?, date = ?, user_id = ?, category_id = ? ".
            "WHERE id = ?");
        $statement->bind_param("sssiii", $title, $content, $date, $user_id, $category_id, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    
    
}
