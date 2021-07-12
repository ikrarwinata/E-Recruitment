
        <table class="table">
			<tr><td>NIK</td><td><?php echo $nik; ?></td></tr>
			<tr><td>Formasi</td><td><?php echo $formasi; ?></td></tr>
			<tr><td>Nama Lengkap</td><td><?php echo $nama; ?></td></tr>
			<tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
			<tr><td>Status</td><td><?php echo $status; ?></td></tr>
			<tr><td>Pekerjaan</td><td><?php echo $pekerjaan; ?></td></tr>
			<tr><td>Tinggi Badan</td><td><?php echo $tinggi_badan; ?></td></tr>
			<tr><td>Berat Badan</td><td><?php echo $berat_badan; ?></td></tr>
			<tr><td>Email</td><td><?php echo $email; ?></td></tr>
			<tr><td>Hp</td><td><?php echo $hp; ?></td></tr>
			<tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
			<tr><td>Username</td><td><?php echo $username; ?></td></tr>
			<tr><td>Password</td><td><?php echo $password; ?></td></tr>
			<tr><td><a href="admin/Pelamar_bahan/pelamar/<?php echo $nik.'/'.$id_posisi ?>" class="btn btn-warning">Lihat Berkas</a></td><td><button type="button" class="btn btn-default" onclick="window.history.go(-1)">Batalkan</button></td></tr>
		</table>