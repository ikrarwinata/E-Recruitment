<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelamar_model extends CI_Model
{

    public $table = 'pelamar';
    public $id = 'nik';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get a row by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get a row by defined field
    function get_by($fieldkey, $val)
    {
        $this->db->where($fieldkey, $val);
        return $this->db->get($this->table)->row();
    }

    // get a row by id
    function get_akun($u, $p)
    {
        $this->db->where("username", $u);
        $this->db->where("password", md5($p));
        return $this->db->get($this->table)->row();
    }

    // get data by defined field
    function get_data_by($fieldkey, $val)
    {
        $this->db->where($fieldkey, $val);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows_by($k, $q) {
        $this->db->where($k, $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('nik', $q);
            $this->db->or_like('id_posisi', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('pekerjaan', $q);
            $this->db->or_like('tinggi_badan', $q);
            $this->db->or_like('berat_badan', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('hp', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('username', $q);
            $this->db->or_like('password', $q);
            $this->db->group_end();
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_pelamar($q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('nik', $q);
            $this->db->or_like('id_posisi', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('pekerjaan', $q);
            $this->db->or_like('tinggi_badan', $q);
            $this->db->or_like('berat_badan', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('hp', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('username', $q);
            $this->db->or_like('password', $q);
            $this->db->group_end();
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('nik', $q);
            $this->db->or_like('id_posisi', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('pekerjaan', $q);
            $this->db->or_like('tinggi_badan', $q);
            $this->db->or_like('berat_badan', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('hp', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('username', $q);
            $this->db->or_like('password', $q);
            $this->db->group_end();
        }
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table."_overview")->result();
    }

    // get data with limit and search
    function get_limit_data_pelamar($limit, $start = 0, $q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('nik', $q);
            $this->db->or_like('id_posisi', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('pekerjaan', $q);
            $this->db->or_like('tinggi_badan', $q);
            $this->db->or_like('berat_badan', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('hp', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('username', $q);
            $this->db->or_like('password', $q);
            $this->db->group_end();
        }
        $this->db->order_by("id_posisi", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get($this->table."_overview")->result();
    }

    // get data with limit and search
    function get_data_pelamar() {
        $this->db->order_by("id_posisi", "DESC");
        return $this->db->get($this->table."_overview")->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data by spesific field
    function update_by($field, $val, $data)
    {
        $this->db->where($field, $val);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete data by spesific field
    function delete_by($field, $val)
    {
        $this->db->where($field, $val);
        $this->db->delete($this->table);
    }

}

/* End of file Pelamar_model.php */
/* Location: ./application/models/Pelamar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */