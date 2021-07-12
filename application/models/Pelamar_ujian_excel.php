<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'phpspreadsheet'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pelamar_ujian_excel extends CI_Model
{

    public $table = 'pelamar_jawaban';
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
    public $LeftBorder = array(
                'borders' => array(
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                )
            );
    public $RightBorder = array(
                'borders' => array(
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border right dengan garis tipis
                )
            );
    public $Separator = array(
                'alignment' => array(
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
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
        ->setTitle('Hasil Ujian')
        ->setSubject('Hasil Ujian')
        ->setDescription('Hasil Ujian '.date("d M Y"))
        ->setKeywords('Hasil Ujian')
        ->setCategory('Hasil Ujian');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Data Hasil Ujian Peserta '.date("d M Y"));
        $spreadsheet->getActiveSheet()->mergeCells('A3:E3');

        $startRowHeader = 6;
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$startRowHeader, 'No')
        ->setCellValue('B'.$startRowHeader, 'NIK')
        ->setCellValue('C'.$startRowHeader, 'Nama Peserta')
        ->setCellValue('D'.$startRowHeader, 'Kode Ujian')
        ->setCellValue('E'.$startRowHeader, 'Kode Soal')
        ->setCellValue('F'.$startRowHeader, 'Ujian')
        ->setCellValue('G'.$startRowHeader, 'Nilai')
        ->setCellValue('G'.($startRowHeader+1), 'Jumlah Soal')
        ->setCellValue('H'.($startRowHeader+1), 'Terjawab')
        ->setCellValue('I'.($startRowHeader+1), 'Jawaban Benar')
        ->setCellValue('J'.($startRowHeader+1), 'Score')
        ;
        $spreadsheet->getActiveSheet()->mergeCells('A'.$startRowHeader.':A'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('B'.$startRowHeader.':B'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('C'.$startRowHeader.':C'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('D'.$startRowHeader.':D'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('E'.$startRowHeader.':E'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('F'.$startRowHeader.':F'.($startRowHeader+1));
        $spreadsheet->getActiveSheet()->mergeCells('G6:J6');

        $spreadsheet->getActiveSheet()->getStyle('A'.$startRowHeader.':A'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('B'.$startRowHeader.':B'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('C'.$startRowHeader.':C'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('D'.$startRowHeader.':D'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('E'.$startRowHeader.':E'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('F'.$startRowHeader.':F'.($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle('G'.$startRowHeader.':J'.($startRowHeader))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("G".($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("H".($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("I".($startRowHeader+1))->applyFromArray($this->Header_Style);
        $spreadsheet->getActiveSheet()->getStyle("J".($startRowHeader+1))->applyFromArray($this->Header_Style);

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

        $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'PT. Karunia Adi Sentosa Jambi');
        $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($this->Header_Style);

        $startRowBody = $startRowHeader+2;
        $index = 0;
        
        $lastNIK = NULL;
        $pelamar_jawaban = $this->db->order_by("nik", "ASC")->get("pelamar_jadwal_overview")->result();
        foreach ($pelamar_jawaban as $key => $jadwal) {
            $total_soal = $this->db->query("SELECT COUNT(soal_ujian.id) AS total FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            $soal_terjawab = $this->db->query("SELECT COUNT(pelamar_jawaban.id) AS total FROM pelamar_jawaban WHERE pelamar_jawaban.nik='".$jadwal->nik."' AND pelamar_jawaban.id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal = '".$jadwal->kode_soal."')")->row()->total;
            $jawaban_benar = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a LEFT OUTER JOIN soal_ujian b ON a.id_soal = b.id WHERE a.jawaban=b.jawaban AND a.nik = '".$jadwal->nik."' AND b.kode_soal = '".$jadwal->kode_soal."'")->row()->total;
            if ($jawaban_benar >= 1 && $total_soal >= 1) {
                $jadwal->score = round(($jawaban_benar / $total_soal) * 100, 0);
            }else{
                $jadwal->score = 0;
            }

            $spreadsheet->getActiveSheet()->getStyle('A'.$startRowBody)->applyFromArray($this->LeftBorder);
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$startRowBody, ++$index)
            ->setCellValueExplicit('B'.$startRowBody, $jadwal->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)
            ->setCellValue('C'.$startRowBody, $jadwal->nama)
            ->setCellValue('D'.$startRowBody, $jadwal->kode_ujian)
            ->setCellValue('E'.$startRowBody, $jadwal->kode_soal)
            ->setCellValue('F'.$startRowBody, $jadwal->judul_ujian)
            ->setCellValue('G'.$startRowBody, $total_soal)
            ->setCellValue('H'.$startRowBody, $soal_terjawab)
            ->setCellValue('I'.$startRowBody, $jawaban_benar)
            ->setCellValue('J'.$startRowBody, $jadwal->score)
            ;
            $spreadsheet->getActiveSheet()->getStyle('J'.$startRowBody)->applyFromArray($this->RightBorder);

            if ($jadwal->nik!==$lastNIK) {
                $spreadsheet->getActiveSheet()->getStyle('A'.$startRowBody.':J'.$startRowBody)->applyFromArray($this->Separator);
            }
            $lastNIK=$jadwal->nik;
            $startRowBody++;
        };
        $spreadsheet->getActiveSheet()->getStyle('A'.$startRowBody.':J'.$startRowBody)->applyFromArray($this->Separator);

        $spreadsheet->getActiveSheet()->setTitle('Ujian Peserta '.date('Y'));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="hasil_ujian_peserta'.date("dmy").'.xlsx"');
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