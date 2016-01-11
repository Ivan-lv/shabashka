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
        $this->load->library('session');
    }

    public function index() {
        //header('Location: /jobs/last');
        redirect('/jobs/last');
    }

    public  function last() {
        $per_page = 5;

        $this->load->library('pagination');
        $countAll = $this->adverts->countActiveAdverts();
        $config = $this->paginationInit(site_url('/jobs/last'), $countAll, $per_page);
        $this->pagination->initialize($config);
        $advertsList = $this->adverts->getLastAdverts($per_page, $this->uri->segment(3));
        $categs = $this->catgs->getCategories();

        $data = array(
            'advertsList' => $advertsList,
            'categs'      => $categs
        );
        $this->load->view("common/header");
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

            if (! $advertInfo['sessionInfo']['isOwner'] && $_SESSION['type'] != 0 ) {
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

    private  function pagDemo() {
        $per_page = 2;
        $this->load->library('pagination');
        $countAll = $this->adverts->countAll();
        $config = $this->paginationInit(site_url('/jobs/pagDemo/'), $countAll, 2);
        $this->pagination->initialize($config);
        $data['adverts'] = $this->adverts->getDemoAdverts($config['per_page'], $this->uri->segment(3));

        $this->load->view('common/header');
        $this->load->view('pagination_demo', $data);
        $this->load->view('common/footer');
    }

    public function find($idCat = FALSE, $idSubcat = FALSE) {

        if($this->input->post('params')) { // если пришло из ajax
            $params = $this->input->post('params');
            $params = json_decode($params,true);
        } else {
            $params['category']    = $idCat;
            $params['subcategory'] = $idSubcat;
            $params['sortBy'] = 'date';
            $params['count'] = 5;
            $categs = $this->catgs->getCategories();
            $subCats = $this->catgs->getSubCategories($idCat);
        }
        $per_page = $params['count'];
        $offset = ($idCat && $idSubcat) ? $this->uri->segment(5) : $this->uri->segment(3);
        $countAll = $this->adverts->findAdverts($params, $offset, true);
        $this->load->library('pagination');
        $config = $this->paginationInit(site_url('/jobs/find'), $countAll, $per_page);
        $this->pagination->initialize($config);
        $advertsList = $this->adverts->findAdverts($params, $offset);

        //выбираем как будем выводить: либо для ajax либо как полная страница
        if($idCat && $idSubcat) {
            $this->load->view("common/header");
            $data = array(
                'advertsList'    => $advertsList,
                'categs'         => $categs,
                'subCats'        => $subCats,
                'selectedCat'    => $idCat,
                'selectedSubcat' => $idSubcat
            );
            $this->load->view("findJobCnt", $data);
            $this->load->view("common/footer");
            return;
        }
        $this->load->view('ordSearchRes', array('advertsList' => $advertsList));
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

    public function addComment() {

        $userId = $this->session->userdata('id');
        $commentText = $_POST['commentText'];
        $advId = $_POST['pageId'];
        $commentText = htmlspecialchars($commentText);
        $advId = htmlspecialchars($advId);
        $date = date('Y-m-d H:i:s');
        $data = array(
            'text'     => $commentText,
            'order_id' => $advId,
            'user_id'  => $userId,
            'date'     => $date
        );
        $lastId = $this->adverts->addComment($data);
        $this->load->model('users', 'users', TRUE);
        $userInfo = $this->users->getUserInfo($userId);

        $data = array(
            'userInfo'  => $userInfo,
            'comment'   => array(
                    'id'   => $lastId,
                    'text' => $commentText,
                    'date' => $date
            )
        );
        $this->load->view("commentBlock", $data);
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
} 