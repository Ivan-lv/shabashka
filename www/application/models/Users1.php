<?php


class Users extends CI_Model{
	
	public function getTheBestUserMaster($count = 5){
		$q = $this->db->select('name', 'surname','rating','photo')
			->from('user')
			->where('user_category =','1')
			->where_or('user_category =','2')
			->order_by('rating', 'DESC')
			->limit($count)->get();
		return $q->result_array();
	}

    public function getMasterCard($userid){
        $q = $this->db->select( 'Name', 'Surname', 'Skype', 'icq', 'phone', 'photo', 'text', 'rating', 'orders_complete')
            ->from('user')
            ->where('id =', $userid)->get();
        $this->db->reset_query();

        $q1 = $this->db->select('subcategory.name')
            ->from('user')
            ->from('subcategory', 'user_cat')
            ->where('user_cat.id_user =', $userid)
            ->where('user_cat.id_subcategory = subcategory.id')->get();
        $mas = $q->result_array();
        $mas["Category"] = $q1->result_array();
        return $mas;
    }
	public function findUserMaster($category = 0 , $subcategory = 0, $count = 10, $sortBy = 'rating'){
        /*if ($category === 0 & $subcategory === 0) {
            $q = $this->db->select('id', 'Name', 'Surname', 'photo', 'rating', 'orders_complete')
                ->from('user')
                ->where('user_category =', '1')
                ->or_where('user_category =', '2')
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        } elseif ($subcategory != 0){
            $q = $this->db->select('id', 'Name', 'Surname', 'photo', 'rating', 'orders_complete')
                ->from('user')
                ->where('user_category =', '1')
                ->or_where('user_category =', '2')
                ->where('user_cat.id_user = user.id')
                ->where('id_subcategory = ',$subcategory)
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        } else {
            $q = $this->db->select('id', 'Name', 'Surname', 'photo', 'rating', 'orders_complete')
                ->from('user')
                ->where('user_category =', '1')
                ->or_where('user_category =', '2')
                ->where('user_cat.id_user = user.id')
                ->where('id_category = ',$category)
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        }*/
        $this->db->select(array('user.id', 'user.Name', 'user.Surname', 'user.photo', 'user.rating', 'user.orders_complete'))
            ->from('user')
            ->where('user_category =', '1')
            ->or_where('user_category =', '2')
            ->order_by($sortBy, 'DESC');
        if ($category != 0 | $subcategory != 0) {
            $this->db
                ->from('user_cat')
                ->where('user_cat.id_user = user.id');
        } elseif ($subcategory != 0) {
            $this->db
                ->where('user_cat.id_subcategory = ', $subcategory);
        } else {
            $this->db
                ->where('user_cat.id_category = ', $category);
        }
        return $this->db->limit($count)->get()->result_array();
    }

    public function  login($login, $pass)
    {
        $q = $this->db->select('id')
            ->from('user')
            ->where('Login =', $login)
            ->where('Password =', $pass)->get();
        if ($q->num_rows() != 0)
            return true;
        else return false;
    }
	
	public function  registration ($usrData)
    {
        try {
            $this->db->insert_batch('user', $usrData)->get();
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
            return true;
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
            $qmas = $q->result_array();

            for ($i = 0; $i <= $categoryList . count(); $i++) {
                $this->db->query("INSERT INTO `user_cat` (id_category, id_subcategory) VALUES($categoryList[$i], $qmas[$i])
                                  ON DUPLICATE KEY UPDATE id_category = $categoryList[$i], id_subcategory =  $qmas[$i] WHERE id_user = $userid");
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
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

    public function getUserProfileMaster($userid){
        $mas = getMasterCard($userid);

        $q = $this->db
            ->select(array('user.name', 'user.Surname', 'order.price', 'category.name'))
            ->from(array('order', 'user', 'category', 'order_cat'))
            ->where('order.id_worker =', $userid)
            ->where('order.id_customer = user.id')
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id')
            ->get();

        $mas["Adverts"] = $q -> result_array();
        return $mas;
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


}