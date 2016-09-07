<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('event_model', '', true);
    }
    
    /*public function index()
    {
        $result = $this->event_model->getEvents();
        $data['events'] = $result;
        $this->load->view('header/header');
        $this->load->view('events', $data);
        $this->load->view('footer/footer');
    }*/
    public function _remap($method)
    {
        $result = $this->event_model->getEvents();
        //If we only want to show upcomming events
        /*$currentDate = strtotime("now");
        $data['events'] = [];
        foreach($result as $event) {
            
            if((strtotime($event->Date) - $currentDate) > 0) {
                array_push($data['events'], $event);
            }
        }*/
        $data['events'] = $result;
        
        $data['selectedevent'] = 0;
        if($method !== 'empty')
        {
            $data['directlink'] = $method;
        }
        $this->load->view('header/header');
        $this->load->view('events', $data);
        $this->load->view('footer/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */