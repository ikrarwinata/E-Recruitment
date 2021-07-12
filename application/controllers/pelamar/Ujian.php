<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ujian extends CI_Controller
{
    private $container = "pelamar/container";
    private $defaultPageAttribute = array(
                        'title' => "Jadwal Ujian",
                        'subtitle' => array("Pekerjaan", "Jadwal Ujian"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "pelamar/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('Jadwal_ujian_model');
        $this->load->model('Pelamar_jawaban_model');
        $this->load->model('Soal_ujian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $start = 0;
        $jadwal_ujian = $this->Jadwal_ujian_model->get_ujian_by_kode($this->session->userdata("kode_ujian"));

        $this->defaultPageAttribute['content'] = "pelamar/jadwal_ujian";
        $this->defaultPageAttribute['title'] = "Jadwal Ujian";
        $this->defaultPageAttribute['scripts'] = array("assets/js/pelamar-jadwal.js");
        $data = array(
            'jadwal_ujian_data' => $jadwal_ujian,
            'start'=>$start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function prep($id){
        $start = 0;
        $jadwal_ujian = $this->Jadwal_ujian_model->get_ujian_by("id", $id);

        $this->defaultPageAttribute['content'] = "pelamar/ujian_prep";
        $this->defaultPageAttribute['title'] = "Persiapan Ujian";
        $this->defaultPageAttribute['subtitle'] = array("Ujian", "Persiapan");
        $this->defaultPageAttribute['scripts'] = array("assets/js/pelamar-ujian-prep.js");
        $this->session->set_userdata("kode_soal", $jadwal_ujian->kode_soal);
        $data = array(
            'ujian_data' => $jadwal_ujian,
            'start'=>$start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function next($index){
        $jadwal_ujian = $this->Jadwal_ujian_model->get_by("kode_soal", $this->session->userdata("kode_soal"));
        $this->defaultPageAttribute['title'] = $jadwal_ujian->judul;

        $this->load->model('Soal_ujian_model');
        $soal = $this->Soal_ujian_model->soal_ujian($this->session->userdata("kode_soal"), $index);
        $terjawab = $this->db->query("SELECT a.id, a.kode_soal, (SELECT pelamar_jawaban.jawaban FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$this->session->userdata("nik")."' AND pelamar_jawaban.id_soal=a.id) AS jawaban FROM soal_ujian a WHERE kode_soal='".$this->session->userdata("kode_soal")."' ORDER BY a.id ASC")->result();
        $j = $this->db->query("SELECT jawaban FROM pelamar_jawaban WHERE nik = '".$this->session->userdata("nik")."' AND id_soal ='".$soal->id."'")->row();
        $jawaban = isset($j->jawaban)?$j->jawaban:NULL;
        $data = array(
            'soal_data' => $soal,
            'terjawab' => $terjawab,
            'jawaban' => $jawaban,
            'checked' => 'checked="true"',
            'current'=>$index+1,
            'total'=>$this->Soal_ujian_model->total_soal($this->session->userdata("kode_soal")),
            'ujian_prop'=>$jadwal_ujian,
            'PageAttribute' => $this->defaultPageAttribute
        );

        $this->save();

        $this->load->view("pelamar/ujian", $data);        
    }

    public function prev($index){
        $index--;
        $jadwal_ujian = $this->Jadwal_ujian_model->get_by("kode_soal", $this->session->userdata("kode_soal"));
        $this->defaultPageAttribute['title'] = $jadwal_ujian->judul;

        $this->load->model('Soal_ujian_model');
        $soal = $this->Soal_ujian_model->soal_ujian($this->session->userdata("kode_soal"), $index-1);
        $terjawab = $this->db->query("SELECT a.id, a.kode_soal, (SELECT pelamar_jawaban.jawaban FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$this->session->userdata("nik")."' AND pelamar_jawaban.id_soal=a.id) AS jawaban FROM soal_ujian a WHERE kode_soal='".$this->session->userdata("kode_soal")."' ORDER BY a.id ASC")->result();
        $j = $this->db->query("SELECT jawaban FROM pelamar_jawaban WHERE nik = '".$this->session->userdata("nik")."' AND id_soal ='".$soal->id."'")->row();
        $jawaban = isset($j->jawaban)?$j->jawaban:NULL;
        $data = array(
            'soal_data' => $soal,
            'terjawab' => $terjawab,
            'jawaban' => $jawaban,
            'checked' => 'checked="true"',
            'current'=>$index,
            'total'=>$this->Soal_ujian_model->total_soal($this->session->userdata("kode_soal")),
            'ujian_prop'=>$jadwal_ujian,
            'PageAttribute' => $this->defaultPageAttribute
        );

        $this->save();

        $this->load->view("pelamar/ujian", $data);     
    }    

    private function save(){
        if ($this->input->post("jawaban")==NULL) {
            return false;
        }
        $insert = array(
            'nik'=>$this->session->userdata("nik"),
            'id_soal'=>$this->input->post("id"),
            'jawaban'=>$this->input->post("jawaban"),
            'timestamps'=>strtotime(date("d-m-Y H:i:s"))
        );
        $this->Pelamar_jawaban_model->delete_soal_peserta($this->session->userdata("nik"), $this->input->post("id"));
        $this->Pelamar_jawaban_model->insert($insert);
    }

    public function done(){
        $soals = $this->Soal_ujian_model->get_data_by("kode_soal", $this->session->userdata("kode_soal"));
        foreach ($soals as $key => $soal) {
            if ($this->Pelamar_jawaban_model->count_pelamar_by($this->session->userdata("nik"), $soal->id)>=1) {
                continue;
            };
            $insert = array(
                'nik'=>$this->session->userdata("nik"),
                'id_soal'=>$soal->id,
                'jawaban'=>NULL,
                'timestamps'=>strtotime(date("d-m-Y H:i:s"))
            );
            $this->Pelamar_jawaban_model->insert($insert);
        };

        $this->showResult();
    }

    public function ajaxReq(){
        if ($this->input->post("jawaban")==NULL) {
            return false;
        }
        $insert = array(
            'nik'=>$this->session->userdata("nik"),
            'id_soal'=>$this->input->post("id"),
            'jawaban'=>$this->input->post("jawaban"),
            'timestamps'=>strtotime(date("d-m-Y H:i:s"))
        );
        $this->Pelamar_jawaban_model->delete_soal_peserta($this->session->userdata("nik"), $this->input->post("id"));
        $this->Pelamar_jawaban_model->insert($insert);
        echo "success";
    }

    public function showResult(){
        $kode_soal = $this->session->userdata("kode_soal");
        $nik = $this->session->userdata("nik");

        $totalSoal = $this->Soal_ujian_model->get_data_by("kode_soal", $kode_soal);
        $benar = 0;
        foreach ($totalSoal as $key => $soal) {
            $benar += $this->db->query("SELECT COUNT(*) AS c FROM pelamar_jawaban WHERE nik = '".$this->session->userdata("nik")."' AND id_soal = '".$soal->id."' AND jawaban = '".$soal->jawaban."'")->row()->c;
        }
        $score = ($benar / count($totalSoal)) * 100;
        $this->defaultPageAttribute['title'] = "Hasil Ujian";
        $data = array(
            'total_soal'=>count($totalSoal),
            'benar'=>$benar,
            'score'=>$score,
            'ujian'=>$this->Jadwal_ujian_model->get_by("kode_soal", $kode_soal),
            'PageAttribute' => $this->defaultPageAttribute
        );

        $this->load->view("pelamar/result", $data);   
    }

    public function result($kode){
        $kode_soal = $kode;
        $nik = $this->session->userdata("nik");

        $totalSoal = $this->Soal_ujian_model->get_data_by("kode_soal", $kode_soal);
        $benar = 0;
        foreach ($totalSoal as $key => $soal) {
            $benar += $this->db->query("SELECT COUNT(*) AS c FROM pelamar_jawaban WHERE nik = '".$this->session->userdata("nik")."' AND id_soal = '".$soal->id."' AND jawaban = '".$soal->jawaban."'")->row()->c;
        }
        $score = ($benar / count($totalSoal)) * 100;
        $this->defaultPageAttribute['title'] = "Hasil Ujian";
        $data = array(
            'total_soal'=>count($totalSoal),
            'benar'=>$benar,
            'score'=>$score,
            'ujian'=>$this->Jadwal_ujian_model->get_by("kode_soal", $kode_soal),
            'PageAttribute' => $this->defaultPageAttribute
        );

        $this->load->view("pelamar/result", $data);   
    }
}

/* End of file Jadwal_ujian.php */
/* Location: ./application/controllers/Jadwal_ujian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */