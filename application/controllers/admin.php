<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model', '', true);
        $this->load->model('event_model', '', true);
    }

    public function index() {

        //Load header
        $this->load->view('header/header');

        //If user is logged in as an admin, bring up the admin page
        if ($this->session->userdata('admin')) {
            $data = array();
            $data = $this->setUpPage($data);
            $this->load->view('adminpage', $data);

            //If there is login information
        } elseif ($this->input->post('username') && $this->input->post('password')) {

            //Get username and password from form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //Get user info from database
            $result = $this->user_model->getUsers($username);
            $result = $result[0];

            //Compare password
            if ($result->password == crypt($password, $result->password)) {
                $this->session->set_userdata('admin', true);
                $data = array();
                $data = $this->setUpPage($data);
                $this->load->view('adminpage', $data);

                //If incorrect, bring up login page again
            } else {
                $this->load->view('adminlogin');
            }
            //Bring up login page
        } else {
            $this->load->view('adminlogin');
        }

        //Load footer
        $this->load->view('footer/footer');
    }

    public function logout() {
        $this->session->unset_userdata('admin');
        redirect('/home', 'refresh');
    }

    function setUpPage($data) {
        $result = $this->event_model->getEvents();
        $data['events'] = $result;
        return $data;
    }
    
    public function newevent() {
        $insert = array(
            'Name' => $this->input->post('name'),
            'Date' => $this->input->post('date'),
            'StartTime' => $this->input->post('starttime'),
            'EndTime' => $this->input->post('endtime'),
            'Location' => $this->input->post('location'),
            'Description' => $this->input->post('description'),
            'Link' => $this->input->post('outsidelink'),
            'ShowSlide' => $this->input->post('display') === 'on'?1:0,
            'DirectLink' => $this->input->post('directlink'),
        );
        $this->event_model->saveEvent($insert);
        redirect('/admin','refresh');
    }
    
    public function deleteevent($id) {
        $this->event_model->deleteEvent($id);
        redirect('/admin','refresh');
    }
    
    public function updateevent($id) {
        $event = array(
            'Name' => $this->input->post('name'),
            'Date' => $this->input->post('date'),
            'StartTime' => $this->input->post('starttime'),
            'EndTime' => $this->input->post('endtime'),
            'Location' => $this->input->post('location'),
            'Description' => $this->input->post('description'),
            'Link' => $this->input->post('outsidelink'),
            'ShowSlide' => $this->input->post('display') === 'on'?1:0,
            'DirectLink' => $this->input->post('directlink'),
        );
        
        $this->event_model->updateEvent($id, $event);
        redirect('/admin','refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
