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

        var_dump($row);
        var_dump($this->db->rowCount());

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
}