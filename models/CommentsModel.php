<?php

class CommentsModel extends HomeModel
{
    function getAll()
    {
        $statement = self::$db->query(
            "SELECT comments.id, user, content, date, full_name, user_id " .
            "FROM comments " .
            "LEFT JOIN users " .
            "On comments.user_id = users.id " .
            "ORDER BY date DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    function getById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM comments WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function delete($id) :bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM comments WHERE id = ?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function edit(int $id, string $user, string $content, string $date) :bool
    {
        $statement = self::$db->prepare(
            "UPDATE comments SET user = ?, content = ?, date = ? ".
            "WHERE id = ?");
        $statement->bind_param("sssi", $user, $content, $date, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    
    
}
