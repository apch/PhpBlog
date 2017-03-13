<?php

class CategoriesModel extends HomeModel
{
    function getAll()
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM categories ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM categories WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $category) :bool
    {
        $statement = self::$db->prepare(
            "INSERT INTO categories(category) VALUES (?)"
        );
        $statement->bind_param("s", $category);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function delete($id) :bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM categories WHERE id = ?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();

        $statement = self::$db->prepare(
            "UPDATE posts SET category_id = NULL ".
            "WHERE category_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }

    public function edit(int $id, string $category) :bool
    {
        $statement = self::$db->prepare(
            "UPDATE categories SET category = ? ".
            "WHERE id = ?");
        $statement->bind_param("si", $category, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    
    
}
