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
        <h2>Pengumuman List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Id Pekerjaan</th>
                <th>Judul</th>
                <th>Banner</th>
                <th>Deskripsi</th>
                <th>Timestamps</th>
		
            </tr><?php
            foreach ($pengumuman_data as $pengumuman)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $pengumuman->id_pekerjaan ?></td>
                <td><?php echo $pengumuman->judul ?></td>
                <td><?php echo $pengumuman->banner ?></td>
                <td><?php echo $pengumuman->deskripsi ?></td>
                <td><?php echo $pengumuman->timestamps ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>