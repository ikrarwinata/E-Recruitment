<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Home",
                        'subtitle' => array("Home", "users"),
                        'bootstraps' => array(),
                        'scripts' => array(),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Users/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Users/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Users/index';
            $config['first_url'] = base_url() . 'admin/Users/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/users/users_list";
        $this->defaultPageAttribute['title'] = "Data Users";
        $data = array(
            'users_data' => $users,
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
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/users/users_read";
            $this->defaultPageAttribute['title'] = "Detail Users";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Users",
                                                        "Detail",
                                                        );
            $data = array(
                    'nik' => $row->nik,
                    'username' => $row->username,
                    'password' => $row->password,
                    'nama' => $row->nama,
                    'jenis_kelamin' => $row->jenis_kelamin,
                    'jabatan' => $row->jabatan,
                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Users'));
        }
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/users/users_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Users";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Home",
                                                    "Users",
                                                    "Tambah Data",
                                                    );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Users/create_action'),
	                'nik' => set_value('nik'),
	                'username' => set_value('username'),
	                'password' => set_value('password'),
	                'nama' => set_value('nama'),
	                'jenis_kelamin' => set_value('jenis_kelamin'),
	                'jabatan' => set_value('jabatan'),
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
                    'nik' => $this->input->post('nnik',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => md5($this->input->post('password',TRUE)),
                    'nama' => $this->input->post('nama',TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                    'jabatan' => $this->input->post('jabatan',TRUE),
                    );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/users/users_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Users";
            $this->defaultPageAttribute['subtitle'] = array(
                                                        "Home",
                                                        "Users",
                                                        "Ubah Data",
                                                        );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Users/update_action'),
                    'nik' => set_value('nik', $row->nik),
                    'username' => set_value('username', $row->username),
                    'password' => set_value('password'),
                    'nama' => set_value('nama', $row->nama),
                    'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                    'jabatan' => set_value('jabatan', $row->jabatan),
	                    'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nik', TRUE));
        } else {
            $data = array(
                    'nik' => $this->input->post('nnik',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => md5($this->input->post('password',TRUE)),
                    'nama' => $this->input->post('nama',TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                    'jabatan' => $this->input->post('jabatan',TRUE),
                    );

            $this->Users_model->update($this->input->post('nik', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Users'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Users'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('username', 'username', 'trim|required');
       $this->form_validation->set_rules('password', 'password', 'trim|required');
       $this->form_validation->set_rules('nama', 'nama', 'trim|required');
       $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
       $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
       $this->form_validation->set_rules('nik', 'nik', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users.xls";
        $judul = "users";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Username");
        xlsWriteLabel($tablehead, $kolomhead++, "Password");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        foreach ($this->Users_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users.doc");

        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/users/users_doc',$data);
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */