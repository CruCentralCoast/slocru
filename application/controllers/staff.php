<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Staff extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('staff_model', '', true);
    }
    
    public function index() {
        
        $data['mtl'] = $this->staff_model->getMTL();
        $data['staff'] = $this->staff_model->getStaff();
        $data['intern'] = $this->staff_model->getIntern();
        $this->load->view('header/header');
        $this->load->view('staff',$data);
        $this->load->view('footer/footer');
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */