<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_ujian extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Jadwal Ujian",
                        'subtitle' => array("Pekerjaan", "Jadwal Ujian"),
                        'bootstraps' => array(),
                        'scripts' => array('assets/js/admin-jadwal-ujian.js'),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('Jadwal_ujian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Jadwal_ujian/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Jadwal_ujian/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Jadwal_ujian/index';
            $config['first_url'] = base_url() . 'admin/Jadwal_ujian/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_ujian_model->total_rows($q);
        $jadwal_ujian = $this->Jadwal_ujian_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/jadwal_ujian/jadwal_ujian_list";
        $this->defaultPageAttribute['title'] = "Jadwal ujian";
        $data = array(
            'jadwal_ujian_data' => $jadwal_ujian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function formasi($id)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Jadwal_ujian/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Jadwal_ujian/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Jadwal_ujian/index';
            $config['first_url'] = base_url() . 'admin/Jadwal_ujian/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_ujian_model->total_rows_pekerjaan($id, $q);
        $jadwal_ujian = $this->Jadwal_ujian_model->get_limit_data_pekerjaan($id, $config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/jadwal_ujian/jadwal_ujian_list";
        $this->defaultPageAttribute['title'] = "Jadwal Ujian";
        $data = array(
            'jadwal_ujian_data' => $jadwal_ujian,
            'q' => $jadwal_ujian[0]->posisi_jabatan,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_ujian_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/jadwal_ujian/jadwal_ujian_read";
            $this->defaultPageAttribute['title'] = "Detail Jadwal_ujian";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Jadwal_ujian",
                                                        "Detail",
                                                        );
            $data = array(
                    'id' => $row->id,
                    'kode_ujian' => $row->kode_ujian,
                    'kode_soal' => $row->kode_soal,
                    'judul' => $row->judul,
                    'mulai' => $row->mulai,
                    'akhir' => $row->akhir,
                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Jadwal_ujian'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/jadwal_ujian/jadwal_ujian_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Jadwal_ujian";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Jadwal_ujian",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Jadwal_ujian/create_action'),
	                'id' => set_value('id'),
	                'kode_ujian' => set_value('kode_ujian'),
	                'kode_soal' => set_value('kode_soal'),
	                'judul' => set_value('judul'),
	                'mulai' => set_value('mulai'),
	                'akhir' => set_value('akhir'),
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
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    'kode_soal' => $this->input->post('kode_soal',TRUE),
                    'judul' => $this->input->post('judul',TRUE),
                    'mulai' => $this->input->post('mulai',TRUE),
                    'akhir' => $this->input->post('akhir',TRUE),
                    );

            $this->Jadwal_ujian_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Jadwal_ujian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_ujian_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/jadwal_ujian/jadwal_ujian_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Jadwal_ujian";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Jadwal_ujian",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Jadwal_ujian/update_action'),
                    'id' => set_value('id', $row->id),
                    'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
                    'kode_soal' => set_value('kode_soal', $row->kode_soal),
                    'judul' => set_value('judul', $row->judul),
                    'mulai' => set_value('mulai', $row->mulai),
                    'akhir' => set_value('akhir', $row->akhir),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Jadwal_ujian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    'kode_soal' => $this->input->post('kode_soal',TRUE),
                    'judul' => $this->input->post('judul',TRUE),
                    'mulai' => $this->input->post('mulai',TRUE),
                    'akhir' => $this->input->post('akhir',TRUE),
                    );

            $this->Jadwal_ujian_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Jadwal_ujian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_ujian_model->get_by_id($id);

        if ($row) {
            $this->load->model('Soal_ujian_model');
            $this->Soal_ujian_model->delete_by("kode_soal", $row->kode_soal);

            $this->Jadwal_ujian_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Jadwal_ujian'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Jadwal_ujian'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
       $this->form_validation->set_rules('kode_soal', 'kode soal', 'trim|required');
       $this->form_validation->set_rules('judul', 'judul', 'trim|required');
       $this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
       $this->form_validation->set_rules('akhir', 'akhir', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jadwal_ujian.xls";
        $judul = "jadwal_ujian";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Soal");
        xlsWriteLabel($tablehead, $kolomhead++, "Judul");
        xlsWriteLabel($tablehead, $kolomhead++, "Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Akhir");
        foreach ($this->Jadwal_ujian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ujian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_soal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->akhir);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jadwal_ujian.doc");

        $jadwal_ujian = $this->Jadwal_ujian_model->get_datas($config['per_page'], $start, $q);
        $data = array(
            'jadwal_ujian_data' => $jadwal_ujian,
            'start' => 0
        );
        
        $this->load->view('admin/jadwal_ujian/jadwal_ujian_doc',$data);
    }

}

/* End of file Jadwal_ujian.php */
/* Location: ./application/controllers/Jadwal_ujian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */