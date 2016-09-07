<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Missions extends CI_Controller
{
	public function index()
	{
            $this->load->view('header/header');
            $this->load->view('missions');
            $this->load->view('footer/footer');
	}
}