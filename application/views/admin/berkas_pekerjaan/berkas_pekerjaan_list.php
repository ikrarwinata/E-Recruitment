
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
                <form action="<?php echo site_url('admin/Berkas_pekerjaan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Berkas_pekerjaan'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Berkas</th>
                    <th>Tipe File</th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($berkas_pekerjaan_data as $berkas_pekerjaan)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td rowspan="" class="jabatan-row c-id-<?php echo $berkas_pekerjaan->id_pekerjaan ?>" data-holder="id-<?php echo $berkas_pekerjaan->id_pekerjaan ?>" style="vertical-align: middle;align-items: center;"><?php echo $berkas_pekerjaan->posisi_jabatan ?></td>
                    <td><?php echo $berkas_pekerjaan->nama ?></td>
                    <td><?php echo $berkas_pekerjaan->tipe ?></td>
                    <td style="text-align:center" width="200px">                            
                            <a href="<?php echo site_url('admin/Berkas_pekerjaan/delete/'.$berkas_pekerjaan->id) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i>&nbsp;</a>
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
                <div class="well well-sm well-primary">Total Berkas : <?php echo $total_rows ?></div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>