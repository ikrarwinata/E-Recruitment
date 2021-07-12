<!doctype html>
<html>
    <head>
        <title>Jadwal Ujian Doc</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
            td{
                font-size: 10px
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>PT. Karunia Adi Sentosa Jambi</h2>
            </div>
            <hr>
            <div class="col-lg-12">
                <h5>Jadwal Ujian Tahun Pembukaan <?php echo date("Y") ?></h5>
            </div>
            <div class="col-lg-12">
                <span class="float-right" style="font-size: 8px"><?php echo date("d M Y") ?></span>
            </div>
        </div>
        <hr>
        <table class="word-table" style="margin-bottom: 10px;max-width: 601px">
            <tr>
                <th style="width: 30px">No</th>
                <th>Formasi</th>
                <th>Ujian</th>
                <th colspan="2">Jadwal</th>
                <th>Jumlah Soal</th>
		
            </tr><?php
            foreach ($jadwal_ujian_data as $jadwal_ujian)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $jadwal_ujian->posisi_jabatan ?></td>
                <td><?php echo $jadwal_ujian->judul ?></td>
                <td class="text-center"><?php echo date("d M Y",$jadwal_ujian->mulai) ?></td>
                <td class="text-center"><?php echo date("H:m",$jadwal_ujian->mulai)." s/d ".date("H:m",$jadwal_ujian->akhir) ?></td>
                <td class="text-center" style="width: 80px"><?php echo $jadwal_ujian->total_soal ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>