        
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
                
            </div>
        </div>
        <div class="table-responsive">
			<table class="table" style="width: 100%; border-collapse: collapse;table-layout: auto;">
				<thead>
				<tr>
					<th>No</th>
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
                    <td><?php echo $jadwal_ujian->kode_soal ?></td>
                    <td><?php echo $jadwal_ujian->judul ?></td>
                    <td class="text-center"><?php echo date("d M Y H:m",$jadwal_ujian->mulai)." s/d ".date("d M Y H:m",$jadwal_ujian->akhir) ?></td>
                    <td class="text-center"><?php echo $jadwal_ujian->total_soal ?></td>
                    <td style="text-align:center" width="100px">
                        <?php 
                        $totalTerjawab = $this->db->query("SELECT COUNT(a.id) AS total FROM pelamar_jawaban a WHERE id_soal IN (SELECT soal_ujian.id FROM soal_ujian WHERE soal_ujian.kode_soal='".$jadwal_ujian->kode_soal."') AND a.nik='".$this->session->userdata("nik")."'")->row()->total;
                         ?>
                         <?php if ($totalTerjawab == $jadwal_ujian->total_soal && $jadwal_ujian->total_soal >= 1): ?>
                             <a href="pelamar/Ujian/result/<?php echo $jadwal_ujian->kode_soal ?>" title="Lihat Score Saya" onclick="return openwindow(this)"><i class="fa fa-check text-success"></i></a>
                         <?php else: ?>
                            <?php if ($jadwal_ujian->mulai >= strtotime("now") && $jadwal_ujian->mulai <= (strtotime("now") + 1800)): ?>
                                <a href="<?php echo site_url('pelamar/Ujian/prep/'.$jadwal_ujian->id) ?>" title="Mulai Ujian" onclick="return confirm('Menuju Halaman Ujian ?')"><i class="fa fa-info text-warning"></i>&nbsp;</a>
                            <?php elseif($jadwal_ujian->mulai <= strtotime("now") && $jadwal_ujian->akhir >= strtotime("now")): ?>
                                <a href="<?php echo site_url('pelamar/Ujian/prep/'.$jadwal_ujian->id) ?>" title="Mulai Ujian" onclick="return confirm('Menuju Halaman Ujian ?')"><i class="fa fa-info text-warning"></i>&nbsp;</a>
                            <?php endif ?>
                         <?php endif ?>
                    </td>
                </tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>