<?php

class Staff_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Function to return user informtion
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
     * @param String Username
     * @return Array of users
     */
    function getMTL()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "mtl")->get();
        return $result->result();
    }
<<<<<<< HEAD
    
=======

>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
    function getStaff()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "staff")->get();
        return $result->result();
    }
<<<<<<< HEAD
    
=======

>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
    function getIntern()
    {
        $result = $this->db->select('*')->from('staff')->where('group', "intern")->get();
        return $result->result();
    }

}

