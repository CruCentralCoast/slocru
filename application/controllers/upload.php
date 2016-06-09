<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        if(!($test = $this->input->post('some_data')))
        {
            $this->load->view('upload');
        }
        else
        {
            echo $test;
        }
            
    }
}