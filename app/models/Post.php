<?php


class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPosts()
    {
        $query = 'SELECT *,
                        posts.created_at as postCreated,
                        users.name as userName
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY postCreated DESC';

        $this->db->query($query);
        $result = $this->db->getAllResult();

        return $result;
    }
}