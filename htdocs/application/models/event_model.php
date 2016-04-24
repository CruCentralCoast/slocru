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
    /*function getEvents()
    {
        $result = $this->db->select('*')->from('events')->order_by('date')->get();
        return $result->result();
    }*/

    function getEvents() {
        $response = http_get("http://androidcru-prod.jonamireh.com/api/events");
        $body = http_parse_message($response)->body;
        // return $body;
        // print_r(json_decode($body));
        return json_decode($body);
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