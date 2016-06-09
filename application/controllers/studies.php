<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studies extends CI_Controller {

    public function index() {
        $this->load->view('header/header');
        $this->load->view('studies');
        $this->load->view('footer/footer');
    }

    public function mail() {
        $this->load->helper('url');
        $name = $this->input->post('name');
        $gender = $this->input->post('gender');
        $college = $this->input->post('college');
        $year = $this->input->post('year');
        $dorm = $this->input->post('dorm');
        $room = $this->input->post('room');
        $email = $this->input->post('email');
        $cell = $this->input->post('cell');
        $interests = $this->input->post('interests');
        $notes = $this->input->post('notes');
        $interestArr = array(
            'Asian Americans' => 'tyler.mendoza@cru.org',
            'Athletes' => 'cardennis000@yahoo.com',
            'Greeks' => array('Female' => 'melanie.hanlon@cru.org', 'Male' => 'melanie.hanlon@cru.org'),
            'Latino/Hispanic' => 'esolteroflores@gmail.com',
            'Transfers' => array('rbaca@calpoly.edu','adavis748@yahoo.com')
        );
        $emails = array(
            'Male' => array(
                'Cal Poly SLO' => array(
                    'Freshmen' => array(
                        'Yosemite' => array('wesleyfinkemeier@yahoo.com', 'Thelander.paul@gmail.com', 'jmolnar12@gmail.com', 'naltabet@gmail.com'),
                        'Sierra Madre' => array('jthrew2012@gmail.com', 'cbatch@calpoly.edu', 'lukehannemann2@yahoo.com', 'dvanwork@calpoly.edu'),
                        'Tenaya' => array('arbutruc@calpoly.edu', 'smkmak@sbcglobal.net'),
                        'Trinity' => array('cscheiwe@calpoly.edu', 'savedbytheking7@gmail.com'),
                        'Santa Lucia' => array('Charlie4franklin@gmail.com', 'garrisonjoel8@gmail.com'),
                        'North Mountain' => array('rorystothers@gmail.com'),
                        'Muir' => array('nwilli14@calpoly.edu', 'jon.oyan@gmail.com'),
                        'Fremont' => array('oschwaeg@calpoly.edu', 'jhamilton1510@yahoo.com'),
                        'Sequoia' => array('Bobbyjs33@yahoo.com', 'bradleylubich@gmail.com'),
                        'Cerro Vista' => array('Tannersmar@gmail.com'),
                        'PCV' => array('mnordmann40036@gmail.com','tjcanales57@gmail.com'),
                        'Other' => array('jacobkissack@gmail.com')
                    ),
                    'Sophomore' => 'jacobkissack@gmail.com',
                    'Junior' => 'jacobkissack@gmail.com',
                    'Senior' => 'jacobkissack@gmail.com',
                    'Senior plus' => 'jacobkissack@gmail.com'
                ),
                'Cuesta' => 'jacobkissack@gmail.com'
            ),
            'Female' => array(
                'Cal Poly SLO' => array(
                    'Freshmen' => array(
                        'Yosemite' => array('jonihillebrecht@yahoo.com', 'msulli19@calpoly.edu', 'lorenjackson16@yahoo.com'),
                        'Sierra Madre' => array('abbyeelsing@aol.com'),
                        'Tenaya' => array('Jessica.walter22@yahoo.com', 'katherineperilloux@gmail.com'),
                        'Trinity' => array('gpappas@calpoly.edu', 'mfernald@calpoly.edu', 'eridenho@calpoly.edu', 'amclagga@calpoly.edu'),
                        'Santa Lucia' => array('khicks03@calpoly.edu', 'awong76@calpoly.edu'),
                        'North Mountain' => array('nicholeg3@yahoo.com'),
                        'Muir' => array('amidoriwong@gmail.com', 'eringriffin003@gmail.com'),
                        'Fremont' => array('sziegler@calpoly.edu', 'mmerseth@calpoly.edu'),
                        'Sequoia' => array('mjreis@calpoly.edu', 'katiejo@gmail.com'),
                        'Cerro Vista' => array('matisoonyz@yahoo.com', 'annamcc94@att.net', 'aparke04@calpoly.edu', 'blairemcc@att.net'),
                        'PCV' => array('mblundel@calpoly.edu', 'eflickne@calpoly.edu','scsampson11@gmail.com','mpstickles08@gmail.com','amandamccaulley@ymail.com'),
                        'Other' => array('dana.williamson@cru.org')
                    ),
                    'Sophomore' => 'dana.williamson@cru.org',
                    'Junior' => 'dana.williamson@cru.org',
                    'Senior' => 'dana.williamson@cru.org',
                    'Senior plus' => 'dana.williamson@cru.org'
                ),
                'Cuesta' => array('samlndsy@charter.net','cdhodges33@yahoo.com','emilywiller@gmail.com','hjanenoll@cox.net')
            )
        );
        if (gettype($emails[$gender][$college]) === 'string')
            $use_email = array($emails[$gender][$college]);
        else {
            if (gettype($emails[$gender][$college][$year]) === 'string')
                $use_email = array($emails[$gender][$college][$year]);
            else
                $use_email = $emails[$gender][$college][$year][$dorm];
        }

        if (!empty($interests))
        {
            foreach ($interests as $value)
            {
                if ($value === 'Greeks')
                    array_push($use_email, $interestArr[$value][$gender]);
                else
                {
                    if ($value === 'Transfers' && $gender === 'Male') {}
                    else
                        array_push($use_email, $interestArr[$value]);
                }
            }
        }
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.slocrusade.com',
            'smtp_port' => 26,
            'smtp_user' => 'admin+slocrusade.com',
            'smtp_pass' => 'romans125',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('admin@slocru.com');
        $this->email->to($use_email);
        $this->email->bcc('admin@slocru.com');

        $this->email->subject('Student interested in a Bible Study!');
        $str = 'This student is interested in a bible study. Please contact them as soon as possible. Thank you!<br/><br/>';
        $str .= 'Name: ' . $name . '<br/>';
        $str .= 'Gender: ' . $gender . '<br/>';
        $str .= 'College: ' . $college . '<br/>';
        $str .= 'Year in school: ' . $year . '<br/>';
        if ($year === 'Freshmen' && $college !== 'Cuesta') {
            $str .= 'Dorm: ' . $dorm . '<br/>';
            $str .= 'Room: ' . $room . '<br/>';
        }
        $str .= 'Email: ' . $email . '<br/>';
        $str .= 'Cell: ' . $cell . '<br/>';
        if (!empty($interests)) {
            $str .= 'Interests: <br/>';
            foreach ($interests as $value) {
                $str .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $value . '<br/>';
            }
        }
        $str .= 'Notes: ' . $notes . '<br/>';
        $str .= '<br/>--Admin';
        $this->email->message($str);
        $this->email->send();
        $this->session->set_flashdata('email_response',true);
        redirect('/studies', 'refresh');
    }

}
