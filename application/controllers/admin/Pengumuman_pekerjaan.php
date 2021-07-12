<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengumuman_pekerjaan extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "pengumuman_pekerjaan"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengumuman_pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pengumuman_pekerjaan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pengumuman_pekerjaan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pengumuman_pekerjaan/index';
            $config['first_url'] = base_url() . 'admin/Pengumuman_pekerjaan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengumuman_pekerjaan_model->total_rows($q);
        $pengumuman_pekerjaan = $this->Pengumuman_pekerjaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pengumuman_pekerjaan/pengumuman_pekerjaan_list";
        $this->defaultPageAttribute['title'] = "Data Pengumuman_pekerjaan";
        $data = array(
            'pengumuman_pekerjaan_data' => $pengumuman_pekerjaan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function read($id) 
    {
        $row = $this->Pengumuman_pekerjaan_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pengumuman_pekerjaan/pengumuman_pekerjaan_read";
            $this->defaultPageAttribute['title'] = "Detail Pengumuman_pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pengumuman_pekerjaan",
                                                        "Detail",
                                                        );
            $data = array(
                    'id_pengumuman' => $row->id_pengumuman,
                    'judul' => $row->judul,
                    'banner' => $row->banner,
                    'deskripsi' => $row->deskripsi,
                    'timestamps' => $row->timestamps,
                    'id' => $row->id,
                    'posisi_jabatan' => $row->posisi_jabatan,
                    'pendaftaran_mulai' => $row->pendaftaran_mulai,
                    'pendaftaran_akhir' => $row->pendaftaran_akhir,
                    'kode_bahan' => $row->kode_bahan,
                    'kuota' => $row->kuota,
                    'kode_ujian' => $row->kode_ujian,
                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pengumuman_pekerjaan/pengumuman_pekerjaan_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pengumuman_pekerjaan";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Pengumuman_pekerjaan",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pengumuman_pekerjaan/create_action'),
	                'id_pengumuman' => set_value('id_pengumuman'),
	                'judul' => set_value('judul'),
	                'banner' => set_value('banner'),
	                'deskripsi' => set_value('deskripsi'),
	                'timestamps' => set_value('timestamps'),
	                'id' => set_value('id'),
	                'posisi_jabatan' => set_value('posisi_jabatan'),
	                'pendaftaran_mulai' => set_value('pendaftaran_mulai'),
	                'pendaftaran_akhir' => set_value('pendaftaran_akhir'),
	                'kode_bahan' => set_value('kode_bahan'),
	                'kuota' => set_value('kuota'),
	                'kode_ujian' => set_value('kode_ujian'),
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
                    'id_pengumuman' => $this->input->post('id_pengumuman',TRUE),
                    'judul' => $this->input->post('judul',TRUE),
                    'banner' => $this->input->post('banner',TRUE),
                    'deskripsi' => $this->input->post('deskripsi',TRUE),
                    'timestamps' => $this->input->post('timestamps',TRUE),
                    'id' => $this->input->post('id',TRUE),
                    'posisi_jabatan' => $this->input->post('posisi_jabatan',TRUE),
                    'pendaftaran_mulai' => $this->input->post('pendaftaran_mulai',TRUE),
                    'pendaftaran_akhir' => $this->input->post('pendaftaran_akhir',TRUE),
                    'kode_bahan' => $this->input->post('kode_bahan',TRUE),
                    'kuota' => $this->input->post('kuota',TRUE),
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    );

            $this->Pengumuman_pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengumuman_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pengumuman_pekerjaan/pengumuman_pekerjaan_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pengumuman_pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pengumuman_pekerjaan",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pengumuman_pekerjaan/update_action'),
                    'id_pengumuman' => set_value('id_pengumuman', $row->id_pengumuman),
                    'judul' => set_value('judul', $row->judul),
                    'banner' => set_value('banner', $row->banner),
                    'deskripsi' => set_value('deskripsi', $row->deskripsi),
                    'timestamps' => set_value('timestamps', $row->timestamps),
                    'id' => set_value('id', $row->id),
                    'posisi_jabatan' => set_value('posisi_jabatan', $row->posisi_jabatan),
                    'pendaftaran_mulai' => set_value('pendaftaran_mulai', $row->pendaftaran_mulai),
                    'pendaftaran_akhir' => set_value('pendaftaran_akhir', $row->pendaftaran_akhir),
                    'kode_bahan' => set_value('kode_bahan', $row->kode_bahan),
                    'kuota' => set_value('kuota', $row->kuota),
                    'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
                    'id_pengumuman' => $this->input->post('id_pengumuman',TRUE),
                    'judul' => $this->input->post('judul',TRUE),
                    'banner' => $this->input->post('banner',TRUE),
                    'deskripsi' => $this->input->post('deskripsi',TRUE),
                    'timestamps' => $this->input->post('timestamps',TRUE),
                    'id' => $this->input->post('id',TRUE),
                    'posisi_jabatan' => $this->input->post('posisi_jabatan',TRUE),
                    'pendaftaran_mulai' => $this->input->post('pendaftaran_mulai',TRUE),
                    'pendaftaran_akhir' => $this->input->post('pendaftaran_akhir',TRUE),
                    'kode_bahan' => $this->input->post('kode_bahan',TRUE),
                    'kuota' => $this->input->post('kuota',TRUE),
                    'kode_ujian' => $this->input->post('kode_ujian',TRUE),
                    );

            $this->Pengumuman_pekerjaan_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengumuman_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pengumuman_pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pengumuman_pekerjaan'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('id_pengumuman', 'id pengumuman', 'trim|required');
       $this->form_validation->set_rules('judul', 'judul', 'trim|required');
       $this->form_validation->set_rules('banner', 'banner', 'trim|required');
       $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
       $this->form_validation->set_rules('timestamps', 'timestamps', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim|required');
       $this->form_validation->set_rules('posisi_jabatan', 'posisi jabatan', 'trim|required');
       $this->form_validation->set_rules('pendaftaran_mulai', 'pendaftaran mulai', 'trim|required');
       $this->form_validation->set_rules('pendaftaran_akhir', 'pendaftaran akhir', 'trim|required');
       $this->form_validation->set_rules('kode_bahan', 'kode bahan', 'trim|required');
       $this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
       $this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
       $this->form_validation->set_rules('', '', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengumuman_pekerjaan.xls";
        $judul = "pengumuman_pekerjaan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Pengumuman");
        xlsWriteLabel($tablehead, $kolomhead++, "Judul");
        xlsWriteLabel($tablehead, $kolomhead++, "Banner");
        xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
        xlsWriteLabel($tablehead, $kolomhead++, "Timestamps");
        xlsWriteLabel($tablehead, $kolomhead++, "Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Posisi Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pendaftaran Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Pendaftaran Akhir");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Bahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kuota");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
        foreach ($this->Pengumuman_pekerjaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pengumuman);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteLabel($tablebody, $kolombody++, $data->banner);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->timestamps);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->posisi_jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pendaftaran_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pendaftaran_akhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_bahan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kuota);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ujian);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pengumuman_pekerjaan.doc");

        $data = array(
            'pengumuman_pekerjaan_data' => $this->Pengumuman_pekerjaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pengumuman_pekerjaan/pengumuman_pekerjaan_doc',$data);
    }

}

/* End of file Pengumuman_pekerjaan.php */
/* Location: ./application/controllers/Pengumuman_pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */