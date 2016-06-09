<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ministry extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ministry_model', '', true);
    }

    public function _remap($info) {
        if ($info == 'mail') {
            $this->load->helper('url');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $cell = $this->input->post('cell');
            $notes = $this->input->post('notes');
            $tls = $this->input->post('tls');
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'just140.justhost.com',
                'smtp_port' => 26,
                'smtp_user' => 'admin@slocru.com',
                'smtp_pass' => 'romans125',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('admin@slocru.com');
            $this->email->to($tls);
            $this->email->bcc('admin@slocru.com');

            $this->email->subject('Student interested your ministry team!');
            $str = 'This student is interested in your ministry team. Please contact them as soon as possible. Thank you!<br/><br/>';
            $str .= 'Name: ' . $name . '<br/>';
            $str .= 'Email: ' . $email . '<br/>';
            $str .= 'Cell: ' . $cell . '<br/>';
            $str .= 'Notes: ' . $notes . '<br/>';
            $str .= '<br/>--Admin';
            $this->email->message($str);
            $this->email->send();
            redirect('/ministry', 'refresh');
        }

        $data = array();
        if ($info == 'prayer')
            $data['prayer'] = true;
        $result = $this->ministry_model->getMinistryTeams();
        $data['ministry'] = $result;
        $this->load->view('header/header');
        $this->load->view('ministry', $data);
        $this->load->view('footer/footer');
    }

}
