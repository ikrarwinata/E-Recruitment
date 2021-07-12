<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    private $container = "admin/container";
    private $defaultPageAttribute = array(
                        'title' => "Dashboard",
                        'subtitle' => array("Berita"),
                        'bootstraps' => array(),
                        'scripts' => array("assets/js/admin-pengumuman.js"),
                        'content' => "admin/",
                        );

    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('Pengumuman_model');
        $this->load->library('form_validation');
    }

    public function ajaxRequest_tampilkan(){
        $id = $this->input->post("id");
        $set = $this->input->post("value");

        $data = array(
            'timestamps'=>strtotime("now"),
            'tampilkan'=>$set
        );
        $this->Pengumuman_model->update($id, $data);
        echo "success";
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/Pengumuman/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/Pengumuman/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/Pengumuman/index';
            $config['first_url'] = base_url() . 'admin/Pengumuman/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengumuman_model->total_rows($q);
        $pengumuman = $this->Pengumuman_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->defaultPageAttribute['content'] = "admin/pengumuman/pengumuman_list";
        $this->defaultPageAttribute['title'] = "Data Pengumuman";
        $data = array(
            'pengumuman_data' => $pengumuman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'PageAttribute' => $this->defaultPageAttribute
        );
        $this->load->view($this->container, $data);
    }

    public function create() 
    {
        $this->defaultPageAttribute['content'] = "admin/pengumuman/pengumuman_form";
        $this->defaultPageAttribute['title'] = "Tambah Data Pengumuman";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Pengumuman",
                                                    "Tambah Data",
                                                    );
        $this->defaultPageAttribute['scripts'] = array(
                                                    "assets/ckeditor4/ckeditor.js",
                                                    "assets/js/admin-form-pengumuman.js"
                                                );
        $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pengumuman/create_action'),
	                'id' => set_value('id'),
	                'judul' => set_value('judul'),
                    'banner' => set_value('banner'),
	                'file_lampiran' => set_value('file_lampiran'),
	                'deskripsi' => set_value('deskripsi'),
	                'timestamps' => set_value('timestamps'),
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
            $config['upload_path']          = './files/gambar';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2008;
            $config['max_width']            = 13660;
            $config['max_height']           = 7680;
            $this->load->library('upload', $config);
            
            $data = array(
                'judul' => $this->input->post('judul',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'timestamps' => strtotime("now"),
                );
            
            if($this->upload->do_upload('banner')){
                $udata = $this->upload->data();
                $foto = $config['upload_path']."/"."banner".strtotime(date("d-m-Y H:i:s")).$udata["file_ext"];
                rename($udata["full_path"], $foto);
                $data['banner'] = $foto;
            }

            $config['upload_path']          = './files/lampiran';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp|pdf|doc|docx|xls|xlsx|rar|zip';
            $config['max_size']             = 2008;
            $config['max_width']            = 13660;
            $config['max_height']           = 7680;
            $this->upload->initialize($config);
            if($this->upload->do_upload('file_lampiran')){
                $udata = $this->upload->data();
                $foto = $config['upload_path']."/"."file_lampiran".strtotime(date("d-m-Y H:i:s")).$udata["file_ext"];
                rename($udata["full_path"], $foto);
                $data['file_lampiran'] = $foto;
            }

            $this->Pengumuman_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data');
            redirect(site_url('admin/Pengumuman'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            $this->defaultPageAttribute['content'] = "admin/pengumuman/pengumuman_form";
            $this->defaultPageAttribute['title'] = "Ubah Data Pengumuman";
        $this->defaultPageAttribute['subtitle'] = array(
                                                    "Pengumuman",
                                                    "Ubah Data",
                                                    );
        $this->defaultPageAttribute['scripts'] = array(
                                                    "assets/ckeditor4/ckeditor.js",
                                                    "assets/js/admin-form-pengumuman.js"
                                                );
            $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('admin/Pengumuman/update_action'),
                    'id' => set_value('id', $row->id),
                    'judul' => set_value('judul', $row->judul),
                    'banner' => set_value('banner', $row->banner),
                    'file_lampiran' => set_value('file_lampiran', $row->file_lampiran),
                    'deskripsi' => set_value('deskripsi', $row->deskripsi),
                    'timestamps' => set_value('timestamps', $row->timestamps),
	                'PageAttribute' => $this->defaultPageAttribute
                    );
            $this->load->view($this->container, $data);
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pengumuman'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $config['upload_path']          = './files/gambar';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2008;
            $config['max_width']            = 13660;
            $config['max_height']           = 7680;
            $this->load->library('upload', $config);

            $data = array(
                'judul' => $this->input->post('judul',TRUE),
                'deskripsi' => $this->input->post('deskripsi',TRUE),
                'timestamps' => strtotime("now"),
                );
            if($this->upload->do_upload('banner')){
                $udata = $this->upload->data();
                $foto = $config['upload_path']."/"."banner".strtotime(date("d-m-Y H:i:s")).$udata["file_ext"];
                rename($udata["full_path"], $foto);
                $data['banner'] = $foto;
            }

            $config['upload_path']          = './files/lampiran';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp|pdf|doc|docx|xls|xlsx|rar|zip';
            $config['max_size']             = 2008;
            $config['max_width']            = 13660;
            $config['max_height']           = 7680;
            $this->upload->initialize($config);
            if($this->upload->do_upload('file_lampiran')){
                $udata = $this->upload->data();
                $foto = $config['upload_path']."/"."file_lampiran".strtotime(date("d-m-Y H:i:s")).$udata["file_ext"];
                rename($udata["full_path"], $foto);
                $data['file_lampiran'] = $foto;
            }

            $this->Pengumuman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data berhasil diperbarui');
            redirect(site_url('admin/Pengumuman'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            if (isset($row->banner)) {
                if ($row->banner!=NULL) {
                    if (file_exists($row->banner)) {
                        unlink($row->banner);
                    }
                }
            }
            if (isset($row->file_lampiran)) {
                if ($row->file_lampiran!=NULL) {
                    if (file_exists($row->file_lampiran)) {
                        unlink($row->file_lampiran);
                    }
                }
            }

            $this->Pengumuman_model->delete($id);
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect(site_url('admin/Pengumuman'));
        } else {
            $this->session->set_flashdata('message', 'Upsss, data yang anda cari tidak ditemukan...');
            redirect(site_url('admin/Pengumuman'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('judul', 'judul', 'trim|required');
       $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
       $this->form_validation->set_rules('id', 'id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengumuman.xls";
        $judul = "pengumuman";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Pekerjaan");
        xlsWriteLabel($tablehead, $kolomhead++, "Judul");
        xlsWriteLabel($tablehead, $kolomhead++, "Banner");
        xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
        xlsWriteLabel($tablehead, $kolomhead++, "Timestamps");
        foreach ($this->Pengumuman_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pekerjaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteLabel($tablebody, $kolombody++, $data->banner);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->timestamps);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pengumuman.doc");

        $data = array(
            'pengumuman_data' => $this->Pengumuman_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/pengumuman/pengumuman_doc',$data);
    }

}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/Pengumuman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */