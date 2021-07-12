<!doctype html>
<html>
    <head>
        <title>Document File</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
        </style>
    </head>
    <body>
        <h2>Pelamar_jawaban List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Kode Ujian</th>
                <th>Kode Soal</th>
                <th>Id Soal</th>
                <th>Jawaban</th>
                <th>Timestamps</th>
		
            </tr><?php
            foreach ($pelamar_jawaban_data as $pelamar_jawaban)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $pelamar_jawaban->nik ?></td>
                <td><?php echo $pelamar_jawaban->kode_ujian ?></td>
                <td><?php echo $pelamar_jawaban->kode_soal ?></td>
                <td><?php echo $pelamar_jawaban->id_soal ?></td>
                <td><?php echo $pelamar_jawaban->jawaban ?></td>
                <td><?php echo $pelamar_jawaban->timestamps ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>