<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Involvement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('event_model', '', true);
    }
    
    public function index() {
        
        $result = $this->event_model->getEvents();
        $data['events'] = $result;

        $this->load->view('header/header');
        $this->load->view('involvement', $data);
        $this->load->view('footer/footer');
    }
}