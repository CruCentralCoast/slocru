<?php
class Sermon_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Function to return event informtion
     */
    function getSermons()
    {   
        error_reporting(E_ALL);
        //$response = http_get("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLi2onRqvLcjnULwq581sf-6w26kuHe2P3&key=AIzaSyAM50L6-hOMznYxC2FemWZ683KWdB_f5Vo&maxResults=25", array('headers' => array('Accept' => 'application/json')), $info);
        $json = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLi2onRqvLcjnULwq581sf-6w26kuHe2P3&key=AIzaSyBJBT1p74rhLhwwPoCl-3h2jnJMyF-gDn4");
        $jsondecoded = json_decode($json, true);
        return $jsondecoded;
    }
    
    function saveSermon($event)
    {
        $this->db->insert('events',$event);
        $this->db->insert_id()?'yes':'no';
    }
    
    function deleteSermon($id)
    {
        $this->db->delete('events', array('Id' => $id)); 
    }
    
    function updateSermon($id, $event) {
        $this->db->where('Id', $id);
        $this->db->update('events', $event);
    }
}
