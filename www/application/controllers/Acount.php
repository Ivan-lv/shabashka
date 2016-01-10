<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 16.11.15
 * Time: 17:58
 */

class Acount extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        if (!isset($_SESSION['id'])) {
            redirect('/login/index/true');
        }
        $this->load->model('users','user',TRUE);

    }

    public function index() {
        switch ($_SESSION['type']) {
            case 2:
            case 0: { // заказчик
                $userAdverts = $this->user->getUserCustomerAdverts($_SESSION['id']);

                $data = array(
                    'advertsList' => $userAdverts,
                    'viewName' => 'accountAdverts'
                );
/*                echo '<pre>';
                print_r($userAdverts);
                echo '</pre>';
                return;*/
            }break;

            case 1: { // соискатель
                $userCard = $this->user->getMasterCard($_SESSION['id']);
//                echo '<pre>';
//                print_r($userCard);
//                echo '</pre>';
                $data = array(
                    'userInfo' => $userCard['userInfo'],
                    'Category' => $userCard['Category'],
                    'viewName' => 'accountCard'
                );
            }break;

            default: redirect('login/true');
        }


        $this->load->view('common/header');
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function addEditAdvert($id = FALSE) {
        $this->load->view('common/header');
        $this->load->model('categories', 'categs', TRUE);

        $categs = $this->categs->getCategories();

        for($i = 0; $i < count($categs); $i++) {
            $subcats = $this->categs->getSubCategories($categs[$i]['id']);
            $categs[$i]['subcats'] = $subcats;
        }
        $data['categs'] = $categs;

        if ($id === FALSE) {
            $this->load->view('addEditAdvert', $data);
        } else {


            $this->load->model('adverts', 'adv', TRUE);

            $advertInfo = $this->adv->getAdvertInfo($id);
            $data['advertInfo'] = $advertInfo;
//            echo '<pre>';
//            print_r($advertInfo);
//            echo '</pre>';
            $this->load->view('addEditAdvert', $data);
        }
        $this->load->view('common/footer');



    }

    public function completeOrders() {
        $this->load->view('common/header');

        $ordList = $this->user->getCompleteOrdersList($_SESSION['id']);

        $data = array(
            'ordList'  => $ordList,
            'viewName' => 'completeOrders'
        );
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }


    public function editCard() {
        $this->load->view('common/header');

        $this->load->model('categories', 'categs', TRUE);

        $categs = $this->categs->getCategories();

        for($i = 0; $i < count($categs); $i++) {
            $subcats = $this->categs->getSubCategories($categs[$i]['id']);
            $categs[$i]['subcats'] = $subcats;
        }
        $data['categs'] = $categs;

        $masterInfo = $this->user->getUserCardInfo();
        $data['masterInfo'] = $masterInfo;

//        echo '<pre>';
//        print_r($masterInfo);
//        echo '</pre>';
        $this->load->view('editCard', $data);
        $this->load->view('common/footer');
    }

    public function updateCard() {
        $data = $this->input->post('data');
        $data = json_decode($data,true);

//        print_r($data);
        $this->user->updateUserCard($data);
        echo 0;

    }


    public function myadverts() {
        $userAdverts = $this->user->getUserCustomerAdverts($_SESSION['id']);

        $data = array(
            'advertsList' => $userAdverts,
            'viewName' => 'accountAdverts'
        );


        $this->load->view('common/header');
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function editProfile() {
        $this->load->view('common/header');
        $t = $this->user->getProfileInfo($_SESSION['id']);
        $data = array(
            'userData' => $t[0],
            'viewName' => 'accountEditProfile'
        );
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function saveProfile() {

//        $t = $this->user->hasPhoto($_SESSION['id']);
//        if ($t === FALSE) {
//
//        }
        $data = array(

            'Name'    => $this->input->post('Name'),
            'Surname' => $this->input->post('Surname'),
            'Skype'   => $this->input->post('Skype'),
            'icq'     => $this->input->post('icq'),
            'phone'   => $this->input->post('phone')

        );
        $this->user->updateInfo($data);

        redirect('/acount');
    }

    public function mycard() {
        $this->load->view('common/header');
        $userCard = $this->user->getMasterCard($_SESSION['id']);
//                echo '<pre>';
//                print_r($userCard);
//                echo '</pre>';
        $data = array(
            'userInfo' => $userCard['userInfo'],
            'Category' => $userCard['Category'],
            'viewName' => 'accountCard'
        );

        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function bids() {
        $bids = array();
        if ($_SESSION['type'] == 0 or $_SESSION['type'] == 2) {
            $bids['cutomerBids'] = $this->user->getUserCustomerBids($_SESSION['id']);
        }

        if ($_SESSION['type'] == 1 or $_SESSION['type'] == 2) {
            $bids['masterBids'] = $this->user->getUserMasterBids($_SESSION['id']);
        }

        $data = array(
            'bids' => $bids,
            'viewName' => 'bidsList'
        );
        $this->load->view('common/header');
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function comments() {

        $comments = $this->user->getUserCustomerComments($_SESSION['id']);

//        echo '<pre>';
//        print_r($comments);
//        echo '</pre>';

        $data = array(
            'comments' => $comments,
            'viewName' => 'comments'
        );

        $this->load->view('common/header');
        $this->load->view('account', $data);
        $this->load->view('common/footer');
    }

    public function newAdvert() {
        $advertData = $this->input->post('data');
        $operation = $this->input->post('op');
        $this->load->model('adverts','adv', TRUE);

        $advertData = json_decode($advertData,true);

//        print_r($advertData);

        if ($operation == 'edit') {
            $this->adv->editAdvert($advertData);
        } else {
            $this->adv->setAdvert($advertData);
        }

        echo 0;
    }

    public function removeAdvert($id) {
        //$advertId = $this->input->post('id');
        $this->load->model('adverts','adv', TRUE);
        $this->adv->removeAdvert($id);
        redirect('/acount');
    }

    public function subscribeToBid() { // ajaxHandler
        $advId = $_POST['advID'];
        unset($_POST['advID']);
        $this->load->model('adverts','adv', TRUE);
        $advInf = $this->adv->getAdvertInfById($advId, 'id_customer');
        $params = array(
            'id_usr'       => $_SESSION['id'],
            'id_ordr'      => $advId,
            'id_ord_owner' => $advInf['id_customer'],
            'date'         => date('Y-m-d')
        );
        $InsertedBidId = $this->user->subscribeToAdvert($params);

        if ($InsertedBidId) {
            $bidId = $InsertedBidId;
            $this->load->view('forms/unsubscribeToBidForm', array('bidId' => $bidId));
        } else {
            $this->load->view('errorString');
        }

    }

    public function unsubscribeBid() {
        $id = $_POST['bidId'];
        unset($_POST['bidId']);
        $this->user->deleteBid($id);
    }

    public function  bindMasterToAdvert($advertId, $uid) {
        echo 'aid = ' . $advertId . '  uid = ' . $uid;
        $this->load->model('adverts','adv', TRUE);
        $this->adv->setMasterToAdvert($advertId, $uid);
        //@TODO: нет проверок выполнения запроса и входных данных
        redirect('/acount/bids');
    }
} 