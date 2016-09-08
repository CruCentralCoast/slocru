<?php

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Function to return user informtion
     * 
     * @param String Username
     * @return Array of users
     */
    function getUsers($username = NULL)
    {
        $result = $this->db->select('*')->from('users');
        if ($username != NULL) 
        {
            $result = $result->where('username', $username);
        }
        $result = $result->get();
        return $result->result();
    }

}
