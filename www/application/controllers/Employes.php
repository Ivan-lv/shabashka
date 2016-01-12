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
//        $this->load->model('categories','cat',TRUE);
        $this->load->model('users','users',TRUE);
        $this->load->model('categories', 'catgs', TRUE);
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
    }

    public function index() {
        $masters = $this->users->findUserMaster();
        $categs = $this->catgs->getCategories();

        $data = array(
            'masters' => $masters,
            'categs'      => $categs
        );

        $this->load->view('common/header');
        $this->load->view('findEmpCnt',$data);
        $this->load->view('common/footer');
    }

    public function find($idCat = FALSE, $idSubcat = FALSE) {

        if($this->input->post('params')) { // если пришло из ajax
            $params = $this->input->post('params');
            $params = json_decode($params,true);
        } else {
            /*$params['category']    = $idCat;
            $params['subcategory'] = $idSubcat;
            $params['sortBy'] = 'rating';
            $params['count'] = 5;*/
            /*$categs = $this->catgs->getCategories();
            $subCats = $this->catgs->getSubCategories($idCat);*/
        }


        /*$per_page = $params['count'];
        $offset = ($idCat && $idSubcat) ? $this->uri->segment(5) : $this->uri->segment(3);
        $countAll = $this->users->countAllUsers();
        $this->load->library('pagination');
        $config = $this->paginationInit(site_url('/Employes'), $countAll, $per_page);
        $this->pagination->initialize($config);*/

        $masters = $this->users->findUserMaster($params['category'],$params['subcategory'],$params['count'],$params['sortBy']);

        //выбираем как будем выводить: либо для ajax либо как полная страница
        /*if($idCat && $idSubcat) {
            $this->load->view("common/header");
            $data = array(
                'masters'    => $masters,
                'categs'         => $categs,
                'subCats'        => $subCats,
                'selectedCat'    => $idCat,
                'selectedSubcat' => $idSubcat
            );
            $this->load->view("findEmpCnt", $data);
            $this->load->view("common/footer");
            return;
        }*/
        $this->load->view('emplResults', array('masters' => $masters));
        return;
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

    private function paginationInit($base_url, $total_rows, $per_page) {
        $config['base_url'] = $base_url;//site_url('/jobs/pagDemo/');
        $config['total_rows'] = $total_rows;//
        $config['per_page'] = $per_page;//2;
        $config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = "</a></li>";
        $config['first_link'] = 'В начало';
        $config['last_link'] = 'В конец';
        $config['next_link'] = '»';
        $config['prev_link'] = '«';

        return $config;
    }
    /*public function __construct()
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
    }*/
} 