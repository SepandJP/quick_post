<?php


class User
{
    private $db;

    public function __construct()
    {
        // Connect to Database
        $this->db = new Database;
    }

    /**
     * Insert new user data in database
     * notice: $data['password'] is a hashed password
     *
     * @param array $data
     *
     * @return bool
     *             if execute the query without error return TRUE
     *             else return FALSE
     */
    public function register($data)
    {
        // Insert Query
        $query = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $this->db->query($query);

        // Bind Values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

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

    /**
     * Get entered email and find a user by this email.
     * if a user exists: return TRUE
     * if a user doesn't exist: return FALSE
     *
     * @param string $email
     *
     * @return bool
     */
    public function findUserByEmail($email)
    {
        // Find user by email
        $query = 'SELECT * FROM users WHERE email = :email';
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->executeQuery();

        // Get user data
        $row = $this->db->getSingleResult();

        // Check row
        if ($this->db->rowCount() > 0)
        {
            // If a user exists: return TRUE
            return true;
        }

        else
        {
            // If a user doesn't exist: return FALSE
            return false;
        }
    }

    /**
     * Get email and password from log in form
     *
     * Find user with email
     * and
     * Verify password
     *
     * @param string $email
     * @param string $password
     *
     * @return bool|mixed
     *                   If the password is correct and verified return the user's data from DataBase
     *                   Else the password is incorrect and doesn't verify return FALSE
     */
    public function login($email, $password)
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->executeQuery();

        $row = $this->db->getSingleResult();

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword))
        {
            return $row;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get data of user that wrote this post.
     * Because we want if this user writer of this post, user permit edit or delete this post.
     *
     * @param integer $id
     *
     * @return mixed $row
     */
    public function getUserById($id)
    {
        $query = 'SELECT * FROM users WHERE id = :id';
        $this->db->query($query);

        // Bind value
        $this->db->bind(':id', $id);

        // Execute query and get result
        $row = $this->db->getSingleResult();

        return $row;
    }
}