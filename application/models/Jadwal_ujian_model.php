<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_ujian_model extends CI_Model
{

    public $table = 'jadwal_ujian';
    public $id = 'id';
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

    // get data by defined field
    function get_data_by($fieldkey, $val)
    {
        $this->db->where($fieldkey, $val);
        $this->db->order_by("id", "ASC");
        return $this->db->get($this->table)->result();
    }

    // get data by defined field
    function get_ujian_by_kode($idp)
    {
        $this->db->where('kode_ujian', $idp);
        $this->db->order_by("id", "ASC");
        return $this->db->get($this->table."_overview")->result();
    }

    // get data by defined field
    function get_ujian_by($f, $idp)
    {
        $this->db->where($f, $idp);
        $this->db->order_by("id", "ASC");
        return $this->db->get($this->table."_overview")->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('posisi_jabatan', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('judul', $q);
            $this->db->or_like('mulai', $q);
            $this->db->or_like('akhir', $q);
            $this->db->group_end();
        }
        $this->db->from($this->table."_overview");
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_pekerjaan($idp, $q = NULL) {
        $this->db->group_start();
        $this->db->where('id_pekerjaan', $idp);
        $this->db->group_end();  
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('posisi_jabatan', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('judul', $q);
            $this->db->or_like('mulai', $q);
            $this->db->or_like('akhir', $q);
            $this->db->group_end();
        }
        $this->db->from($this->table."_overview");
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('posisi_jabatan', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('judul', $q);
            $this->db->or_like('mulai', $q);
            $this->db->or_like('akhir', $q);
            $this->db->group_end();
        }
        $this->db->order_by("id_pekerjaan", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get($this->table."_overview")->result();
    }

    // get data with limit and search
    function get_datas() {
        $this->db->order_by("id_pekerjaan", "DESC");
        return $this->db->get($this->table."_overview")->result();
    }

    // get data with limit and search
    function get_limit_data_pekerjaan($idp, $limit, $start = 0, $q = NULL) {
        $this->db->group_start();
        $this->db->where('id_pekerjaan', $idp);
        $this->db->group_end();  
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('posisi_jabatan', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('judul', $q);
            $this->db->or_like('mulai', $q);
            $this->db->or_like('akhir', $q);
            $this->db->group_end();
        }
        $this->db->order_by("id_pekerjaan", "DESC");
        $this->db->limit($limit, $start);
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

/* End of file Jadwal_ujian_model.php */
/* Location: ./application/models/Jadwal_ujian_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */