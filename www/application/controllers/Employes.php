<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 14.11.15
 * Time: 1:37
 */

class Employes extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users','user',TRUE);
        $this->load->helper('url');
        $this->load->helper('html');

    }

    public function index() {
        $data['masters'] = $this->user->findUserMaster();
        $this->load->view('common/header');
        $this->load->view('findEmpCnt',$data);
        $this->load->view('common/footer');
    }

    public function card($id = 0) {

        if($id < 1) {
            return;
        }
        $data = $this->user->getMasterCard($id);
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
        $this->load->view('common/header');
        $this->load->view('masterCard',$data);
        $this->load->view('common/footer');
    }
} 