<div class="container">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h4>Anda akan melakasanakan ujian <?php echo $ujian_data->judul ?></h4>
            <?php 
            $datetime1 = new DateTime(date("Y-m-d H:i:s", $ujian_data->mulai));//start time
            $datetime2 = new DateTime(date("Y-m-d H:i:s", $ujian_data->akhir));//end time
            $interval = $datetime1->diff($datetime2);
             ?>
             <br>
            <h5>Total waktu : <?php echo $interval->format("%H Jam, %i menit") ?>
            </h5>
            <br>
            <h6>Dimulai : <?php echo date("d M Y H:i", $ujian_data->mulai) ?></h6>
            <br>
            <h6>Berakhir : <?php echo date("d M Y H:i", $ujian_data->akhir) ?></h6>
            <br>
            <h6><strong><?php echo $ujian_data->total_soal ?> Soal</strong></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center card">
            <div class="card card-primary card-outline">
              <div class="card-body text-center">
                    <strong>Pilihan Ganda</strong>
                    <br>
                    <p>Klik jawaban yang paling benar untuk menjawab</p>
                    <p class="text-danger">Sistem kami akan merekam kegiatan anda selama ujian, tindakan curang seperti alat bantu dan mesin pencari akan dinyatakan gagal.</p>
                    <?php $m = $ujian_data->mulai - strtotime(date("d-m-Y H:i:s"));$class = NULL; ?>
                    <?php if ($ujian_data->mulai >= strtotime("now") && $ujian_data->mulai <= (strtotime("now") + 1800)): ?>
                        <?php $class = "d-none"; ?>
                        <span class="text-warning" id="prep-countdown"><i id="timer-countdown-m"><?php echo date("i", $m) ?></i> Menit, <i id="timer-countdown-s"><?php echo date("s", $m) ?></i> detik</span>
                    <?php endif ?>
                    <a href="User" class="btn btn-lg btn-warning <?php echo $class ?>" id="prep-ready" onclick="return openURL()">Mulai Ujian</a>
              </div>
            </div><!-- /.card -->
        </div>
    </div>
</div>