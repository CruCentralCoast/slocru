<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{
    
	public function index()
	{
            $this->load->helper('form');
            $data['match'] = NULL;
            if($login = $this->input->post())
            {
                $this->load->database();
//                $result = $this->db->query('SELECT * FROM User');
//                $result = $result->result();
//                $login['username'];
//                $login['email'];
//                $login['password'];
//                $login['confirm_password'];
                if($login['password'] !== $login['confirm_password'])
                {
                    $data['match'] = 'ERROR';
                    $this->load->view('header/header');
                    $this->load->view('register', $data);
                    $this->load->view('footer/footer');
                }
                else
                {
                    $user = array(
                        'username' => $login['username'],
                        'password' => crypt($login['password'], $login['username']),
                        'email' => $login['email']
                    );
                    $this->db->insert('potential_user', $user);
                    $this->load->view('header/header');
                    $this->load->view('register', $data);
                    $this->load->view('footer/footer');
//                    echo $hash = crypt($login['password'], $login['username']);
//                    echo '<br/>';
//                    echo crypt($login['password'], $hash);
                }
            }
            else
            {
                $this->load->view('header/header');
                $this->load->view('register', $data);
                $this->load->view('footer/footer');
            }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
