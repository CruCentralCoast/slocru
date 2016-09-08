<?php
class Event_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Function to return event informtion
     */
    function getEvents()
    {
        $result = $this->db->select('*')->from('events')->order_by('date')->get();
        return $result->result();
    }
    
    function saveEvent($event)
    {
        $this->db->insert('events',$event);
        $this->db->insert_id()?'yes':'no';
    }
    
    function deleteEvent($id)
    {
        $this->db->delete('events', array('Id' => $id)); 
    }
    
    function updateEvent($id, $event) {
        $this->db->where('Id', $id);
        $this->db->update('events', $event);
    }
}