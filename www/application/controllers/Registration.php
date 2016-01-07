<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 16.11.15
 * Time: 2:36
 */

class Registration extends CI_Controller {
    public function __construct() {
        parent::__construct();
//        $this->load->model('categories','cat',TRUE);
        $this->load->model('users','users',TRUE);
        $this->load->helper('url');
        $this->load->helper('html');

    }

    public function index() {

        $this->load->view('common/header');
        $this->load->view('registrationCnt');


        $this->load->view('common/footer');
    }

    public function check() {
        $loginStr = $this->input->post('data');
//        echo $loginStr;

        $response = $this->users->checkLogin($loginStr);
        echo ($response === true) ? '0' : '1';
//        $this->load->view('response',$data);
    }

    public function newUser() {
        $userData = $this->input->post('data');

        $t = json_decode($userData,true);
        $this->users->registration($t);
//        print_r($t);
        //@todo: изменить ддальше код:
        echo '0';
    }
}


