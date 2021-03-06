<?php


class Users extends CI_Model{
	
	public function getTheBestUserMaster($count = 5, $orderBy = 'DESC', $offset = 0){
		$q = $this->db->select('*')
			->from('user')
			->where('user_category =','1')
			->or_where('user_category =','2')
			->order_by('rating', $orderBy)
			->limit($count,$offset);

		return $q->get()->result_array();
	}

    public function getMasterCard($userid){
        $q = $this->db->select( array('Name', 'Surname', 'Skype', 'icq', 'phone', 'photo', 'text', 'rating', 'orders_complete'))
            ->from('user')
            ->where('id =', $userid)->get();
        $mas['userInfo'] = $q->result_array();
        $mas['userInfo'] = $mas['userInfo'][0];
        $this->db->reset_query();
        $this->db->select('subcategory.name','subcategory.id')
            ->from(array('subcategory', 'user_cat'))
            ->where('user_cat.id_user =', $userid)
            ->where('user_cat.id_subcategory = subcategory.id');


        $mas["Category"] = $this->db->get()->result_array();
        return $mas;
    }

    /* информация о выполненных заказах */
    public function getCompleteOrdersList($id) {
        $this->db
            ->select(array('user.Name', 'user.Surname', 'order.price', 'category.name'))
            ->from(array('order', 'user', 'category', 'order_cat'))
            ->where('order.id_worker =', $id)
            ->where('order.id_customer = user.id')
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id');

        return $this->db->get()->result_array();

    }

    /* информация для страницы редактирования карточки в личном кабинете */
    public function getUserCardInfo() {
        $this->db
            ->select(array('id','text'))
            ->from('user')
            ->where('id = ', $_SESSION['id']);

        $result = $this->db->get()->result_array();
        $result = $result[0];

        $this->db->reset_query();

        $this->db
            ->select('*')
            ->from('user_cat')
            ->where('id_user = ', $result['id']);
        $t = $this->db->get()->result_array();

        $idSubcats = array();
        foreach($t as $item) {
            array_push($idSubcats, $item['id_subcategory']);
        }
        $result['idSubcats'] = $idSubcats;
        return $result;
    }

    /* обновление информации о каточке пользователя */
    public function updateUserCard($data) {
        $this->db
            ->where('id = ', $_SESSION['id'])
            ->update('user', array('text' => $data['text']));
        $this->db->reset_query();

        $this->db
            ->where('id_user = ', $_SESSION['id'])
            ->delete('user_cat');
        $this->db->reset_query();

        foreach($data['ids'] as $subCat) {
            $t = array(
                'id_user'        => $_SESSION['id'],
                'id_category'    => $subCat['idCat'],
                'id_subcategory' => $subCat['idSubcat']
            );
            $this->db
                ->insert('user_cat', $t);
            $this->db->reset_query();
        }

    }

