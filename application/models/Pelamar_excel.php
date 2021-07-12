<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'phpspreadsheet'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pelamar_excel extends CI_Model
{

    public $table = 'pelamar';
    public $id = 'nik';
    public $order = 'DESC';
    public $Header_Style = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                )
            );
    public $Default_Style = array(
                'alignment' => array(
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                )
            );

    function __construct()
    {
        parent::__construct();
    }

    public function export(){
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('Shouts')
        ->setLastModifiedBy('Shouts')
        ->setTitle('Data Pelamar')
        ->setSubject('Data Pelamar')
        ->setDescription('Data Pelamar Tahun '.date("Y"))
        ->setKeywords('Pelamar')
        ->setCategory('Pelamar');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Data Peserta Pelamar '.date("M Y"));
        $spreadsheet->getActiveSheet()->mergeCells('A3:E3');

        $startRowHeader = 5;
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$startRowHeader, 'No')
        ->setCellValue('B'.$startRowHeader, 'Formasi')
        ->setCellValue('C'.$startRowHeader, 'Nama Peserta')
        ->setCellValue('D'.$startRowHeader, 'Jenis Kelamin')
        ->setCellValue('E'.$startRowHeader, 'Status')
        ->setCellValue('F'.$startRowHeader, 'Pekerjaan')
        ->setCellValue('G'.$startRowHeader, 'Tinggi, Berat Badan')
        ->setCellValue('H'.$startRowHeader, 'Email')
        ->setCellValue('I'.$startRowHeader, 'Telepon')
        ->setCellValue('J'.$startRowHeader, 'Berkas')
        ->setCellValue('K'.$startRowHeader, 'Nilai Akhir')
        ;

        $spreadsheet->getActiveSheet()->getStyle("A".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("B".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("C".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("D".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("E".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("F".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("G".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("H".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("I".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("J".$startRowHeader)->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("K".$startRowHeader)->applyFromArray($this->Header_Style);

        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);

        $spreadsheet->getActiveSheet()->mergeCells('A1:K1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'PT. Karunia Adi Sentosa Jambi');
        $spreadsheet->getActiveSheet()->getStyle('A1:K1')->applyFromArray($this->Header_Style);

        $startRowBody = $startRowHeader+1;
        $index = 0;
        $pelamar = $this->db->query("SELECT * FROM pelamar_overview ORDER BY id_posisi DESC")->result();
        foreach ($pelamar as $key => $value) {
            $total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian IN (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."'))")->row()->total;
            $soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$value->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal IN (SELECT a.kode_soal FROM jadwal_ujian a WHERE a.kode_ujian = (SELECT pekerjaan.kode_ujian FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)))")->row()->total;
            $total_berkas = $this->db->query("SELECT COUNT(a.id) AS total FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0)")->row()->total;
            $berkas = $this->db->query("SELECT COUNT(pelamar_bahan.id) AS total FROM pelamar_bahan WHERE pelamar_bahan.nik = '".$value->nik."' AND pelamar_bahan.id_berkas IN (SELECT a.id FROM berkas_pekerjaan a WHERE a.kode_bahan = (SELECT pekerjaan.kode_bahan FROM pekerjaan WHERE pekerjaan.id = '".$value->id_posisi."' LIMIT 1 OFFSET 0))")->row()->total;
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
            if ($berkas == $total_berkas && $total_berkas >= 1) {
                $value->berkas = "Y";
            }else{
                $value->berkas = "T";
            }
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$startRowBody, ++$index)
            ->setCellValue('B'.$startRowBody, $value->posisi_jabatan)
            ->setCellValue('C'.$startRowBody, $value->nama)
            ->setCellValue('D'.$startRowBody, $value->jenis_kelamin)
            ->setCellValue('E'.$startRowBody, $value->status)
            ->setCellValue('F'.$startRowBody, $value->pekerjaan)
            ->setCellValue('G'.$startRowBody, $value->tinggi_badan." Cm, ".$value->berat_badan." Kg")
            ->setCellValue('H'.$startRowBody, $value->email)
            ->setCellValue('I'.$startRowBody, $value->hp)
            ->setCellValue('J'.$startRowBody, $value->berkas)
            ->setCellValue('K'.$startRowBody, $value->score)
            ;
            $startRowBody++;
        };
        $spreadsheet->getActiveSheet()->setTitle('Data Pelamar '.date('d-m-Y H'));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="pelamar '.date("Y").'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}

/* End of file Pelamar_model.php */
/* Location: ./application/models/Pelamar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-14 06:43:01 */
/* http://harviacode.com */