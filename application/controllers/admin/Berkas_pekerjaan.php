<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berkas_pekerjaan extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Berkas Lampiran Pekerjaan",
                        'subtitle' => array("Pekerjaan", "Berkas lampiran"),
                        'bootstraps' => array(),
                        'scripts' => array('assets/js/admin-berkas-lampiran.js'),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('Berkas_pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Berkas_pekerjaan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Berkas_pekerjaan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Berkas_pekerjaan/index';
            $config['first_url'] = base_url() . 'admin/Berkas_pekerjaan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Berkas_pekerjaan_model->total_rows($q);
        $berkas_pekerjaan = $this->Berkas_pekerjaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/berkas_pekerjaan/berkas_pekerjaan_list";
        $this->defaultPageAttribute['title'] = "Berkas Lampiran Pekerjaan";
        $data = array(
            'berkas_pekerjaan_data' => $berkas_pekerjaan,
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
            $config['base_url'] = base_url() . 'admin/Berkas_pekerjaan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Berkas_pekerjaan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Berkas_pekerjaan/index';
            $config['first_url'] = base_url() . 'admin/Berkas_pekerjaan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Berkas_pekerjaan_model->total_rows_pekerjaan($id, $q);
        $berkas_pekerjaan = $this->Berkas_pekerjaan_model->get_limit_data_pekerjaan($id, $config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/berkas_pekerjaan/berkas_pekerjaan_list";
        $this->defaultPageAttribute['title'] = "Berkas Lampiran Pekerjaan";
        $data = array(
            'berkas_pekerjaan_data' => $berkas_pekerjaan,
            'q' => $berkas_pekerjaan[0]->posisi_jabatan,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function read($id) 
    {
        $row = $this->Berkas_pekerjaan_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/berkas_pekerjaan/berkas_pekerjaan_read";
            $this->defaultPageAttribute['title'] = "Detail Berkas Lampiran Pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Berkas_pekerjaan",
                                                        "Detail",
                                                        );
            $data = array(
                    'id' => $row->id,
                    'kode_bahan' => $row->kode_bahan,
                    'nama' => $row->nama,
                    'tipe' => $row->tipe,
                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Berkas_pekerjaan'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/berkas_pekerjaan/berkas_pekerjaan_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Berkas_pekerjaan";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Berkas_pekerjaan",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Berkas_pekerjaan/create_action'),
	                'id' => set_value('id'),
	                'kode_bahan' => set_value('kode_bahan'),
	                'nama' => set_value('nama'),
	                'tipe' => set_value('tipe'),
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
                    'kode_bahan' => $this->input->post('kode_bahan',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'tipe' => $this->input->post('tipe',TRUE),
                    );

            $this->Berkas_pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Berkas_pekerjaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Berkas_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/berkas_pekerjaan/berkas_pekerjaan_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Berkas_pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Berkas_pekerjaan",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Berkas_pekerjaan/update_action'),
                    'id' => set_value('id', $row->id),
                    'kode_bahan' => set_value('kode_bahan', $row->kode_bahan),
                    'nama' => set_value('nama', $row->nama),
                    'tipe' => set_value('tipe', $row->tipe),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Berkas_pekerjaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                    'kode_bahan' => $this->input->post('kode_bahan',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'tipe' => $this->input->post('tipe',TRUE),
                    );

            $this->Berkas_pekerjaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Berkas_pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Berkas_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Berkas_pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Berkas_pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Berkas_pekerjaan'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('kode_bahan', 'kode bahan', 'trim|required');
       $this->form_validation->set_rules('nama', 'nama', 'trim|required');
       $this->form_validation->set_rules('tipe', 'tipe', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "berkas_pekerjaan.xls";
        $judul = "berkas_pekerjaan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Bahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe");
        foreach ($this->Berkas_pekerjaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_bahan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tipe);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=berkas_pekerjaan.doc");

        $data = array(
            'berkas_pekerjaan_data' => $this->Berkas_pekerjaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/berkas_pekerjaan/berkas_pekerjaan_doc',$data);
    }

}

/* End of file Berkas_pekerjaan.php */
/* Location: ./application/controllers/Berkas_pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */