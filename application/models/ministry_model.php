<?php

class Ministry_model extends CI_Model
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
    function getMinistryTeams()
    {
        $result = $this->db->select('*')->from('ministry')->get();
        return $result->result();
    }

}