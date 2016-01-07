<?php
/**
 * Created by PhpStorm.
 * User: DNS
 * Date: 14.11.15
 * Time: 3:33
 */
//namespace application\models;


class Categories extends CI_Model
{
    public function getCategories($id = 0)
    {
        if ($id === 0) {
            //$q = $this->db->select('*')->from('category')->get();
            $q = $this->db->get('category');
        } else {
            $q = $this->db->select('name', 'id')->from('category')->where('id', $id)->get();
        }
        return $q->result_array();

    }

    public function getSubCategories($id = 0)
    {
        if ($id === 0) {
            $q = $this->db->select('name', 'id')->from('subcategory')->get();
        } else {
            $q = $this->db->select('name', 'id')->from('subcategory')->where('id', $id)->get();
        }
        return $q->result_array();
    }
}