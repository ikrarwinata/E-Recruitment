<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelamar_bahan extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Berkas Pelamar",
                        'subtitle' => array("Pelamar", "Berkas Pelamar"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelamar_bahan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelamar_bahan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelamar_bahan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelamar_bahan/index';
            $config['first_url'] = base_url() . 'admin/Pelamar_bahan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelamar_bahan_model->total_rows($q);
        $pelamar_bahan = $this->Pelamar_bahan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pelamar_bahan/pelamar_bahan_list";
        $this->defaultPageAttribute['title'] = "Berkas Pelamar";
        $data = array(
            'pelamar_bahan_data' => $pelamar_bahan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function pelamar($nik, $idp)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelamar_bahan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelamar_bahan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelamar_bahan/index';
            $config['first_url'] = base_url() . 'admin/Pelamar_bahan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelamar_bahan_model->total_rows_pelamar($nik, $idp);
        $pelamar_bahan = $this->Pelamar_bahan_model->get_data_pelamar($nik, $idp);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pelamar_bahan/pelamar_bahan_list";
        $this->defaultPageAttribute['title'] = "Berkas ".$this->db->query("SELECT nama FROM pelamar WHERE nik='".$nik."'")->row()->nama;
        $data = array(
            'pelamar_bahan_data' => $pelamar_bahan,
            'q' => $nik,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pelamar_bahan/pelamar_bahan_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pelamar_bahan";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Pelamar_bahan",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar_bahan/create_action'),
	                'id' => set_value('id'),
	                'nik' => set_value('nik'),
	                'id_berkas' => set_value('id_berkas'),
	                'file_path' => set_value('file_path'),
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
                    'id_berkas' => $this->input->post('id_berkas',TRUE),
                    'file_path' => $this->input->post('file_path',TRUE),
                    );

            $this->Pelamar_bahan_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Pelamar_bahan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelamar_bahan_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pelamar_bahan/pelamar_bahan_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pelamar_bahan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pelamar_bahan",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar_bahan/update_action'),
                    'id' => set_value('id', $row->id),
                    'nik' => set_value('nik', $row->nik),
                    'id_berkas' => set_value('id_berkas', $row->id_berkas),
                    'file_path' => set_value('file_path', $row->file_path),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar_bahan'));
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
                    'id_berkas' => $this->input->post('id_berkas',TRUE),
                    'file_path' => $this->input->post('file_path',TRUE),
                    );

            $this->Pelamar_bahan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Pelamar_bahan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelamar_bahan_model->get_by_id($id);

        if ($row) {
            $this->Pelamar_bahan_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Pelamar_bahan'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar_bahan'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('nik', 'nik', 'trim|required');
       $this->form_validation->set_rules('id_berkas', 'id berkas', 'trim|required');
       $this->form_validation->set_rules('file_path', 'file path', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pelamar_bahan.xls";
        $judul = "pelamar_bahan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nik");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Berkas");
        xlsWriteLabel($tablehead, $kolomhead++, "File Path");
        $this->Pelamar_bahan_model->db->join("pelamar", "pelamar.nik=pelamar_bahan.nik");
        foreach ($this->Pelamar_bahan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nik);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_berkas);
            xlsWriteLabel($tablebody, $kolombody++, base_url($data->file_path));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pelamar_bahan.doc");

        $this->Pelamar_bahan_model->db->join("pelamar", "pelamar.nik=pelamar_bahan.nik");
        $data = array(
            'pelamar_bahan_data' => $this->Pelamar_bahan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pelamar_bahan/pelamar_bahan_doc',$data);
    }

}

/* End of file Pelamar_bahan.php */
/* Location: ./application/controllers/Pelamar_bahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */