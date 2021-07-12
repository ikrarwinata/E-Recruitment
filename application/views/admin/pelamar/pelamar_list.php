
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
                <form action="<?php echo site_url('admin/Pelamar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Pelamar'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Formasi</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>Hp</th>
                    <th class="text-center">Berkas</th>
                    <th class="text-center">Ujian</th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($pelamar_data as $pelamar)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $pelamar->posisi_jabatan ?></td>
                    <td><?php echo $pelamar->nama ?></td>
                    <td><?php echo $pelamar->jenis_kelamin ?></td>
                    <td><?php echo $pelamar->email ?></td>
                    <td><?php echo $pelamar->hp ?></td>
                    <td class="text-center">
                    <?php if ($pelamar->berkas == $pelamar->total_berkas && $pelamar->total_berkas >= 1): ?>
                        <a href="admin/Pelamar_bahan/pelamar/<?php echo $pelamar->nik.'/'.$pelamar->id_posisi ?>" title="Terpenuhi"><i class="fa fa-check-circle fa-lg text success"></i></a>
                    <?php else: ?>
                        <a href="admin/Pelamar_bahan/pelamar/<?php echo $pelamar->nik.'/'.$pelamar->id_posisi ?>"><span class="badge badge-warning" title="Berkas di upload" style="cursor: pointer;"><?php echo $pelamar->berkas ?></span></a> / <a href="admin/Berkas_pekerjaan/formasi/<?php echo $pelamar->id_posisi ?>"><span class="badge badge-primary" title="Total berkas persyaratan" style="cursor: pointer;"><?php echo $pelamar->total_berkas ?></span></a>
                    <?php endif ?>
                    </td>
                    <td class="text-center">
                    <?php if ($pelamar->soal_terjawab == $pelamar->total_soal && $pelamar->total_soal >= 1): ?>
                        <a href="admin/Pelamar_jawaban/pelamar/<?php echo $pelamar->nik ?>" title="Nilai Rata-Rata" class="text-success"><strong><?php echo $pelamar->score ?></strong></a>
                    <?php else: ?>
                        <a href="admin/Pelamar_jawaban/pelamar/<?php echo $pelamar->nik ?>"><span class="badge badge-warning" title="Soal Terjawab"><?php echo $pelamar->soal_terjawab ?></span></a> / <a href="admin/Jadwal_ujian/formasi/<?php echo $pelamar->id_posisi ?>"><span class="badge badge-primary" title="Total Soal"><?php echo $pelamar->total_soal ?></span></a>
                    <?php endif ?>
                    </td>
                    <td style="text-align:center" width="150px">
                            <a href="<?php echo site_url('admin/Pelamar/read/'.$pelamar->nik) ?>" title="Lihat detail"><i class="fa fa-eye fa-lg text-primary"></i>&nbsp;</a>
                            <a href="<?php echo site_url('admin/Pelamar/delete/'.$pelamar->nik) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash fa-lg text-danger"></i>&nbsp;</a>
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
                <div class="well well-sm well-primary">Total Pelamar : <?php echo $total_rows ?></div>
                <?php echo anchor(site_url('admin/Pelamar/excel'), 'Export Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('admin/Pelamar/word'), 'Export Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>