	public function findUserMaster($category = 0 , $subcategory = 0, $count = 5, $sortBy = 'rating'){
        $this->db->distinct(array('user.id', 'user.Name', 'user.Surname', 'user.photo', 'user.rating', 'user.orders_complete','text'))
            ->from('user')
            ->where_in('user_category', array('1','2'))
            ->order_by($sortBy, 'DESC');
        if ($category != 0 && $subcategory != 0) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_subcategory = ', $subcategory)
                ->where('user_cat.id_category = ', $category);
        } elseif ($subcategory !== 0) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_subcategory = ', $subcategory);
        } elseif ($category !== 0 ) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_category = ', $category);
        }
        return $this->db->limit($count)->get()->result_array();
        //return $this->db->query("SELECT * FROM shab.user WHERE (user.user_category ='1' OR user.user_category = '2') AND user.rating > 1 order by user.rating DESC ")->result_array();

	}

    public function findUserMasterr($params, $offset, $isCount = FALSE){

        $category    = $params['category'];
        $subcategory = (isset($params['subcategory'])) ? $params['subcategory'] : 0;
        $count       = $params['count'];
        $sortBy      = $params['sortBy'];

        $this->db->distinct(array('user.id', 'user.Name', 'user.Surname', 'user.photo', 'user.rating', 'user.orders_complete','text'))
            ->from('user')
            ->where_in('user_category', array('1','2'))
            ->order_by($sortBy, 'DESC');
        if ($category != 0 && $subcategory != 0) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_subcategory = ', $subcategory)
                ->where('user_cat.id_category = ', $category);
        } elseif ($subcategory !== 0) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_subcategory = ', $subcategory);
        } elseif ($category !== 0 ) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id')
                ->where('user_cat.id_category = ', $category);
        }

        if($isCount) {
            return count($this->db->get()->result_array());
        }

        return $this->db->limit($count, $offset)->get()->result_array();
        //return $this->db->query("SELECT * FROM shab.user WHERE (user.user_category ='1' OR user.user_category = '2') AND user.rating > 1 order by user.rating DESC ")->result_array();

    }

    public function  login($login, $pass)
    {
        $q = $this->db->select(array('id','user_category', 'Name', 'Surname'))
            ->from('user')
            ->where('Login =',$login)
            ->where('Password=', $pass)
            ->get();
        if ($q->num_rows() == 1)
            return $q->row();
        else return false;
    }

    public function logout() {

    }

    public function countAllUsers() {
        $this->db->where('user_category = ', 1);
        $this->db->or_where('user_category = ', 2);
        return $this->db->count_all_results('user');
    }

    public function checkLogin($loginString){
        $q = $this->db->select('id')
            ->from('user')
            ->where('Login =',$loginString)->get();
        if ($q->num_rows() == 0)
            return true;
        else return false;
    }
	
	public function  registration ($usrData)
    {
        try {
            return $this->db->insert('user', $usrData);
            /*  $usrData = [
             *              "Login" => "login",
             *              "Password" => "pas",
             *              "Name" => "name",
             *              "Surname" => "sname",
             *              "user_category"=> "(int)User_category"
             *              ];
             *                                      User_category
		     *                                              0 - Заказчик
		     *                                              1 - Соискатель
		     *                                              2 - Заказчик и Соискатель
             * */
//            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function setUserCategoryAndText($categoryList, $usertext, $userid)  //Список id подкатегорий и текст(about me)
    {
        try {
            $this->db->update('user', $usertext, 'id = ', $userid)->get();

            $q = $this->db->select('id_cat')
                ->from('subcategory')
                ->where_in('id = ', $categoryList)
                ->get();

            for ($i = 0; $i <= $categoryList . count(); $i++) {
                $this->db->query("INSERT INTO `user_cat` (id_category, id_subcategory) VALUES($categoryList[$i], q[$i])
                                  ON DUPLICATE KEY UPDATE id_category = $categoryList[$i], id_subcategory =  q[$i] WHERE id_user = $userid");
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateInfo($data) {

/*        echo '<pre>';
        print_r($data);
        echo '</pre>';*/
        $this->db
            ->where('id=', $_SESSION['id'])
            ->update('user', $data);
    }

    public function getProfileInfo($id) {
        $this->db
            ->select(array('photo', 'Name', 'Surname', 'icq', 'Skype','phone'))
            ->from('user')
            ->where('id =', $id);

        return $this->db->get()->result_array();
    }

    public function setUserCard($usrData) //Возвращаю цифру, а не boolean
    {
        try {
            $q = $this->db->select('Password')
                ->from('user')
                ->where('id =', $usrData["'id'"])->get();
            if ($q === $usrData["'Password'"]) {
                $this->db->update('user', $usrData, 'id = ', $usrData["'id'"])->get();
                /*  $usrDate = [
                                "id" => "(int)"
                 *              "Skype => "(int)",
                 *              "icq" => "(int)",
                 *              "phone" => "(int)",
                 *              "Password" => "pass",
                 *              "Name" => "name",
                 *              "Surname" => "sname",
                 *              ];
                 *  Если поле пустое, то элемент (ключ) вообще не создавай, иначе не сработает
                 *      Ну либо пиши и я тут буду править
                 * */
                return 2; //Пароли не совпали
            } else return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getUserCustomerAdverts($userid, $count = 10, $sortBy = 'date') {
        $this->db->distinct()
            ->select(array('order.id_worker','order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date', 'category.name'))
            ->from(array('order', 'category', 'order_cat'))
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id')
            ->where('order.id_customer =', $userid)
            ->where('order.status =', 0)
            ->group_by('title');
        if ($sortBy != 'status')
            $this->db->order_by($sortBy, 'DESC');
        else {
            $this->db->order_by($sortBy, 'DESC');
        }
        $adverts['active'] = $this->db->limit($count)->get()->result_array();
        $this->db->reset_query();

        $this->db->distinct()
            ->select(array('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date', 'category.name'))
            ->from(array('order', 'category', 'order_cat'))
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id')
            ->where('order.id_customer =', $userid)
            ->where('order.status =', 1)
            ->group_by('title');
        if ($sortBy != 'status')
            $this->db->order_by($sortBy, 'DESC');
        else {
            $this->db->order_by($sortBy, 'DESC');
        }
        $adverts['completed'] = $this->db->limit($count)->get()->result_array();
        return $adverts;

    }

    public function getUserCustomerBids($userid) {
        $this->db->select(array('title', 'order.id', 'id_worker'))
            ->from('order')
            ->where('id_customer = ', $userid)
            ->where('status = ', 0);
        $orders = $this->db->get()->result_array();
        $this->db->reset_query();
        for($i = 0; $i < count($orders); $i++) {
            $this->db->select(array('bid.date', 'user.Name', 'user.Surname', 'user.id'))
                ->from(array('bid', 'user'))
                ->where('bid.id_usr = user.id')
                ->where('bid.id_ordr =', $orders[$i]['id']);

            $orders[$i]['bids'] = $this->db->get()->result_array();
            $this->db->reset_query();
        }

        return $orders;
    }

    public function getUserMasterBids($uid) {
        $this->db
            ->select(array('bid.date', 'order.id as orderID', 'order.title', 'bid.id as bidID', 'bid.id_ord_owner'))
            ->from(array('bid', 'order'))
            ->where('order.id = bid.id_ordr')
            ->where('bid.id_usr', $uid);
        $r = $this->db->get()->result_array();

        return $r;
    }

    public function getUserCustomerComments($userid, $count = 10, $sortBy = 'date') {

        $this->db->distinct()
            ->select(array('order.id', 'order.title'))
            ->from(array('order'))
            ->where('order.id_customer =', $userid);
        $mas = $this->db->get()->result_array();
        $this->db->reset_query();

        if (count($mas) == 0) { //
            return array();
        }

        $advertsIds = array();
        foreach($mas as $m) {
            array_push($advertsIds, $m['id']);
        }

        $this->db->select(array('comment.date', 'comment.text', 'user_id','comment.id','comment.order_id'))
            ->from(array('comment'))
            ->where_in('comment.order_id', $advertsIds)
//            ->where('order.id = ', $comments[$i]['order_id']);
            ->order_by('date','DESC');
        $comments =  $this->db->get()->result_array();
        $this->db->reset_query();

        for($i = 0; $i < count($comments); $i++) {
            $this->db
                ->select(array('Name', 'Surname', 'photo', 'rating','order.title'))
                ->from(array('user', 'order'))
                ->where('user.id = ', $comments[$i]['user_id'])
                ->where('order.id = ', $comments[$i]['order_id']);
            $t = $this->db->get()->result_array();
            $comments[$i]['masterInfo'] = $t[0];
        }
        return $comments;
    }

    public function getUserProfileCustomer($userid, $count = 3, $sortBy = 'date'){
        $this->db->distinct()
            ->select(array('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date', 'category.name'))
            ->from(array('order', 'category', 'order_cat'))
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id');
        if ($sortBy != 'status')
            $this->db->order_by($sortBy, 'DESC');
        else {
            $this->db->order_by($sortBy);
        }
        $mas["Adverts"] = $this->db->limit($count)->get()->result_array();
        $this->db->reset_query();

        $this->db
            ->select(array('bid.date', 'user.name', 'user.Surname', 'user.id', 'order.title'))
            ->from(array('bid', 'order', 'user'))
            ->where('order.id_customer =', $userid)
            ->where('order.id = bid.id_ordr')
            ->where('bid.id_usr = user.id');

        $mas["Bids"] = $this->db->get()->result_array();
        $this->db->reset_query();

        $this->db->select(array('date, text', 'user_id'))
            ->from('comment')
            ->where('comment.order_id =', $mas["Adverts"]["order.id"])
            ->order_by('date','DESC');
        $mas["CommentBody"] = $this->db->get()->result_array();

        return $mas;
    }

    //подача заявки пользователем
    function subscribeToAdvert($params) {
        $this->db->insert('bid', $params);
        $lastId = $this->db->insert_id();
        return $lastId;
    }

    // отписка от заявки
    function deleteBid($id) {
        $this->db->delete('bid', array('id' => $id));
    }

    //вся информация о пользователе по id
    function getUserInfo($id) {
        $q = $this->db->select('*')
            ->from('user')
            ->where('id = ', $id)
            ->get();
        $res = $q->result_array();
        return $res[0];
    }

    //пересчитать рэйтинг
    function setRating($idWorker, $rating) {
        $q = $this->db->select(array('orders_complete','agr_rating'))
            ->from('user')
            ->where('id = ', $idWorker)
            ->get();
        $res = $q->result_array();
        $this->db->reset_query();
        $res = $res[0];
        $res['agr_rating'] = ($res['agr_rating'] === NULL) ? $rating : $res['agr_rating'] + $rating;
        $res['orders_complete'] = ($res['orders_complete'] === NULL) ? 1 : $res['orders_complete'] + 1;
        $res['rating'] = floor( $res['agr_rating']/5/$res['orders_complete'] );
//        print_r($res);
        $this->db->where('id = ', $idWorker);
        $this->db->update('user', $res);
    }
}