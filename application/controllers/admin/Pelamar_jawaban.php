<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelamar_jawaban extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "Ujian Pelamar"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelamar_jawaban_model');
        $this->load->model('Soal_ujian_model');
        $this->load->model('Pelamar_model');
        $this->load->model('Jadwal_ujian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelamar_jawaban/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelamar_jawaban/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelamar_jawaban/index';
            $config['first_url'] = base_url() . 'admin/Pelamar_jawaban/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelamar_jawaban_model->total_rows_jadwal($q);
        $pelamar_jawaban = $this->Pelamar_jawaban_model->get_data_jadwal($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pelamar_jawaban/pelamar_jawaban_list";
        $this->defaultPageAttribute['title'] = "Ujian Peserta";

        foreach ($pelamar_jawaban as $key => $jadwal) {
            $jadwal->total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            $jadwal->soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$jadwal->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."')")->row()->total;
            $jadwal->jawaban_benar = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a LEFT OUTER JOIN soal_ujian b ON a.id_soal = b.id WHERE a.jawaban=b.jawaban AND a.nik = '".$jadwal->nik."' AND b.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            if ($jadwal->jawaban_benar >= 1 && $jadwal->total_soal >= 1) {
                $jadwal->score = round(($jadwal->jawaban_benar / $jadwal->total_soal) * 100, 0);
            }else{
                $jadwal->score = 0;
            }
        }
        $data = array(
            'pelamar_jawaban_data' => $pelamar_jawaban,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function pelamar($nik)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelamar_jawaban/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelamar_jawaban/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelamar_jawaban/index';
            $config['first_url'] = base_url() . 'admin/Pelamar_jawaban/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelamar_jawaban_model->total_rows_jadwal_pelamar($nik, $q);
        $pelamar_jawaban = $this->Pelamar_jawaban_model->get_data_jadwal_pelamar($nik, $config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pelamar_jawaban/pelamar_jawaban_list";
        $this->defaultPageAttribute['title'] = "Hasil Ujian Peserta : ".$this->Pelamar_model->get_by("nik", $nik)->nama;

        foreach ($pelamar_jawaban as $key => $jadwal) {
            $jadwal->total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            $jadwal->soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$jadwal->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."')")->row()->total;
            $jadwal->jawaban_benar = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a LEFT OUTER JOIN soal_ujian b ON a.id_soal = b.id WHERE a.jawaban=b.jawaban AND a.nik = '".$jadwal->nik."' AND b.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            if ($jadwal->jawaban_benar >= 1 && $jadwal->total_soal >= 1) {
                $jadwal->score = ($jadwal->jawaban_benar / $jadwal->total_soal) * 100;
            }else{
                $jadwal->score = 0;
            }
        }
        $data = array(
            'pelamar_jawaban_data' => $pelamar_jawaban,
            'q' => $nik,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function read($nik, $kodesoal) 
    {
        $this->defaultPageAttribute['content'] = "admin/pelamar_jawaban/pelamar_jawaban_read";
        $this->defaultPageAttribute['title'] = "Jawaban Ujian : ".$this->Pelamar_model->get_by("nik",$nik)->nama;
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Ujian Pelamar",
                                                    "Jawaban Ujian",
                                                    $this->Jadwal_ujian_model->get_by("kode_soal",$kodesoal)->judul
                                                    );
        $soal = $this->Soal_ujian_model->get_data_by("kode_soal", $kodesoal);
        foreach ($soal as $key => $value) {
            $value->terjawab=$this->Pelamar_jawaban_model->get_jawaban($nik, $value->id)->jawaban;
        };
        $data = array(
                'data_soal' => $soal,
                'PageAttribute' => $this->defaultPageAttribute
                );
        $this->load->view($this->container, $data);
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pelamar_jawaban/pelamar_jawaban_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pelamar_jawaban";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Pelamar_jawaban",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar_jawaban/create_action'),
	                'id' => set_value('id'),
	                'nik' => set_value('nik'),
	                'kode_ujian' => set_value('kode_ujian'),
	                'kode_soal' => set_value('kode_soal'),
	                'id_soal' => set_value('id_soal'),
	                'jawaban' => set_value('jawaban'),
	                'timestamps' => set_value('timestamps'),
                    'PageAttribute' => $this->defaultPageAttribute
                );
        $this->load->view($this->container, $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                    'nik' => $this->input->post('nik',TRUE),
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    'kode_soal' => $this->input->post('kode_soal',TRUE),
                    'id_soal' => $this->input->post('id_soal',TRUE),
                    'jawaban' => $this->input->post('jawaban',TRUE),
                    'timestamps' => $this->input->post('timestamps',TRUE),
                    );

            $this->Pelamar_jawaban_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Pelamar_jawaban'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelamar_jawaban_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pelamar_jawaban/pelamar_jawaban_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pelamar_jawaban";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pelamar_jawaban",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar_jawaban/update_action'),
                    'id' => set_value('id', $row->id),
                    'nik' => set_value('nik', $row->nik),
                    'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
                    'kode_soal' => set_value('kode_soal', $row->kode_soal),
                    'id_soal' => set_value('id_soal', $row->id_soal),
                    'jawaban' => set_value('jawaban', $row->jawaban),
                    'timestamps' => set_value('timestamps', $row->timestamps),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar_jawaban'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                    'nik' => $this->input->post('nik',TRUE),
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    'kode_soal' => $this->input->post('kode_soal',TRUE),
                    'id_soal' => $this->input->post('id_soal',TRUE),
                    'jawaban' => $this->input->post('jawaban',TRUE),
                    'timestamps' => $this->input->post('timestamps',TRUE),
                    );

            $this->Pelamar_jawaban_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Pelamar_jawaban'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelamar_jawaban_model->get_by_id($id);

        if ($row) {
            $this->Pelamar_jawaban_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Pelamar_jawaban'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar_jawaban'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('nik', 'nik', 'trim|required');
       $this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
       $this->form_validation->set_rules('kode_soal', 'kode soal', 'trim|required');
       $this->form_validation->set_rules('id_soal', 'id soal', 'trim|required');
       $this->form_validation->set_rules('jawaban', 'jawaban', 'trim|required');
       $this->form_validation->set_rules('timestamps', 'timestamps', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->model("Pelamar_ujian_excel");
        $this->Pelamar_ujian_excel->export();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pelamar_jawaban.doc");

        $data = array(
            'pelamar_jawaban_data' => $this->Pelamar_jawaban_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pelamar_jawaban/pelamar_jawaban_doc',$data);
    }

}

/* End of file Pelamar_jawaban.php */
/* Location: ./application/controllers/Pelamar_jawaban.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */