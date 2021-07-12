<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    private $container = "pelamar/container";
    private $defaultPageAttribute = array(
                        'title' => "Berkas",
                        'subtitle' => array("Berkas"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "pelamar/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
		$this->load->model("Pelamar_model");
		$this->load->model("Pekerjaan_model");
		$this->load->model("Pelamar_bahan_model");
		$this->load->model("Berkas_pekerjaan_model");
        $this->load->helper('url', 'form'); 
        $this->load->library('form_validation');
    }

	public function index()
	{
        $this->defaultPageAttribute['content'] = "pelamar/berkas";
        $this->defaultPageAttribute['title'] = "Berkas";
        $this->defaultPageAttribute['subtitle'] = array("Berkas Persyaratan");
        $this->defaultPageAttribute['scripts'] = array('assets/js/pelamar-berkas.js');
        $b = $this->db->query("SELECT * FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$this->session->userdata("nik")."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$this->session->userdata("id_posisi")."' LIMIT 1 OFFSET 0))")->result();
        $data = array(
            'berkas_data'=>$this->Pelamar_bahan_model->get_berkas($this->session->userdata("id_posisi")),
        	'berkas_uploaded_data'=>$b,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
	}

    public function action(){
        $config['upload_path']          = "files/bahan/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp|pdf|doc|xml|xmls|docx|txt';
        $config['max_size']             = 11000;
        $this->load->library('upload', $config);
        $berkas = $this->Pelamar_bahan_model->get_berkas($this->session->userdata("id_posisi"), $this->session->userdata("nik"));
        foreach ($berkas as $key => $value) {
            if ($this->upload->do_upload($value->id)) {
                if (isset($value->id)) {
                    $row = $this->Pelamar_bahan_model->get_pelamar_berkas($this->session->userdata("nik"), $value->id);
                    if (count($row)>=1) {
                        unlink($row->file_path);
                        $this->Pelamar_bahan_model->delete_pelamar_berkas($this->session->userdata("nik"), $value->id);
                    };
                };

                $udata = $this->upload->data();
                $file = $config['upload_path'].strtotime("now").$value->id.$udata["file_ext"];
                rename($udata["full_path"], $file);

                $data = array(
                    'nik'=>$this->session->userdata("nik"),
                    'id_berkas'=>$value->id,
                    'file_path'=>$file
                );

                $this->Pelamar_bahan_model->insert($data);
            }
        }

        $bp = $this->Pelamar_bahan_model->get_data_by("nik", $this->session->userdata("nik"));
        $bk=array();
        $ujian = $this->Pekerjaan_model->get_by("id", $this->session->userdata("id_posisi"));
        if (count($ujian)>=1) {
            $bk = $this->Berkas_pekerjaan_model->get_data_by("kode_bahan", $ujian->kode_bahan);
            if (count($bp)==count($bk)) {
                $sess_data['kode_ujian'] = $ujian->kode_ujian;
            }
        };
        $this->session->set_userdata($sess_data);

        redirect("pelamar/Berkas");
    }
}
