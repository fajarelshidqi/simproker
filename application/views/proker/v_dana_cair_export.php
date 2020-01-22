<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
</head>
<body>
	<style type="text/css">
		table.tabel{
			border-collapse: collapse;
			font-size: 13px;
		}
		table th,td{
			border: 1px solid #000;
		}
	</style>
	<div class="container">
		<!-- <img src="assets/img/kop.jpg" alt="" style="position: center; width: 700px; height: auto;"><br> -->
		<div class="content-wrapper">
			<section class="content-header">
				<h4 align="center">DATA DANA, PROPOSAL & DANA CAIR PROGRAM KERJA</h4>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<h4>1. Dana Program Kerja</h4>	
						<table class="tabel" cellpadding="2" cellspacing="1" bgcolor="#ffffff" width="100%">			
							<thead>								
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center"> 
									<th>No</th>
									<th>Tahun Ajaran</th>
									<th width="370px">Program Kerja</th>
									<th>Dana Program Kerja (Rp.)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$jumlah = 0;
								$no = 1;
								foreach ($proker as $m) { ?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td style="text-align:center"><?php echo $m->tahun_ajaran; ?></td>
										<td><?php echo $m->nama_proker; ?></td>
										<td align="right">
											<?php if ($m->dana_proker == "") { 
												echo number_format(0,0,'','.'); 
											} else {
												echo number_format($m->dana_proker,0,'','.');
											}
											$jumlah += $m->dana_proker;
											?>					                      
										</td>
									<?php } ?>					                  				                  
								</tr>					              
								<tr>
									<td colspan="3" style="text-align:center; font-weight: bold;">Jumlah Program Kerja</td>
									<td style="font-weight: bold; text-align: right;"><?php echo number_format($jumlah,0,'','.'); ?></td>	
								</tr>
							</tbody>
						</table>
						<h4>2. Proposal Program Kerja</h4>	
						<table class="tabel" cellpadding="2" cellspacing="1" bgcolor="#ffffff" width="100%">			
							<thead>								
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center"> 
									<th rowspan="2">No</th>
									<th rowspan="2">Tahun Ajaran</th>
									<th rowspan="2">Program Kerja</th>
									<th colspan="4">Proposal</th>
								</tr>
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center">
									<th>No. Surat</th>
									<th>Tanggal</th>
									<th>Perihal</th>
									<th>Dana (Rp.)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$jumlah2 = 0;
								$no = 1;
								foreach ($prop as $p) { ?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td style="text-align:center"><?php echo $p->tahun_ajaran; ?>	</td>
										<td><?php echo $p->nama_proker?></td>
										<td><?php echo $p->no_surat_proposal; ?></td>
										<td><?php echo $p->tanggal_proposal; ?></td>
										<td><?php echo $p->perihal; ?></td>
										<td align="right">
											<?php if ($p->dana_proker == "") { 
												echo number_format(0,0,'','.'); 
											} else {
												echo number_format($p->dana_proposal,0,'','.');
											}
											$jumlah2 += $p->dana_proposal;
											?>					                      
										</td>
									<?php } ?>					                  				                  
								</tr>					              
								<tr>
									<td colspan="6" style="text-align:center; font-weight: bold;">Jumlah Dana Proposal</td>
									<td style="font-weight: bold;" align="right"><?php echo number_format($jumlah2,0,'','.'); ?></td>	
								</tr>
							</tbody>
						</table>
						<h4>3. Dana Cair</h4>	
						<table class="tabel" cellpadding="2" cellspacing="0" bgcolor="#ffffff" width="100%">			
							<thead>								
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center"> 
									<th>No</th>
									<th>Tahun Ajaran</th>
									<th>Program Kerja</th>
									<th>Tanggal</th>
									<th>No. Kwitansi</th>
									<th>Nota Dinas</th>
									<th>Keterangan</th>
									<th>Dana Cair (Rp.)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$jumlah3 = 0;
								$no = 1;
								foreach ($dana_cair as $d) { ?>
									<tr>
										<td style="text-align:center"><?php echo $no++; ?></td>
										<td style="text-align:center"><?php echo $d->tahun_ajaran; ?>	</td>
										<td><?php echo $d->nama_proker?></td>
										<td><?php echo $d->tanggal; ?></td>
										<td><?php echo $d->no_kwitansi; ?></td>
										<td><?php echo $d->nota_dinas; ?></td>
										<td><?php echo $d->keterangan; ?></td>
										<td align="right">
											<?php if ($d->dana_cair == "") { 
												echo number_format(0,0,'','.'); 
											} else {
												echo number_format($d->dana_cair,0,'','.');
											}
											$jumlah3 += $d->dana_cair;
											?>					                      
										</td>
									<?php } ?>					                  				                  
								</tr>					              
								<tr>
									<td colspan="7" style="text-align:center; font-weight: bold;">Jumlah Dana Cair</td>
									<td style="font-weight: bold;" align="right"><?php echo number_format($jumlah3,0,'','.'); ?></td>	
								</tr>
							</tbody>

						</table>
						<?php 
						$total = 0;
						$total1 = 0;
						$total2 = 0;
						$total = $jumlah - $jumlah2;
						$total1 = $jumlah2 - $jumlah3;
						$total2 = $jumlah - $jumlah3;
						?>
						<ul>
							<li>
								Dana yang belum diajukan :<br>
								<i text-align="left">(Jumlah Program Kerja - Jumlah Dana Proposal = Rp. ...)</i><br>
								<span>Rp. <?php echo number_format($jumlah,0,'','.'); ?> - Rp. <?php echo number_format($jumlah2,0,'','.'); ?> = <b>Rp. <?php echo number_format($total,0,'','.'); ?></b></span>
							</li>
						</ul>
						<ul>
							<li>
								Dana yang belum diturunkan atas Proposal : <br>
								<i text-align="left">(Jumlah Dana Proposal - Jumlah Dana Cair = Rp. ...)</i><br>
								<span>Rp. <?php echo number_format($jumlah2,0,'','.'); ?> - Rp. <?php echo number_format($jumlah3,0,'','.'); ?> = <b>Rp. <?php echo number_format($total1,0,'','.'); ?></b></span>
							</li>
						</ul>
						<ul>
							<li>
								Dana sisa atas Program Kerja : <br>
								<i text-align="left">(Jumlah Program Kerja - Jumlah Dana Cair = Rp. ...)</i><br>
								<span>Rp. <?php echo number_format($jumlah,0,'','.'); ?> - Rp. <?php echo number_format($jumlah3,0,'','.'); ?> = <b>Rp. <?php echo number_format($total2,0,'','.'); ?></b></span>
							</li>
						</ul>					
					</div>
				</div>
			</section><br><br><br>
			<div align="center">
				<?php 
				date_default_timezone_set('Asia/Jakarta');
				$date = Date("d/m/Y, h:i:s A");
				echo "Laporan dicetak pada tanggal $date"; 
				?>
			</div>
		</div>
	</div>
</body>
</html>