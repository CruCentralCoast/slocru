<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $ch = curl_init();
        $url = 'www.google.com/calendar/feeds/slocrusade@gmail.com/public/full?alt=json&orderby=starttime&max-results=10&singleevents=true&sortorder=ascending&futureevents=true';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($str, true);
        $data['events'] = $str['feed']['entry'];

        $this->load->view('header/header');
        $this->load->view('home', $data);
        $this->load->view('footer/footer');
    }
}