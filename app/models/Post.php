<?php


class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get all of the posts that, this user written them.
     * and return them
     *
     * @return array Return as an array of mixed object.
     */
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