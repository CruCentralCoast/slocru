<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Literature extends CI_Controller {

    public function index() {
        $this->load->view('header/header');
        $this->load->view('leadership');
        $this->load->view('footer/footer');
    }
}