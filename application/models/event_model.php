<?php
class Event_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getEvents() {
        $response = http_get(constant("API_URL") . "/api/events");
        $body = http_parse_message($response)->body;
        $body = json_decode($body);
        return $body;
    }
}