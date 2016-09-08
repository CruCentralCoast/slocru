<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Literature extends CI_Controller {

    public function index() {
        $this->load->view('header/header');
        $this->load->view('literature');
        $this->load->view('footer/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */