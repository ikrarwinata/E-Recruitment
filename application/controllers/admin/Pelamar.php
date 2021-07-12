<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelamar extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "pelamar"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelamar_model');
        $this->load->model('Pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pelamar/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pelamar/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pelamar/index';
            $config['first_url'] = base_url() . 'admin/Pelamar/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelamar_model->total_rows_pelamar($q);
        $pelamar = $this->Pelamar_model->get_limit_data_pelamar($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pelamar/pelamar_list";
        $this->defaultPageAttribute['title'] = "Data Pelamar";
        foreach ($pelamar as $key => $value) {
            $value->total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian IN (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."'))")->row()->total;
            $value->soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$value->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian = (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)))")->row()->total;
            $value->total_berkas = $this->db->query("SELECT COUNT(a.id) AS total FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)")->row()->total;
            $value->berkas = $this->db->query("SELECT COUNT(pelamar_bahan.id) AS total FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$value->nik."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0))")->row()->total;
            $jadwal = $this->db->query("SELECT jadwal_ujian.* FROM jadwal_ujian WHERE jadwal_ujian.kode_ujian = (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."')")->result();
            $ctu = 0;
            $c = 0;
            foreach ($jadwal as $key => $ujian) {
                $total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal = '".$ujian->kode_soal."'")->row()->total;
                $jawaban_benar = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a LEFT OUTER JOIN soal_ujian b ON a.id_soal = b.id WHERE a.jawaban=b.jawaban AND a.nik = '".$value->nik."' AND b.kode_soal = '".$ujian->kode_soal."'")->row()->total;
                if ($jawaban_benar >= 1 && $total_soal >= 1) {
                    $ctu += round(($jawaban_benar / $total_soal) * 100, 0);
                }else{
                    $ctu += 0;
                }
                $c++;
            }
            $value->score = round($ctu / $c, 0);
        }
        $data = array(
            'pelamar_data' => $pelamar,
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
        $row = $this->Pelamar_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pelamar/pelamar_read";
            $this->defaultPageAttribute['title'] = "Detail Pelamar";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pelamar",
                                                        "Detail",
                                                        );
            $data = array(
                    'nik' => $row->nik,
                    'id_posisi' => $row->id_posisi,
                    'formasi' => $this->Pekerjaan_model->get_by("id", $row->id_posisi)->posisi_jabatan,
                    'nama' => $row->nama,
                    'jenis_kelamin' => $row->jenis_kelamin,
                    'status' => $row->status,
                    'pekerjaan' => $row->pekerjaan,
                    'tinggi_badan' => $row->tinggi_badan,
                    'berat_badan' => $row->berat_badan,
                    'email' => $row->email,
                    'hp' => $row->hp,
                    'alamat' => $row->alamat,
                    'username' => $row->username,
                    'password' => $row->password,
                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pelamar/pelamar_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pelamar";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Pelamar",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar/create_action'),
	                'nik' => set_value('nik'),
	                'id_posisi' => set_value('id_posisi'),
	                'nama' => set_value('nama'),
	                'jenis_kelamin' => set_value('jenis_kelamin'),
	                'status' => set_value('status'),
	                'pekerjaan' => set_value('pekerjaan'),
	                'tinggi_badan' => set_value('tinggi_badan'),
	                'berat_badan' => set_value('berat_badan'),
	                'email' => set_value('email'),
	                'hp' => set_value('hp'),
	                'alamat' => set_value('alamat'),
	                'username' => set_value('username'),
	                'password' => set_value('password'),
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
                    'id_posisi' => $this->input->post('id_posisi',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                    'status' => $this->input->post('status',TRUE),
                    'pekerjaan' => $this->input->post('pekerjaan',TRUE),
                    'tinggi_badan' => $this->input->post('tinggi_badan',TRUE),
                    'berat_badan' => $this->input->post('berat_badan',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'hp' => $this->input->post('hp',TRUE),
                    'alamat' => $this->input->post('alamat',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => $this->input->post('password',TRUE),
                    );

            $this->Pelamar_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Pelamar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelamar_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pelamar/pelamar_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pelamar";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pelamar",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pelamar/update_action'),
                    'nik' => set_value('nik', $row->nik),
                    'id_posisi' => set_value('id_posisi', $row->id_posisi),
                    'nama' => set_value('nama', $row->nama),
                    'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                    'status' => set_value('status', $row->status),
                    'pekerjaan' => set_value('pekerjaan', $row->pekerjaan),
                    'tinggi_badan' => set_value('tinggi_badan', $row->tinggi_badan),
                    'berat_badan' => set_value('berat_badan', $row->berat_badan),
                    'email' => set_value('email', $row->email),
                    'hp' => set_value('hp', $row->hp),
                    'alamat' => set_value('alamat', $row->alamat),
                    'username' => set_value('username', $row->username),
                    'password' => set_value('password', $row->password),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nik', TRUE));
        } else {
            $data = array(
                    'id_posisi' => $this->input->post('id_posisi',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                    'status' => $this->input->post('status',TRUE),
                    'pekerjaan' => $this->input->post('pekerjaan',TRUE),
                    'tinggi_badan' => $this->input->post('tinggi_badan',TRUE),
                    'berat_badan' => $this->input->post('berat_badan',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    'hp' => $this->input->post('hp',TRUE),
                    'alamat' => $this->input->post('alamat',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => $this->input->post('password',TRUE),
                    );

            $this->Pelamar_model->update($this->input->post('nik', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Pelamar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelamar_model->get_by_id($id);

        if ($row) {
            $this->load->model("Pelamar_bahan_model");
            $this->load->model("Pelamar_jawaban_model");
            $bahan = $this->Pelamar_bahan_model->get_data_by("nik", $row->nik);
            if($bahan){
                foreach ($bahan as $key => $value) {
                    if (isset($value->file_path)) {
                        if ($value->file_path!=NULL) {
                            if (file_exists($value->file_path)) {
                                unlink($value->file_path);
                            }
                        }
                    }
                }
            }
            $this->Pelamar_bahan_model->delete_by("nik", $row->nik);
            $this->Pelamar_jawaban_model->delete_by("nik", $row->nik);

            $this->Pelamar_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Pelamar'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pelamar'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('id_posisi', 'id posisi', 'trim|required');
       $this->form_validation->set_rules('nama', 'nama', 'trim|required');
       $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
       $this->form_validation->set_rules('status', 'status', 'trim|required');
       $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
       $this->form_validation->set_rules('tinggi_badan', 'tinggi badan', 'trim|required');
       $this->form_validation->set_rules('berat_badan', 'berat badan', 'trim|required');
       $this->form_validation->set_rules('email', 'email', 'trim|required');
       $this->form_validation->set_rules('hp', 'hp', 'trim|required');
       $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
       $this->form_validation->set_rules('username', 'username', 'trim|required');
       $this->form_validation->set_rules('password', 'password', 'trim|required');
       $this->form_validation->set_rules('nik', 'nik', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->model("Pelamar_excel");
        $this->Pelamar_excel->export();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pelamar.doc");

        $pelamar = $this->Pelamar_model->get_data_pelamar();
        foreach ($pelamar as $key => $value) {
            $value->total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian IN (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."'))")->row()->total;
            $value->soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$value->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian = (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)))")->row()->total;
            $value->total_berkas = $this->db->query("SELECT COUNT(a.id) AS total FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)")->row()->total;
            $value->berkas = $this->db->query("SELECT COUNT(pelamar_bahan.id) AS total FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$value->nik."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0))")->row()->total;
            $jadwal = $this->db->query("SELECT jadwal_ujian.* FROM jadwal_ujian WHERE jadwal_ujian.kode_ujian = (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."')")->result();
            $ctu = 0;
            $c = 0;
            foreach ($jadwal as $key => $ujian) {
                $total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal = '".$ujian->kode_soal."'")->row()->total;
                $jawaban_benar = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a LEFT OUTER JOIN soal_ujian b ON a.id_soal = b.id WHERE a.jawaban=b.jawaban AND a.nik = '".$value->nik."' AND b.kode_soal = '".$ujian->kode_soal."'")->row()->total;
                if ($jawaban_benar >= 1 && $total_soal >= 1) {
                    $ctu += round(($jawaban_benar / $total_soal) * 100, 0);
                }else{
                    $ctu += 0;
                }
                $c++;
            }
            $value->score = round($ctu / $c, 0);
        }
        $data = array(
            'pelamar_data' => $pelamar,
            'start' => 0
        );
        
        $this->load->view('admin/pelamar/pelamar_doc',$data);
    }

}

/* End of file Pelamar.php */
/* Location: ./application/controllers/Pelamar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */