<?php


class Adverts extends CI_Model{
	
	public function getLastAdverts ($count = 10){
		//��������� ���������� ������
		$q = $this->db->select(array('id', 'title', 'text', 'price','status','date'))
			->from('order')
			->where('status = ','0')
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
    { //��� �������� ���������� ��������� ������
        $q = $this->db->select(array('title', 'text', 'price'))
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
            ->order_by('date')->get();
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
	
	public function setAdvert ($advertData){
        $d = new DateTime('now');
        $data = array(
            'text'        => $advertData['text'],
            'price'       => $advertData['price'],
            'title'       => $advertData['title'],
            'status'      => 0,
            'id_customer' => $_SESSION['id'],
            'date'        => $d->format('Y-m-d')
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

    public function findAdverts($params){


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

}