<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sermons extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('sermon_model', '', true);
    }

    public function _remap($method)
    {
        $result = $this->sermon_model->getSermons();
        $data['sermons'] = $result["items"];
        $this->load->view('header/header');
        $this->load->view('sermons', $data);
        $this->load->view('footer/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */