<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelamar_jawaban_model extends CI_Model
{

    public $table = 'pelamar_jawaban';
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

    // get a row by defined field
    function get_jawaban($nik, $idsoal)
    {
        $this->db->where("nik", $nik);
        $this->db->where("id_soal", $idsoal);
        return $this->db->get($this->table)->row();
    }

    // get data by defined field
    function get_data_by($fieldkey, $val)
    {
        $this->db->where($fieldkey, $val);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('id_soal', $q);
            $this->db->or_like('jawaban', $q);
            $this->db->or_like('timestamps', $q);
            $this->db->group_end();
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_jadwal($q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->group_end();
        }
        $this->db->from("pelamar_jadwal_overview");
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total_rows_jadwal_pelamar($nik, $q = NULL) {
        $this->db->where("nik", $nik);
        if($q!=NULL){
            $this->db->group_start();
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->group_end();
        }
        $this->db->from("pelamar_jadwal_overview");
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->like('id', $q);
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->or_like('id_soal', $q);
            $this->db->or_like('jawaban', $q);
            $this->db->or_like('timestamps', $q);
            $this->db->group_end();
        }
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data_jadwal($limit, $start = 0, $q = NULL) {
        if($q!=NULL){
            $this->db->group_start();
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->group_end();
        }
        $this->db->order_by("nik", $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get("pelamar_jadwal_overview")->result();
    }

    // get data with limit and search
    function get_datas() {
        $this->db->order_by("nik", $this->order);
        return $this->db->get("pelamar_jadwal_overview")->result();
    }

    // get data with limit and search
    function get_data_jadwal_pelamar($nik, $limit, $start = 0, $q = NULL) {
        $this->db->where("nik", $nik);
        if($q!=NULL){
            $this->db->group_start();
            $this->db->or_like('nik', $q);
            $this->db->or_like('kode_ujian', $q);
            $this->db->or_like('kode_soal', $q);
            $this->db->group_end();
        }
        $this->db->order_by("nik", $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get("pelamar_jadwal_overview")->result();
    }
    
    // get total rows
    function count_by($field, $val) {
        $this->db->where($field, $val);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function count_pelamar_by($nik, $val) {
        $this->db->where("nik", $nik);
        $this->db->where("id_soal", $val);
        $this->db->from($this->table);
        return $this->db->count_all_results();
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

    function delete_soal_peserta($nik, $val)
    {
        $this->db->where("nik", $nik);
        $this->db->where("id_soal", $val);
        $this->db->delete($this->table);
    }

}

/* End of file Pelamar_jawaban_model.php */
/* Location: ./application/models/Pelamar_jawaban_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */