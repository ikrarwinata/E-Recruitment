        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="admin/Pengumuman_pekerjaan/create" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <small><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></small>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Pengumuman_pekerjaan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Pengumuman_pekerjaan'); ?>" class="btn btn-default">Reset</a>
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
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($pengumuman_pekerjaan_data as $pengumuman_pekerjaan)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
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
                    <td style="text-align:center" width="200px">
                            <a href="<?php echo site_url('admin/Pengumuman_pekerjaan/read/'.$pengumuman_pekerjaan->) ?>" title="Lihat detail"><i class="fa fa-eye text-primary"></i>&nbsp;</a>
                            <a href="<?php echo site_url('admin/Pengumuman_pekerjaan/update/'.$pengumuman_pekerjaan->) ?>" title="Ubah"><i class="fa fa-edit text-success"></i>&nbsp;</a>
                            <a href="<?php echo site_url('admin/Pengumuman_pekerjaan/delete/'.$pengumuman_pekerjaan->) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i>&nbsp;</a>
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
                <?php echo anchor(site_url('admin/Pengumuman_pekerjaan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('admin/Pengumuman_pekerjaan/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>