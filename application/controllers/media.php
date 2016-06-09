<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {

    public function index() {
        $this->load->library('twitterapiexchange');
        $this->load->model('event_model', '', true);

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?q=from:slocru+OR+from:jameypappas&count=10';
        $requestMethod = 'GET';

        $twitter = new Twitterapiexchange();
        $json = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();
        $data['tweets'] = json_decode($json, true);

        $this->load->view('header/header');
        $this->load->view('media', $data);
        $this->load->view('footer/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */