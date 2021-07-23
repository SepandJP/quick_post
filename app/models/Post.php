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
                        users.name as userName,
                        posts.id as postId
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY postCreated DESC';

        $this->db->query($query);
        $result = $this->db->getAllResult();

        return $result;
    }

    /**
     * Get post's data and insert that in database.
     *
     * @param array $data an array of strings.
     */
    public function addPost($data)
    {
        $query = 'INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)';
        $this->db->query($query);

        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // Execute query
        $this->db->executeQuery();
    }

    /**
     * Select a post with a special id and return it.
     *
     * @param int $id
     *
     * @return mixed $row is all of the data for a post in database.
     */
    public function getPostById($id)
    {
        $query = 'SELECT * FROM posts WHERE id = :id';

        $this->db->query($query);
        $this->db->bind(':id', $id);

        // Execute query
        $row = $this->db->getSingleResult();

        return $row;
    }
}