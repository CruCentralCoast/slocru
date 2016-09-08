<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('event_model', '', true);
    }

    public function index() {
        $this->load->library('twitterapiexchange');

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=slocru&count=10';
        $requestMethod = 'GET';

        $twitter = new Twitterapiexchange();
        $json = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();
        $data['tweets'] = json_decode($json, true);

        /*$ch = curl_init();
        $url = 'www.google.com/calendar/feeds/slocrusade@gmail.com/public/full?alt=json&orderby=starttime&max-results=10&singleevents=true&sortorder=ascending&futureevents=true';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($str, true);
        if(isset($str['feed']['entry']))
            $data['events'] = $str['feed']['entry'];
        */
        $result = $this->event_model->getEvents();
        $data['events'] = $result;

        $this->load->view('header/header');
        $this->load->view('home', $data);
        $this->load->view('footer/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */