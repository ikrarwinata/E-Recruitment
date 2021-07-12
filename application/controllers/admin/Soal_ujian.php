<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal_ujian extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "soal_ujian"),
                        'bootstraps' => array(),
                        'scripts' => array(""),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Soal_ujian_model');
        $this->load->library('form_validation');
    }

    public function index($id_soal)
    {
        $soal_ujian = $this->Soal_ujian_model->get_data_by("kode_soal", $id_soal);

        $this->defaultPageAttribute['content'] = "admin/soal_ujian/soal_ujian_form";
        $this->defaultPageAttribute['subtitle'] = array("Pekerjaan", "Ujian", "Soal Ujian");
        $this->defaultPageAttribute['title'] = "Soal Ujian";
        $this->defaultPageAttribute['scripts'] = array(
                                                    "assets/js/admin-form-soal.js"
                                                );
        $data = array(
            'soal_ujian_data' => $soal_ujian,
            'action' => 'admin/Soal_ujian/update_action',
            'kode_soal' => $id_soal,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }
    
    public function update_action() 
    {
        $config['upload_path']          = './files/soal';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2008;
        $config['max_width']            = 13660;
        $config['max_height']           = 7680;
        $this->load->library('upload', $config);

        $soal = $this->input->post("soal");
        $this->Soal_ujian_model->delete_by("kode_soal", $this->input->post("kode_soal"));
        for($i=0;$i<count($soal);$i++){
            $jawaban = "a";
            if ($this->input->post("jawaban".($i+1))!=NULL) {
                $jawaban = $this->input->post("jawaban".($i+1));
            }
            $data_soal = array(
                'kode_soal'=>$this->input->post("kode_soal"),
                'soal'=>$soal[$i],
                'a'=>$this->input->post("a")[$i],
                'b'=>$this->input->post("b")[$i],
                'c'=>$this->input->post("c")[$i],
                'd'=>$this->input->post("d")[$i],
                'e'=>$this->input->post("e")[$i],
                'jawaban'=>$jawaban
            );
            if($this->upload->do_upload("file".($i+1))){
                $udata = $this->upload->data();
                $foto = $config['upload_path']."/"."img".strtotime(date("d-m-Y H:i:s")).$udata["file_ext"];
                rename($udata["full_path"], $foto);
                $data_soal['gambar'] = $foto;
            }elseif($this->input->post("filegambar".($i+1))!=NULL){
                $data_soal['gambar'] = $this->input->post("filegambar".($i+1));
            };
            $this->Soal_ujian_model->insert($data_soal);
        };
        $this->session->set_flashdata('message', 'Data berhasil diperbarui');
        redirect(site_url('admin/Jadwal_ujian'));
    }
    
    public function delete($id) 
    {
        $row = $this->Soal_ujian_model->get_by_id($id);

        if ($row) {
            $this->Soal_ujian_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Soal_ujian'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Soal_ujian'));
        }
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "soal_ujian.xls";
        $judul = "soal_ujian";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Soal");
        xlsWriteLabel($tablehead, $kolomhead++, "A");
        xlsWriteLabel($tablehead, $kolomhead++, "B");
        xlsWriteLabel($tablehead, $kolomhead++, "C");
        xlsWriteLabel($tablehead, $kolomhead++, "D");
        xlsWriteLabel($tablehead, $kolomhead++, "E");
        xlsWriteLabel($tablehead, $kolomhead++, "F");
        xlsWriteLabel($tablehead, $kolomhead++, "Jawaban");
        foreach ($this->Soal_ujian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->soal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->a);
	    xlsWriteLabel($tablebody, $kolombody++, $data->b);
	    xlsWriteLabel($tablebody, $kolombody++, $data->c);
	    xlsWriteLabel($tablebody, $kolombody++, $data->d);
	    xlsWriteLabel($tablebody, $kolombody++, $data->e);
	    xlsWriteLabel($tablebody, $kolombody++, $data->f);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jawaban);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word($id_soal)
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=soal_ujian.doc");
        $this->load->model('Jadwal_ujian_model');
        $this->load->model('Pekerjaan_model');
        $jadwal = $this->Jadwal_ujian_model->get_by("kode_soal", $id_soal);
        $pekerjaan = $this->Pekerjaan_model->get_by("kode_ujian", $jadwal->kode_ujian);
        $soal_ujian = $this->Soal_ujian_model->get_data_by("kode_soal", $id_soal);

        $data = array(
            'soal_ujian_data' => $soal_ujian,
            'action' => 'admin/Soal_ujian/update_action',
            'kode_soal' => $id_soal,
            'ujian'=>$jadwal,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view("admin/soal_ujian/soal_ujian_doc", $data);
    }

}

/* End of file Soal_ujian.php */
/* Location: ./application/controllers/Soal_ujian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */