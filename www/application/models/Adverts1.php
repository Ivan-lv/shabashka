<?php


class Adverts extends CI_Model
{

    public function getLastAdverts($count = 10)
    {
        //Последние актуальные заказы для MainPage
        $q = $this->db->select(array('id', 'title', 'text', 'price'))
            ->from('order')
            ->where('status = ', '0')
            ->order_by('date', 'DESC')
            ->limit($count)->get();
        return $q->result_array();
    }

    public function getUserAdverts($uid, $idAdvert = FALSE) {
        if ($idAdvert === FALSE) {
            $q = $this->db
                ->select('id_ordr')
                ->from('bid')
                ->where('id_ord_owner=', $uid)
                ->get();

            if (!$q) {throw new Exception('error in query');}

            $qRes = $q->result_array();
            $advertsId = array();
            foreach ($qRes as $row) {
                array_push($advertsId, $row['id_ordr']);
            }

            $this->db->reset_query();

            $q = $this->db->select('*')
                ->from('order')
                ->where_in('id=',$advertsId)
                ->get();

            return $q->result_array();
        }
    }

    public function getAdvert($idAdvert)
    { //Для страницы подробного просмотра заказа
        $q = $this->db->select(array('title', 'text', 'price'))
            ->from('order')
            ->where('id =', $idAdvert)->get();
        $mas["AdvertBody"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select('subcategory.name')
            ->from(array('order_cat', 'subcategory'))
            ->where('order_cat.id_order =', $idAdvert)
            ->where('order_cat.id_subctg = subcategory.id')->get();
        $mas["AdvertCategory"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select(array('user.id', 'user.Name', 'user.Surname', 'user.photo'))
            ->from(array('user', 'order'))
            ->where('order.id =', $idAdvert)
            ->where('order.id_customer = user.id')->get();
        $mas["AdvertUserData"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select(array('date, text', 'user_id'))
            ->from('comment')
            ->where('comment.order_id =', $idAdvert)
            ->order_by('date')->get();
        $mas["CommentBody"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select(array('user.id', 'user.Name', 'user.Surname', 'user.photo', 'rating'))
            ->from(array('user', 'comment'))
            ->where('comment.order_id =', $idAdvert)
            ->where('comment.user_id = user.id')->get();
        $mas["CommentUserData"] = $q->result_array();
        $this->db->reset_query();

        return $mas;
    }

    public function setAdvert($advertBody, $advertCategory)
    {

        try {
            //В БД есть поле order.id_category, и я хз зачем оно надо

            //$advertBody["status"] = 0;
            //$advertBody["date"] = NOW();
            $insert = '';
            $value = '';
            foreach ($advertBody as $key => $item){
                $insert += $key + ', ';
                $value += $item + ', ';
            }
            $insert = substr($insert, 0, -2);
            $value = substr($value, 0, -2);

            $this->db->query("INSERT INTO `order_cat` ($insert, status, date) VALUES ($value, 0, now())")-> get();
            $this->db->reset_query();
            //$this->db->insert_batch('order', )->get();
            /*  $advertBody = [
             *              "id_customer" => "(int)",
             *              "text" => "text",
             *              "title" => "title",
             *              "price" => "(int)",
             *              ];
             * */

            $q = $this->db->select('id_cat')
                ->from('subcategory')
                ->where_in('id = ', $advertCategory)
                ->get();
            $qmas = $q->result_array();
            $this->db->reset_query();

            $q1 = $this->db->select('id')
                ->from('order')
                ->where($advertCategory)
                ->get();
            $q1mas = $q1->result_array();
            $this->db->reset_query();

            for ($i = 0; $i <= $advertCategory ; $i++) {
                $this->db->query("INSERT INTO `order_cat` (id_catg, id_subctg, id_order, id_order, id)
                                      VALUES($advertCategory[$i], $qmas[$i], $q1mas[id])") -> get();
                }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findAdverts($category = 0 , $subcategory = 0, $priceMin = 0, $priceMax = PHP_INT_MAX, $count = 10, $sortBy = 'date'){
        /*if ($category === 0 & $subcategory === 0) {
            $q = $this->db->distinct()
                ->select('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date','category.name')
                ->from(array('order', 'category' ,'order_cat'))
                ->where('order.price >= ', $priceMin)
                ->where('order.price <=', $priceMax)
                ->where('order_cat.id_catg = category.id')
                ->where('order_cat.id_order = order.id')
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        } elseif ($subcategory != 0){
            $q = $this->db->distinct()
                ->select('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date','category.name')
                ->from(array('order', 'category' ,'order_cat'))
                ->where('order.price >= ', $priceMin)
                ->where('order.price <=', $priceMax)
                ->where('order_cat.id_order = order.id')
                ->where('order_cat.id_subctg = ',$subcategory)
                ->where('order_cat.id_catg = category.id')
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        } else {
            $q = $this->db->distinct()
                ->select('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date','category.name')
                ->from(array('order', 'category' ,'order_cat'))
                ->where('order.price >= ', $priceMin)
                ->where('order.price <=', $priceMax)
                ->where('order_cat.id_order = order.id')
                ->where('order_cat.id_catg = ',$category)
                ->where('order_cat.id_catg = category.id')
                ->order_by($sortBy, 'DESC')
                ->limit($count)->get();
        }*/

        $this->db->distinct()
            ->select(array('order.id', 'order.Title', 'order.text', 'order.status', 'order.price', 'order.date', 'category.name'))
            ->from(array('order', 'category', 'order_cat'))
            ->where('order.price >= ', $priceMin)
            ->where('order.price <=', $priceMax)
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id');
        if ($sortBy != 'status')
            $this->db->order_by($sortBy, 'DESC');
        else {
            $this->db->order_by($sortBy);
        }
        if ($subcategory != 0) {
            $this->db->where('order_cat.id_subctg = ', $subcategory);
        } elseif ($category != 0) {
            $this->db->where('order_cat.id_catg = ', $category);
        }
        return $this->db->limit($count)->get()->result_array();
    }

    public function setBid($userid, $orderid){

    }
}