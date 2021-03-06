<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "Pekerjaan"),
                        'bootstraps' => array(
                            "assets/css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css",
                            "assets/css/toastr/toastr.min.css",
                            "assets/css/daterangepicker/daterangepicker.css",
                        ),
                        'scripts' => array(
                            "assets/css/moment/moment.min.js",
                            "assets/js/sweetalert2/sweetalert2.min.js",
                            "assets/css/toastr/toastr.min.js",
                            "assets/css/daterangepicker/daterangepicker.js",
                            "assets/js/admin-pekerjaan.js",
                            "assets/js/admin-pekerjaan-form.js",
                        ),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('Pekerjaan_model');
        $this->load->model('Berkas_pekerjaan_model');
        $this->load->model('Pelamar_bahan_model');
        $this->load->model('Jadwal_ujian_model');
        $this->load->library('form_validation');
    }

    public function ajaxRequest_tersedia(){
        $id = $this->input->post("id");
        $set = $this->input->post("value");

        $data = array(
            'tersedia'=>$set
        );
        $this->Pekerjaan_model->update($id, $data);
        echo "success";
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pekerjaan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pekerjaan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pekerjaan/index';
            $config['first_url'] = base_url() . 'admin/Pekerjaan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pekerjaan_model->total_rows($q);
        $pekerjaan = $this->Pekerjaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pekerjaan/pekerjaan_list";
        $this->defaultPageAttribute['title'] = "Data Pekerjaan";
        $data = array(
            'pekerjaan_data' => $pekerjaan,
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
        $row = $this->Pekerjaan_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pekerjaan/pekerjaan_read";
            $this->defaultPageAttribute['title'] = "Detail Pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pekerjaan",
                                                        "Detail",
                                                        );
            $data = array(
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
            $this->session->set_flashdata('messagetype', 'error');
            redirect(site_url('admin/Pekerjaan'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pekerjaan/pekerjaan_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pekerjaan";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Pekerjaan",
                                                    "Tambah Data",
                                                    );

        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pekerjaan/create_action'),
	                'id' => set_value('id'),
                    'data_berkas'=>array(),
                    'data_ujian'=>array(),
	                'posisi_jabatan' => set_value('posisi_jabatan'),
	                'pendaftaran_mulai' => set_value('pendaftaran_mulai'),
                    'pendaftaran_akhir' => set_value('pendaftaran_akhir'),
	                'pendaftaran_tanggal' => set_value('pendaftaran_akhir'),
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
            $s = date("d-m-Y H:i:s");
            $kode_bahan = trim(substr($this->input->post('posisi_jabatan',TRUE), 0, 4)).strtotime($s);
            $kode_ujian = trim(substr($this->input->post('posisi_jabatan',TRUE), 0, 4)).strtotime($s);
            $pendaftaran_mulai = strtotime(str_replace("/", '-', explode(" - ", $this->input->post('pendaftaran_tanggal',TRUE))[0]));
            $pendaftaran_akhir = strtotime(str_replace("/", '-', explode(" - ", $this->input->post('pendaftaran_tanggal',TRUE))[1]));
            $arrBerkas = $this->input->post('nama_berkas',TRUE);
            $arrBerkasType = $this->input->post('tipe_berkas',TRUE);
            $arrUjian = $this->input->post('judul_ujian', TRUE);
            $arrJadwalUjian = $this->input->post('jadwal_ujian',TRUE);
            $arrNilaiUjian = $this->input->post('nilai_ujian', TRUE);

            for($i=0;$i<count($arrUjian);$i++){
                $kode_soal = trim(substr($arrUjian[$i], 0, 4)).strtotime("now");
                $temp = explode(" - ", $arrJadwalUjian[$i]);
                $data_ujian = array(
                    'kode_ujian'=>$kode_ujian,
                    'kode_soal'=>$kode_soal,
                    'judul'=>$arrUjian[$i],
                    'mulai'=>strtotime(str_replace("/", '-', $temp[0]).":00"),
                    'akhir'=>strtotime(str_replace("/", '-', $temp[1]).":00"),
                    'standar_nilai'=> $arrNilaiUjian[$i]
                );
                $this->Jadwal_ujian_model->insert($data_ujian);
            };

            for($i=0;$i<count($arrBerkas);$i++){
                $data_berkas = array(
                    'kode_bahan'=>$kode_bahan,
                    'nama'=>$arrBerkas[$i],
                    'tipe'=>$arrBerkasType[$i]
                );
                $this->Berkas_pekerjaan_model->insert($data_berkas);
            };

            $data = array(
                    'posisi_jabatan' => $this->input->post('posisi_jabatan',TRUE),
                    'pendaftaran_mulai' => $pendaftaran_mulai,
                    'pendaftaran_akhir' => $pendaftaran_akhir,
                    'kode_bahan' => $kode_bahan,
                    'kuota' => $this->input->post('kuota',TRUE),
                    'kode_ujian' => $kode_ujian,
                    'tersedia' => "1",
                    );

            $this->Pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            $this->session->set_flashdata('messagetype', 'success');
            redirect(site_url('admin/Pekerjaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pekerjaan/pekerjaan_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pekerjaan";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Pekerjaan",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pekerjaan/update_action'),
                    'data_berkas' => $this->Berkas_pekerjaan_model->get_data_by("kode_bahan", $row->kode_bahan),
                    'data_ujian' => $this->Jadwal_ujian_model->get_data_by("kode_ujian", $row->kode_ujian),
                    'id' => set_value('id', $row->id),
                    'posisi_jabatan' => set_value('posisi_jabatan', $row->posisi_jabatan),
                    'pendaftaran_mulai' => set_value('pendaftaran_mulai', $row->pendaftaran_mulai),
                    'pendaftaran_akhir' => set_value('pendaftaran_akhir', $row->pendaftaran_akhir),
                    'pendaftaran_tanggal' => date("d/m/Y", $row->pendaftaran_mulai)." - ".date("d/m/Y", $row->pendaftaran_akhir),
                    'kode_bahan' => set_value('kode_bahan', $row->kode_bahan),
                    'kuota' => set_value('kuota', $row->kuota),
                    'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
	                'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            $this->session->set_flashdata('messagetype', 'error');
            redirect(site_url('admin/Pekerjaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $kode_bahan = $this->input->post('kode_bahan', TRUE);
            $kode_ujian = $this->input->post('kode_ujian', TRUE);
            $pendaftaran_mulai = strtotime(str_replace("/", '-', explode(" - ", $this->input->post('pendaftaran_tanggal',TRUE))[0]));
            $pendaftaran_akhir = strtotime(str_replace("/", '-', explode(" - ", $this->input->post('pendaftaran_tanggal',TRUE))[1]));
            $arrIdBerkas = $this->input->post('id_berkas',TRUE);
            $arrBerkas = $this->input->post('nama_berkas', TRUE);
            $arrBerkasType = $this->input->post('tipe_berkas',TRUE);
            $arrIdUjian = $this->input->post('id_ujian',TRUE);
            $arrUjian = $this->input->post('judul_ujian', TRUE);
            $arrJadwalUjian = $this->input->post('jadwal_ujian',TRUE);
            $arrNilaiUjian = $this->input->post('nilai_ujian', TRUE);

            $ujianId = "(";
            for($i=0;$i<count($arrUjian);$i++){
                $temp = explode(" - ", $arrJadwalUjian[$i]);
                $data_ujian = array(
                    'judul'=>$arrUjian[$i],
                    'mulai'=>strtotime(str_replace("/", '-', $temp[0]).":00"),
                    'akhir'=>strtotime(str_replace("/", '-', $temp[1]).":00"),
                    'standar_nilai' => $arrNilaiUjian[$i],
                );
                $this->Jadwal_ujian_model->update($arrIdUjian[$i], $data_ujian);
                $ujianId .= "'" . $arrIdUjian[$i] . "', ";
            };
            $ujianId = substr($ujianId, 0, (strlen($ujianId) - 2)) . ")";
            $this->db->query("DELETE FROM jadwal_ujian WHERE id NOT IN " . $ujianId);

            $berkasId = "(";
            for($i=0;$i<count($arrBerkas);$i++){
                $data_berkas = array(
                    'nama'=>$arrBerkas[$i],
                    'tipe'=>$arrBerkasType[$i]
                );
                $this->Berkas_pekerjaan_model->update($arrIdBerkas[$i], $data_berkas);
                $berkasId .= "'" . $arrIdBerkas[$i] . "', ";
            };
            $berkasId = substr($berkasId, 0, (strlen($berkasId) - 2)) . ")";
            $this->db->query("DELETE FROM berkas_pekerjaan WHERE id NOT IN " . $berkasId);

            $data = array(
                    'posisi_jabatan' => $this->input->post('posisi_jabatan',TRUE),
                    'pendaftaran_mulai' => $pendaftaran_mulai,
                    'pendaftaran_akhir' => $pendaftaran_akhir,
                    'kuota' => $this->input->post('kuota',TRUE),
                    );

            $this->Pekerjaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            $this->session->set_flashdata('messagetype', 'success');
            redirect(site_url('admin/Pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {            
            if(isset($row->kode_bahan)){
                if($row->kode_bahan!=NULL){
                    $this->Berkas_pekerjaan_model->delete_by("kode_bahan", $row->kode_bahan);
                }
            };
            if(isset($row->kode_ujian)){
                if($row->kode_ujian!=NULL){
                    $this->Jadwal_ujian_model->delete_by("kode_ujian", $row->kode_ujian);
                }
            };
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            $this->session->set_flashdata('messagetype', 'success');
            redirect(site_url('admin/Pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            $this->session->set_flashdata('messagetype', 'error');
            redirect(site_url('admin/Pekerjaan'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('posisi_jabatan', 'posisi jabatan', 'trim|required');
       $this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pekerjaan.xls";
        $judul = "pekerjaan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Posisi Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pendaftaran Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Pendaftaran Akhir");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Bahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kuota");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
        foreach ($this->Pekerjaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
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
        header("Content-Disposition: attachment;Filename=pekerjaan.doc");

        $data = array(
            'pekerjaan_data' => $this->Pekerjaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pekerjaan/pekerjaan_doc',$data);
    }

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/Pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */