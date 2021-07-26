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

    /**
     * Change post's data
     *
     * @param mixed $data
     *                   Data of a post that user want edit it.
     *
     * @return bool
     *             If update of the post is successful return TRUE
     *             else return FALSE
     */
    public function editPost($data)
    {
        $query = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
        $this->db->query($query);

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // Execute query
        if ($this->db->executeQuery())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Remove post from database.
     *
     * @param integer $id
     *           The post's id in database row that, the user wants to remove it.
     *
     * @return bool
     *             If query executes and post removed successfully return TRUE.
     *             Else return FALSE.
     */
    public function deletePost($id)
    {
        $query = 'DELETE FROM posts WHERE id = :id';
        $this->db->query($query);
        // Bind Value
        $this->db->bind(':id', $id);
        // Execute Query
        if ($this->db->executeQuery())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}