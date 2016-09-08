<?php

class Staff_model extends CI_Model
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
    function getMTL()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "mtl")->get();
        return $result->result();
    }
    
    function getStaff()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "staff")->get();
        return $result->result();
    }
    
    function getIntern()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "intern")->get();
        return $result->result();
    }

}

