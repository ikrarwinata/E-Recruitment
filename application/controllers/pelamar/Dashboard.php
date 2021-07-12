<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
                        'title' => "Beranda",
                        'subtitle' => array("Home"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
		$this->load->model("Pelamar_model");
		$this->load->model("Pekerjaan_model");
		$this->load->model("Pelamar_bahan_model");
		$this->load->model("Berkas_pekerjaan_model");
        $this->load->library('form_validation');
    }

    public function test(){
        $now = strtotime("now");
        $target = 1613653200;
        $newline = "<br>";
        echo $this->session->userdata("kode_ujian").$newline;
        echo date("d M Y H:i:s", $now)." ".$now.$newline;
        echo date("d M Y H:i:s", $target)." ".$target.$newline;
        echo date("d M Y H:i:s", ($now+1800))." ".($now+1800).$newline;
    }

	public function index()
	{
        $this->defaultPageAttribute['content'] = "pelamar/home";
        $this->defaultPageAttribute['title'] = "Beranda";
        $this->defaultPageAttribute['subtitle'] = array("Beranda");

        $pk = $this->Pekerjaan_model->get_pelamar_by("id", $this->session->userdata("id_posisi"));
        $bp = $this->Pelamar_bahan_model->get_by("nik", $this->session->userdata("nik"));
        $bk=array();
        if (count($pk)) {
        	$bk = $this->Berkas_pekerjaan_model->get_by("kode_bahan", $pk->kode_bahan);
        }
        $data = array(
        	'pekerjaan'=>$pk,
        	'bahan_pelamar'=>$bp,
        	'bahan_pekerjaan'=>$bk,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
	}
    
    public function profile() 
    {
        $row = $this->Pelamar_model->get_by_id($this->session->userdata("nik"));

        if ($row) {
            $this->defaultPageAttribute['content'] = "pelamar/profile";
            $this->defaultPageAttribute['title'] = "Ubah Profile";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Ubah Profile",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('pelamar/Dashboard/update_action'),
                    'formasi' => $this->Pekerjaan_model->get_pekerjaan(),
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
            redirect(site_url('Welcome/logout'));
        }
    }
    
    public function update_action() 
    {
    	$check = $this->Pelamar_model->get_akun($this->session->userdata("username"), $this->input->post('password',TRUE));
    	if (count($check)<=0) {
        	$this->session->set_flashdata('msgpassword', 'Password yang anda masukan salah');
        	$this->profile();
        	return false;
    	}
    	if ($this->session->userdata("username")!=$this->input->post("username")) {
    		if (count($this->Pelamar_model->get_by("username",$this->input->post("username")))>=1) {
	        	$this->session->set_flashdata('msgusername', 'Username ini sudah digunakan');
	        	$this->profile();
	        	return false;
	    	}
    	}
    	if ($this->input->post('passwordb',TRUE)!=$this->input->post('passwordbb',TRUE)) {
    		$this->session->set_flashdata('msgpasswordb', 'Konfirmasi password tidak cocok');
        	$this->profile();
        	return false;
    	}

        $data['nik'] = $this->input->post('nik',TRUE);
        $data['nama'] = $this->input->post('nama',TRUE);
        $data['jenis_kelamin'] = $this->input->post('jenis_kelamin',TRUE);
        $data['status'] = $this->input->post('status',TRUE);
        $data['pekerjaan'] = $this->input->post('pekerjaan',TRUE);
        $data['tinggi_badan'] = $this->input->post('tinggi_badan',TRUE);
        $data['berat_badan'] = $this->input->post('berat_badan',TRUE);
        $data['email'] = $this->input->post('email',TRUE);
        $data['hp'] = $this->input->post('hp',TRUE);
        $data['alamat'] = $this->input->post('alamat',TRUE);
        $data['username'] = $this->input->post('username',TRUE);
        if ($this->input->post('passwordb',TRUE)!=NULL) {
        	$data['password'] = md5($this->input->post('passwordb',TRUE));
        }
        
        $this->Pelamar_model->update($this->session->userdata("nik"), $data);


        $sess_data['nik'] = $this->input->post("nik");
        $sess_data['username'] = $this->input->post('username',TRUE);
        $sess_data['password'] = md5($this->input->post("password"));
        $sess_data['nama'] = $this->input->post("nama");
        $sess_data['jenis_kelamin'] = $this->input->post("jenis_kelamin");
        $sess_data['level'] = "User";
        $this->load->model("Jadwal_ujian_model");
        $ujian = $this->Jadwal_ujian_model->get_by("kode_ujian");
        if (count($ujian)>=1) {
            $sess_data['kode_ujian'] = $ujian->kode_ujian;
        }
        $this->session->set_userdata($sess_data);

        $this->session->set_flashdata('message', 'Data berhasil diperbarui');
        redirect(site_url("User"));
    }
}
