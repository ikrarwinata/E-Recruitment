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
        <h2>Berkas_pekerjaan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Kode Bahan</th>
                <th>Nama</th>
                <th>Tipe</th>
		
            </tr><?php
            foreach ($berkas_pekerjaan_data as $berkas_pekerjaan)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $berkas_pekerjaan->kode_bahan ?></td>
                <td><?php echo $berkas_pekerjaan->nama ?></td>
                <td><?php echo $berkas_pekerjaan->tipe ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>