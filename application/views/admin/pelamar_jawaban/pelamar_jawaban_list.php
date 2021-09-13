<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">

    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <small><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></small>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('admin/Pelamar_jawaban/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('admin/Pelamar_jawaban'); ?>" class="btn btn-default">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-primary" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table" style="width: 100%; border-collapse: collapse;table-layout: auto;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Kode Ujian</th>
                <th>Ujian</th>
                <th class="text-center">Nilai/Soal</th>
                <th class="text-center">Keterangan</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pelamar_jawaban_data as $pelamar_jawaban) {
            ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><a href="admin/Pelamar/read/<?php echo $pelamar_jawaban->nik ?>" title="<?php echo $pelamar_jawaban->nama ?>"><span class="badge badge-primary"><?php echo $pelamar_jawaban->nik ?></span></a></td>
                    <td><?php echo $pelamar_jawaban->kode_ujian ?></td>
                    <td><?php echo $pelamar_jawaban->judul_ujian ?></td>
                    <td class="text-center">
                        <?php if ($pelamar_jawaban->soal_terjawab == $pelamar_jawaban->total_soal && $pelamar_jawaban->total_soal >= 1) : ?>
                            <p class="text-success text-lg" title="Nilai Akhir"><strong><?php echo $pelamar_jawaban->score ?></strong></p>
                        <?php else : ?>
                            <span class="badge badge-default" title="Soal Terjawab"><?php echo $pelamar_jawaban->soal_terjawab ?></span> / <a href="admin/Jadwal_ujian/formasi/<?php echo $pelamar_jawaban->id_posisi ?>"><span class="badge badge-default" title="Total Soal"><?php echo $pelamar_jawaban->total_soal ?></span></a>
                        <?php endif ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if ($pelamar_jawaban->keterangan == "TIDAK LULUS") : ?>
                            <p class="text-danger text-sm" title="Nilai Akhir"><strong><?php echo $pelamar_jawaban->keterangan ?></strong></p>
                        <?php elseif ($pelamar_jawaban->keterangan == "LULUS") : ?>
                            <p class="text-success text-sm" title="Nilai Akhir"><strong><?php echo $pelamar_jawaban->keterangan ?></strong></p>
                        <?php else : ?>
                            <p class="text-seconaday text-sm" title="Nilai Akhir"><strong>BELUM DIMULAI</strong></p>
                        <?php endif ?>
                    </td>
                    <td style="text-align:center" width="100px">
                        <?php if ($pelamar_jawaban->soal_terjawab >= 1) : ?>
                            <a href="<?php echo site_url('admin/Pelamar_jawaban/read/' . $pelamar_jawaban->nik . '/' . $pelamar_jawaban->kode_soal) ?>" title="Lihat detail"><i class="fa fa-eye text-primary"></i>&nbsp;</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="well well-sm well-primary">Total Record : <?php echo $total_rows ?></div>
        <?php echo anchor(site_url('admin/Pelamar_jawaban/excel'), 'Excel', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>