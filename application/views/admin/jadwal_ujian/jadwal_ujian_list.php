        
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="admin/Jadwal_ujian/word" class="btn btn-md btn-warning">Export Jadwal</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <small><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></small>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Jadwal_ujian/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Jadwal_ujian'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Kode Soal</th>
                    <th>Judul</th>
                    <th class="text-center">Jadwal</th>
                    <th class="text-center">Soal</th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($jadwal_ujian_data as $jadwal_ujian)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td rowspan="" class="jabatan-row c-id-<?php echo $jadwal_ujian->id_pekerjaan ?>" data-holder="id-<?php echo $jadwal_ujian->id_pekerjaan ?>" style="vertical-align: middle;align-items: center;"><?php echo $jadwal_ujian->posisi_jabatan ?></td>
                    <td><?php echo $jadwal_ujian->kode_soal ?></td>
                    <td><?php echo $jadwal_ujian->judul ?></td>
                    <td class="text-center"><?php echo date("H:m",$jadwal_ujian->mulai)." s/d ".date("H:m",$jadwal_ujian->akhir) ?></td>
                    <td class="text-center"><?php echo $jadwal_ujian->total_soal ?></td>
                    <td style="text-align:center" width="200px">
                            <a href="<?php echo site_url('admin/Soal_ujian/word/'.$jadwal_ujian->kode_soal) ?>" title="Cetak Soal"><i class="fa fa-print text-primary"></i></a>&nbsp;
                            <a href="<?php echo site_url('admin/Soal_ujian/index/'.$jadwal_ujian->kode_soal) ?>" title="Ubah soal"><i class="fa fa-edit text-success"></i></a>&nbsp;
                            <a href="<?php echo site_url('admin/Jadwal_ujian/delete/'.$jadwal_ujian->id) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
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
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>