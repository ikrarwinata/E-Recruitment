<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Administrator",
                        'subtitle' => array("Home"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model("Pekerjaan_model");
        $this->load->model("Pengumuman_model");
        $this->defaultPageAttribute['content'] = "admin/home";
        $this->defaultPageAttribute['title'] = "Dashboard";
        $this->defaultPageAttribute['subtitle'] = array("Dashboard");
        $data = array(
            'totalpekerjaan'=>$this->Pekerjaan_model->get_total_tersedia(),
            'totalpengumuan'=>$this->Pengumuman_model->get_total_tersedia(),
            'data_pengumuan'=>$this->Pengumuman_model->get_pengumuman(),
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function data_perusahaan()
    {
        $this->defaultPageAttribute['content'] = "admin/perusahaan/perusahaan_list";
        $this->defaultPageAttribute['title'] = "Data Perusahaan";
        $this->defaultPageAttribute['subtitle'] = array("Perusahaan");
        $data = array(
            'logo' => $this->db->where("lokasi", "logo")->get("perusahaan")->row(),
            'slider1' => $this->db->where("lokasi", "slider 1")->get("perusahaan")->row(),
            'slider2' => $this->db->where("lokasi", "slider 2")->get("perusahaan")->row(),
            'slider3' => $this->db->where("lokasi", "slider 3")->get("perusahaan")->row(),
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function data_perusahaan_action()
    {
        $slider1 = array(
            'judul' => $this->input->post("judulslider1"),
            'deskripsi' => $this->input->post("deskripsislider1"),
        );
        $slider2 = array(
            'judul' => $this->input->post("judulslider2"),
            'deskripsi' => $this->input->post("deskripsislider2"),
        );
        $slider3 = array(
            'judul' => $this->input->post("judulslider3"),
            'deskripsi' => $this->input->post("deskripsislider3"),
        );
        $this->db->where("lokasi", "slider 1")->update("perusahaan", $slider1);
        $this->db->where("lokasi", "slider 2")->update("perusahaan", $slider2);
        $this->db->where("lokasi", "slider 3")->update("perusahaan", $slider3);


        $config['upload_path']          = './assets';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
        $config['max_size']             = 2008;
        $config['max_width']            = 13660;
        $config['max_height']           = 7680;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('logo')) {
            $oldlogo = $this->db->where("lokasi", "logo")->get("perusahaan")->row();
            if(isset($oldlogo->deskripsi) && $oldlogo->deskripsi != NULL){
                if(file_exists($oldlogo->deskripsi)) unlink($oldlogo->deskripsi);
            }
            
            $logo = $config['upload_path'] . "/" . "logo" . $this->upload->data("file_ext");
            rename($this->upload->data("full_path"), $logo);
            $d = array(
                'judul' => NULL,
                'deskripsi' => $logo,
            );
            $this->db->where("lokasi", "logo")->update("perusahaan", $d);
        };

        redirect(site_url('admin/Dashboard/data_perusahaan'));
    }
}
