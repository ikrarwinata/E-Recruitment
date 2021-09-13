<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
    }

	public function index()
	{
		$this->load->model("Pengumuman_model");

		$data = array(
			'data_loker'=>$this->Pengumuman_model->get_pengumuman(),
			'content'=>'home'
		);
		$this->load->view('container',$data);
	}

    public function register(){
        if($this->input->post("id_posisi")==NULL){
            $this->index();
        }else{
            $this->load->model("Pelamar_model");
            if ($this->Pelamar_model->total_rows_by("nik", $this->input->post("nik"))>=1) {
                $this->session->set_flashdata('registerfailed', 'Upss... NIK tersebut telah digunakan!');
                $this->index();
                return false;
            }

            $usr = $this->input->post("nik");
            $data = array(
                'nik'=>$this->input->post("nik"),
                'id_posisi'=>$this->input->post("id_posisi"),
                'nama'=>$this->input->post("nama"),
                'jenis_kelamin'=>$this->input->post("jk"),
                'status'=>$this->input->post("status"),
                'pekerjaan'=>$this->input->post("pekerjaan"),
                'tinggi_badan'=>$this->input->post("tinggi_badan"),
                'berat_badan'=>$this->input->post("berat_badan"),
                'email'=>$this->input->post("email"),
                'hp'=>$this->input->post("hp"),
                'alamat'=>$this->input->post("alamat"),
                'username'=>$usr,
                'password'=>md5($this->input->post("password")),
            );

            $this->Pelamar_model->insert($data);

            $sess_data['nik'] = $this->input->post("nik");
            $sess_data['username'] = $usr;
            $sess_data['password'] = md5($this->input->post("password"));
            $sess_data['nama'] = $this->input->post("nama");
            $sess_data['jenis_kelamin'] = $this->input->post("jk");
            $sess_data['id_posisi'] = $this->input->post("id_posisi");
            $sess_data['level'] = "User";
            $ref = "User";
            $this->load->model("Pekerjaan_model");
            $this->load->model("Pelamar_bahan_model");
            $this->load->model("Berkas_pekerjaan_model");
            $bk=array();
            $ujian = $this->Pekerjaan_model->get_by("id", $akun_data_pelamar->id_posisi);
            if (count($ujian)>=1) {
                $bk = $this->Berkas_pekerjaan_model->get_data_by("kode_bahan", $ujian->kode_bahan);
                $bp = $this->db->query("SELECT * FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$this->input->post("nik")."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$this->input->post("id_posisi")."' LIMIT 1 OFFSET 0))")->result();
                if (count($bp)==count($bk)) {
                    $sess_data['kode_ujian'] = $ujian->kode_ujian;
                }
            };
            $this->session->set_userdata($sess_data);
            redirect($ref);
        }
    }

    public function berita($id){
        $this->load->model("Pengumuman_model");
        $data = array(
            'berita'=>$this->Pengumuman_model->get_by_id($id),
            'content'=>'news_detail'
        );
        $this->load->view('container',$data);
    }

    public function help(){
        $data = array(
            'content'=>'help'
        );
        $this->load->view('container',$data);
    }

    public function contact(){
        $data = array(
            'content'=>'contact'
        );
        $this->load->view('container',$data);
    }

	public function login($u, $p){

        $this->load->model("Users_model");
        $this->load->model("Pelamar_model");
        $akun_data_admin = $this->Users_model->get_akun($u, $p);
        $akun_data_pelamar = $this->Pelamar_model->get_akun($u, $p);
        if ($akun_data_pelamar) {
            $sess_data['nik'] = $akun_data_pelamar->nik;
            $sess_data['username'] = $akun_data_pelamar->username;
            $sess_data['password'] = $p;
            $sess_data['nama'] = $akun_data_pelamar->nama;
            $sess_data['jenis_kelamin'] = $akun_data_pelamar->jenis_kelamin;
            $sess_data['id_posisi'] = $akun_data_pelamar->id_posisi;
            $sess_data['level'] = "User";
            $sess_data['kode_ujian'] = NULL;
            $this->load->model("Pekerjaan_model");
            $this->load->model("Pelamar_bahan_model");
            $this->load->model("Berkas_pekerjaan_model");
            $bk=array();
            $ujian = $this->Pekerjaan_model->get_by("id", $akun_data_pelamar->id_posisi);
            if ($ujian) {
                $bk = $this->Berkas_pekerjaan_model->get_data_by("kode_bahan", $ujian->kode_bahan);
                $bp = $this->db->query("SELECT * FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$akun_data_pelamar->nik."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$akun_data_pelamar->id_posisi."' LIMIT 1 OFFSET 0))")->result();
                if (count($bp)==count($bk)) {
                    $sess_data['kode_ujian'] = $ujian->kode_ujian;
                }
            };
        	$ref = "User";
        }elseif($akun_data_admin){
            $sess_data['nik'] = $akun_data_admin->nik;
            $sess_data['username'] = $akun_data_admin->username;
            $sess_data['password'] = $p;
            $sess_data['nama'] = $akun_data_admin->nama;
            $sess_data['jenis_kelamin'] = $akun_data_admin->jenis_kelamin;
            $sess_data['jabatan'] = $akun_data_admin->jabatan;
            $sess_data['level'] = "Admin";
        	$ref = "Admin";
        }else{
            $this->session->set_flashdata('loginfailed', 'Upss... Username atau password yang anda masukan salah !');
            $this->session->set_flashdata('messageattr', 'text-danger');
			redirect("Login");
        };
		$this->session->set_userdata($sess_data);
		redirect($ref);
	}

	public function login_action(){
        $u = $this->input->post("username");
        $p = $this->input->post("password");

        $this->load->model("Users_model");
        $this->load->model("Pelamar_model");
        $akun_data_admin = $this->Users_model->get_akun($u, $p);
        $akun_data_pelamar = $this->Pelamar_model->get_akun($u, $p);

        $res = array();
        $res["url"] = "Welcome/login/".$u."/".$p;
        if ($akun_data_pelamar != NULL) {
        	$res["text"] = "Anda berhasil login sebagai ".$akun_data_pelamar->nama;
        	$res["textattr"] = "text-success";
        	$res["state"] = "success";
        }elseif($akun_data_admin != NULL){
        	$res["text"] = "Anda berhasil login sebagai ".$akun_data_admin->nama;
        	$res["textattr"] = "text-primary";
        	$res["state"] = "success";
        }else{
        	$res["url"] = NULL;
        	$res["text"] = "Upss... Username atau password yang anda masukan salah !";
        	$res["textattr"] = "text-danger";
        	$res["state"] = "failed";
        };

    	header('Content-type: application/json');
    	echo json_encode($res);
	}

    public function logout(){
        $this->session->unset_userdata("nik");
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("password");
        $this->session->unset_userdata("nama");
        $this->session->unset_userdata("jenis_kelamin");
        $this->session->unset_userdata("jabatan");
        $this->session->unset_userdata("level");
        session_destroy();
        redirect("Home");
    }
}
