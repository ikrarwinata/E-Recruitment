       
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="admin/Users/create" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <small><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></small>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Users/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Users'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jabatan</th>
                    <th></th>
				</tr>
				</thead>
				<tbody>
                <?php
				foreach ($users_data as $users)
				{
				?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $users->nik ?></td>
                    <td><?php echo $users->nama ?></td>
                    <td><?php echo $users->jenis_kelamin ?></td>
                    <td><?php echo $users->jabatan ?></td>
                    <td style="text-align:center" width="200px">
                            <a href="<?php echo site_url('admin/Users/read/'.$users->nik) ?>" title="Lihat detail"><i class="fa fa-eye text-primary"></i>&nbsp;</a>
                            <a href="<?php echo site_url('admin/Users/update/'.$users->nik) ?>" title="Ubah"><i class="fa fa-edit text-success"></i>&nbsp;</a>
                            <a href="<?php echo site_url('admin/Users/delete/'.$users->nik) ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i>&nbsp;</a>
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
                <?php echo anchor(site_url('admin/Users/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('admin/Users/word'), 'Word', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>