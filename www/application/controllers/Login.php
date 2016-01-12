<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 16.11.15
 * Time: 15:18
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
/*        $this->load->model('categories','cat',TRUE);*/
        $this->load->model('users','users',TRUE);

        $this->load->helper('url');
        $this->load->helper('html');
    }

    private function addSession($res){
        $this->load->library('session');
        $this->session->set_userdata('login', 'true');
        $this->session->set_userdata('id', $res->id);
        $this->session->set_userdata('type', $res->user_category);
        $this->session->set_userdata('name', $res->Name . ' ' . $res->Surname);
    }

    public function index($noAuth = FALSE, $badAuth = FALSE) {
        //echo 'проверяем post';
        if(isset($_POST['ajax'])) {
            $res = $this->users->login($this->input->post('Login'), $this->input->post('Password'));
            if ($res === false){
                echo 'bagLogin';
                return;
            } else {
                $this->addSession($res);
                echo 'good';
                return;
            }
        } else {

            if ($this->input->post('Login') == '' && $this->input->post('Password') == '') {
//            echo 'мы зашли в post';
                $this->load->view('common/header');
                $this->load->view('login', array('noAuth' => $noAuth, 'badAuth' => $badAuth));
                $this->load->view('common/footer');
                return;
            }
//        echo $this->input->post('Login') . '  ' . $this->input->post('Password') ;
            $res = $this->users->login($this->input->post('Login'), $this->input->post('Password'));
//        echo gettype($res) . "<br/>";
//        echo '<pre>';
//            print_r($res);
//        echo '</pre>';
            if ($res === false) {
                unset($_POST['Login']);
                unset($_POST['Password']);
                $this->index(false, true);

            } else {
                /*$this->load->library('session');
                $this->session->set_userdata('login', 'true');
                $this->session->set_userdata('id', $res->id);
                $this->session->set_userdata('type', $res->user_category);
                $this->session->set_userdata('name', $res->Name . ' ' . $res->Surname);*/
                $this->addSession($res);
                redirect('/');
            }


        }
    }

    public function logout() {
        $this->load->library('session');
        $this->session->sess_destroy();

//        redirect('/');
        redirect($this->input->server('HTTP_REFERER'));
    }
} 