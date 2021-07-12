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
        <h2>Pengumuman_pekerjaan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Id Pengumuman</th>
                <th>Judul</th>
                <th>Banner</th>
                <th>Deskripsi</th>
                <th>Timestamps</th>
                <th>Id</th>
                <th>Posisi Jabatan</th>
                <th>Pendaftaran Mulai</th>
                <th>Pendaftaran Akhir</th>
                <th>Kode Bahan</th>
                <th>Kuota</th>
                <th>Kode Ujian</th>
		
            </tr><?php
            foreach ($pengumuman_pekerjaan_data as $pengumuman_pekerjaan)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $pengumuman_pekerjaan->id_pengumuman ?></td>
                <td><?php echo $pengumuman_pekerjaan->judul ?></td>
                <td><?php echo $pengumuman_pekerjaan->banner ?></td>
                <td><?php echo $pengumuman_pekerjaan->deskripsi ?></td>
                <td><?php echo $pengumuman_pekerjaan->timestamps ?></td>
                <td><?php echo $pengumuman_pekerjaan->id ?></td>
                <td><?php echo $pengumuman_pekerjaan->posisi_jabatan ?></td>
                <td><?php echo $pengumuman_pekerjaan->pendaftaran_mulai ?></td>
                <td><?php echo $pengumuman_pekerjaan->pendaftaran_akhir ?></td>
                <td><?php echo $pengumuman_pekerjaan->kode_bahan ?></td>
                <td><?php echo $pengumuman_pekerjaan->kuota ?></td>
                <td><?php echo $pengumuman_pekerjaan->kode_ujian ?></td>	
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>