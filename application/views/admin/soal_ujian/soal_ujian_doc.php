<!doctype html>
<html>
    <head>
        <title>Document File</title>
        <base href="<?php echo base_url() ?>">
        <style>
            .word-table {
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                padding: 3px 5px;
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
                <strong>Kode Soal : <?php echo $ujian->mulai ?></strong><br>
                <strong>Nama Ujian : <?php echo $ujian->judul ?></strong><br>
                <strong>
                    <?php 
                    $datetime1 = new DateTime(date("Y-m-d H:i:s", $ujian->mulai));//start time
                    $datetime2 = new DateTime(date("Y-m-d H:i:s", $ujian->akhir));//end time
                    $interval = $datetime1->diff($datetime2);
                     ?>
                    Waktu : <?php echo $interval->format("%H Jam, %i menit") ?>
            </div>
        </div>
        <hr>
        <table class="word-table" style="margin-bottom: 10px">
            <?php 
            $no = 0;
            foreach ($soal_ujian_data as $key => $soal_ujian): ?>
                <?php if ($soal_ujian->gambar!=NULL): ?>
                    <tr>
                        <th style="width: 50px"><?php echo ++$no; ?></th>
                        <td colspan="3">
                            <?php if ($soal_ujian->gambar!=NULL): ?>
                                <img src="<?php echo base_url($soal_ujian->gambar) ?>" style="max-width: 80%;max-height: 150px">
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td colspan="3"><?php echo $soal_ujian->soal ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <th style="width: 50px"><?php echo ++$no; ?></th>
                        <td colspan="3"><?php echo $soal_ujian->soal ?></td>
                    </tr>
                <?php endif ?>
                
                <tr>
                    <td></td>
                    <td>A. <?php echo $soal_ujian->a ?></td>
                    <td>C. <?php echo $soal_ujian->c ?></td>
                    <td>E. <?php echo $soal_ujian->e ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>B. <?php echo $soal_ujian->b ?></td>
                    <td colspan="2">D. <?php echo $soal_ujian->d ?></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>