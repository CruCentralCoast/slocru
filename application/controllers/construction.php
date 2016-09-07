<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Construction extends CI_Controller
{
	public function index()
	{
            $this->load->view('construction');
            $this->load->view('footer/footer');
	}
}