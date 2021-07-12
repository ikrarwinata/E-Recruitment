<!doctype html>
<html>
    <head>
        <title>Pelamar Data Doc</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 2px 5px;
            }
            td{
                font-size: 10px;
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
                <h5>Data Pelamar</h5>
            </div>
            <div class="col-lg-12">
                <span class="float-right" style="font-size: 8px"><?php echo date("d M Y") ?></span>
            </div>
        </div>
        <hr>
        <table class="word-table" style="margin-bottom: 10px; max-width: 600px">
            <tr>
                <th>No</th>
                <th>Formasi</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Email</th>
                <th>Hp</th>
                <th>Berkas</th>
                <th>Ujian</th>
            </tr><?php
            foreach ($pelamar_data as $pelamar)
            {
            ?>
            <tr>
                <td style="width: 30px"><?php echo ++$start ?></td>
                <td><?php echo $pelamar->posisi_jabatan ?></td>
                <td><?php echo $pelamar->nama ?></td>
                <td><?php echo $pelamar->jenis_kelamin.", ".$pelamar->status ?></td>
                <td><?php echo $pelamar->email ?></td>
                <td><?php echo $pelamar->hp ?></td>
                <td class="text-center" style="width: 50px">
                <?php if ($pelamar->berkas == $pelamar->total_berkas && $pelamar->total_berkas >= 1): ?>
                    Y
                <?php else: ?>
                    T
                <?php endif ?>
                </td>
                <td class="text-center" style="width: 50px">
                    <strong style="width: 50px"><?php echo $pelamar->score ?></strong>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>