<?php


class Adverts extends CI_Model{
	
	public function getLastAdverts ($count = 10, $offset = 0){
		//Последние актуальные заказы
		$q = $this->db->select(array('id', 'title', 'text', 'price','status','date'))
			->from('order')
			->where('status = ','0')
			->order_by('date', 'DESC')
			->limit($count, $offset)->get();
		return $q->result_array();
	}

    public function countActiveAdverts() {
        $this->db->where('status = ', 0);
        return $this->db->count_all_results('order');
    }

    public function getDemoAdverts($num, $offset) {
        //$this->db->limit($num);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get('order',$num,$offset);
        return $query->result_array();
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
                ->where_in('id',$advertsId)
                ->get();

            return $q->result_array();
        }
    }

    public function getAdvertInfo($id) {
        $q = $this->db->select(array('title', 'text', 'price', 'id'))
            ->from('order')
            ->where('id =', $id)->get();
        $mas["advertBody"] = $q->result_array();
        $mas["advertBody"] = $mas["advertBody"][0];
        $this->db->reset_query();

        $q = $this->db->select('subcategory.id')
            ->from(array('order_cat', 'subcategory'))
            ->where('order_cat.id_order =', $id)
            ->where('order_cat.id_subctg = subcategory.id')->get();
        $items = $q->result_array();
        $mas['idSubcats'] = array();
        foreach($items as $item) {
            array_push($mas['idSubcats'], $item['id']);
        }
        return $mas;
    }

    public function getAdvert($idAdvert)
    { //Для страницы подробного просмотра заказа
        $q = $this->db->select(array('title', 'text', 'price', 'id'))
            ->from('order')
            ->where('id =', $idAdvert)->get();
        $mas["body"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select('subcategory.name')
            ->from(array('order_cat', 'subcategory'))
            ->where('order_cat.id_order =', $idAdvert)
            ->where('order_cat.id_subctg = subcategory.id')->get();
        $mas["categories"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select(array('user.id', 'user.Name', 'user.Surname', 'user.photo'))
            ->from(array('user', 'order'))
            ->where('order.id =', $idAdvert)
            ->where('order.id_customer = user.id')->get();
        $mas["ownerData"] = $q->result_array();
        $this->db->reset_query();

        $q = $this->db->select(array('date', 'text', 'user_id'))
            ->from('comment')
            ->where('comment.order_id =', $idAdvert)
            ->order_by('date','DESC')->get();
        $mas["comments"] = $q->result_array();
        $this->db->reset_query();



        $q = $this->db->select(array('user.id', 'user.Name', 'user.Surname', 'user.photo', 'rating'))
            ->from(array('user', 'comment'))
            ->where('comment.order_id =', $idAdvert)
            ->where('comment.user_id = user.id')
            ->order_by('user.id')
            ->get();
        $mas["CommentUserData"] = $q->result_array();
        $this->db->reset_query();

        //SELECT * FROM `comment`, `order`, `user` WHERE comment.order_id = 2 AND comment.user_id = user.id AND comment.order_id = order.id

        return $mas;
    }

    public function hasBid($uid, $orderId) {
        $q = $this->db->select('bid.id, bid.date')
            ->from('bid')
            ->where('id_usr =', $uid)
            ->where('id_ordr =', $orderId)
            ->get();
        $res = $q->result_array();
        if (count($res) > 1) throw new Exception('the many results of hasBid query');
        if (empty($res)) {
            return false;
        } else {
            return $res;
        }
        /*
        echo '<pre>';
            print_r($res);
        echo '</pre>';
        */
    }

	public function setAdvert ($advertData){
        $d = new DateTime('now');
        $data = array(
            'text'        => $advertData['text'],
            'price'       => $advertData['price'],
            'title'       => $advertData['title'],
            'status'      => 0,
            'id_customer' => $_SESSION['id'],
            'date'        => $d->format('Y-m-d H:i:s')
        );
        $this->db->insert('order', $data);

        $advertData['id'] = $this->db->insert_id();

        if(count($advertData['ids']) == 0) array_push($advertData['ids'], 31);

        foreach($advertData['ids'] as $subCat) {
            $t = array(
                'id_subctg' => $subCat['idSubcat'],
                'id_catg' => $subCat['idCat'],
                'id_order' => $advertData['id']
            );
            $this->db
                ->insert('order_cat', $t);
            $this->db->reset_query();
        }





	}

    public function editAdvert($advertData) {

        $this->db
            ->where('id_order = ', $advertData['id'])
            ->delete('order_cat');
        $this->db->reset_query();

        if(count($advertData['ids']) == 0) array_push($advertData['ids'], 31);

        foreach($advertData['ids'] as $subCat) {
            $t = array(
                'id_subctg' => $subCat['idSubcat'],
                'id_catg' => $subCat['idCat'],
                'id_order' => $advertData['id']
            );
            $this->db
                ->insert('order_cat', $t);
            $this->db->reset_query();
        }

        $data = array(
            'text'  => $advertData['text'],
            'price' => $advertData['price'],
            'title' => $advertData['title']
        );
        $this->db->where('id', $advertData['id']);
        $this->db->update('order', $data);

    }

    public function removeAdvert($id) {
        $this->db
            ->where('id_order = ', $id)
            ->delete('order_cat');
        $this->db->reset_query();

        $this->db
            ->where('id = ', $id)
            ->delete('order');
        $this->db->reset_query();
    }

    public function findAdverts($params, $offset, $isCount = FALSE){

        $category    = $params['category'];
        $subcategory = (isset($params['subcategory'])) ? $params['subcategory'] : 0;
        $priceMin    = (isset($params['priceMin'])) ? $params['priceMin'] : 0;
        $priceMax    = (isset($params['priceMax'])) ? $params['priceMax'] : PHP_INT_MAX;
        $count       = $params['count'];
        $sortBy      = $params['sortBy'];

        $this->db->distinct()
            ->select(array('order.id', 'order.title', 'order.text', 'order.status', 'order.price', 'order.date', 'category.name'))
            ->from(array('order', 'category', 'order_cat'))
            ->where('order.price >= ', $priceMin)
            ->where('order.price <=', $priceMax)
            ->where('order_cat.id_order = order.id')
            ->where('order_cat.id_catg = category.id')
            ->where('order.status =', 0);

        $this->db->order_by($sortBy,'DESC');

        if ($subcategory != 0) {
            $this->db->where('order_cat.id_subctg = ', $subcategory);
        } elseif ($category != 0) {
            $this->db->where('order_cat.id_catg = ', $category);
        }
        //SELECT * FROM order, category, order_cat WHERE order.price >= 0 AND order.price <= 100000 AND order_cat.id_order = order.id AND order_cat.id_catg = category.id AND order_cat.id_catg = 2
        if($isCount) {
//            echo '<pre>';
//            print_r($this->db->get()->result_array());
//            echo '</pre>';
            return count($this->db->get()->result_array());
        }
        return $this->db->limit($count, $offset)->get()->result_array();
    }

    function getAdvertInfById($advertId, $fields = '*') {
        $q = $this->db->select($fields)
            ->from('order')
            ->where('id =', $advertId)
            ->get();
        $res = $q->result_array();
        if(count($res) > 1) {
            throw new Exception("one of result expected");
        }
        if (count($res) == 1) {
            return $res[0];
        }
    }

    function setMasterToAdvert($advertId, $uid) {
        $this->db->where('id', $advertId);
        $data = array('id_worker' => $uid);
        $this->db->update('order', $data);
    }

    function addComment($data) {
        $this->db->insert('comment', $data);
        return $this->db->insert_id();
    }

    function completeAdvert($advId) {
        $data = array('status' => 1);
        $this->db->where('id =', $advId);
        $this->db->update('order', $data);
        $this->db->reset_query();
        $q = $this->db->select('id_worker')
            ->from('order')
            ->where('id = ', $advId)
            ->get();
        $idWorker = $q->result_array();

        return array('response' => 0, 'idWorker' => $idWorker[0]['id_worker']);
    }
}