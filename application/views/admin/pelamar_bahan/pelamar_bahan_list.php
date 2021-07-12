
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
                <form action="<?php echo site_url('admin/Pelamar_bahan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Pelamar_bahan'); ?>" class="btn btn-default">Reset</a>
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
                    <th>NIK</th>
                    <th>File</th>
                    <th></th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($pelamar_bahan_data as $pelamar_bahan)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $pelamar_bahan->nik ?></td>
                    <td><?php echo $pelamar_bahan->nama ?></td>
                    <td class="text-center">
                        <?php if ($pelamar_bahan->tipe=="Gambar"): ?>
                            <a href="<?php echo $pelamar_bahan->file_path ?>" target="_blank"><img src="<?php echo $pelamar_bahan->file_path ?>" style="max-width: 250px; max-height: 150px;"></a>
                        <?php else: ?>
                            <a href="<?php echo $pelamar_bahan->file_path ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-file"></i>&nbsp; Lihat file</a>
                        <?php endif ?>
                    </td>
                    <td style="text-align:center" width="200px">
                            <a href="<?php echo site_url('admin/Pelamar_bahan/delete/'.$pelamar_bahan->id) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i>&nbsp;</a>
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
                <?php echo anchor(site_url('admin/Pelamar_bahan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('admin/Pelamar_bahan/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>