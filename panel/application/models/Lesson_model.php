<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_model extends CI_Model{

    public $tableName = "lesson";

    public function __construct()
    {
        parent::__construct();
    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /** Tüm kayıtları view'e getirecek olan metot.. */
    public function get_all($where = array(), $order = "id ASC"){
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    /** Tüm verileri veritabanına kayıy edecek olan metot.. */
    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array()){
        return $this->db->where($where)->delete($this->tableName);
    }

}