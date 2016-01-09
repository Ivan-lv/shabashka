<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 14.11.15
 * Time: 1:38
 */

class Jobs extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
//        $this->load->model('categories','cat',TRUE);
        $this->load->model('adverts', 'adverts', TRUE);
        $this->load->model('categories', 'catgs', TRUE);
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function index() {

        $this->load->view("common/header");
        $advertsList = $this->adverts->getLastAdverts();
        $categs = $this->catgs->getCategories();

        $data = array(
            'advertsList' => $advertsList,
            'categs'      => $categs
        );

        $this->load->view("findJobCnt", $data);
        $this->load->view("common/footer");
    }

    public function show($id) {
        $this->load->view("common/header");
        $advertInfo = $this->adverts->getAdvert($id);

        /* если пользователь не владелец объявления, то проверяем подал ли заявку этот пользователь */
        if(isset($_SESSION['id'])) {
            $advertInfo['sessionInfo']['isOwner'] =
                ($_SESSION['id'] == $advertInfo['ownerData'][0]['id']) ? true : false;

            if (! $advertInfo['sessionInfo']['isOwner']) {
                $bidInfo = $this->adverts->hasBid($_SESSION['id'], $id);
                if ($bidInfo) {
                    $advertInfo['sessionInfo']['bidInfo'] = $bidInfo;
                }
            }
        }

        /*
        echo '<pre>';
        print_r($advertInfo);
        echo '</pre>';
        */
        $this->load->view('advertPage',$advertInfo);
        $this->load->view("common/footer");
    }

    public function find() {
        $params = $this->input->post('params');
        $params = json_decode($params,true);


//        print_r($params);
        $res = $this->adverts->findAdverts($params);
        $this->load->view('ordSearchRes', array('advertsList' => $res));

//        $this->load->view("header");
//
//        $data = array();
//        $this->load->view("findJobCnt", $data);
//
//        $this->load->view("footer");



    }

    public function getSubcategories() {
        $idCat = $this->input->post('idCat');
        $subCats = $this->catgs->getSubCategories($idCat);
        $html = "<option value='0'></option>";
        foreach($subCats as $subCat) {
            $html .= "<option value=\"$subCat[id]\">$subCat[name]</option>";
        }
        echo $html;
    }
} 