<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<style type="text/css">
		table.tabel{
			border-collapse: collapse;
			font-size: 14px;
		}
		table th,td.tabel{
			border: 1px solid #000;
		}
	</style>
	<?php date_default_timezone_set('Asia/Jakarta'); ?>
	<div class="container">
		<!-- <img src="assets/img/kop.jpg" alt="" style="position: center; width: 700px; height: auto;"><br> -->
		<div class="content-wrapper">
			<section class="content-header">
				<span style="font-size: 12px;">YAYASAN KERIS SAMUDERA KORPS MARINIR<br>AKADEMI KEBIDANAN KERIS HUSADA JAKARTA</span>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<h4 align="center">HONOR MENGAJAR DOSEN DALAM AKBID <?php echo $honordd->nama_kelas; ?> <br> BULAN <?php echo strtoupper($honordd->bulanpertama); ?> <br> DIBAYARKAN BULAN <?php echo strtoupper($honordd->bulankedua); ?></h4>	
						<table class="tabel" cellpadding="4" cellspacing="2" bgcolor="#ffffff" width="100%">			
							<thead>								
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center"> 
									<th rowspan="2">No</th>
									<th rowspan="2">Mata Kuliah</th>
									<th rowspan="2">Nama Dosen</th>
									<th rowspan="2">Pertemuan</th>
									<th rowspan="2">Jam</th>
									<th rowspan="2">Honor <br>(Rp.)</th>
									<th rowspan="2">Total Penerimaan <br> (Rp.)</th>
									<th colspan="2">Tanda Terima</th>
								</tr>
								<tr bgcolor="#99CCFF" style="color:#000000; text-align:center">
									<th>Tgl / Nama</th>
									<th>Tanda Tangan</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; $jumlah=0; $totalsks=0; $totaljumlah=0;
								foreach ($honordd2 as $k) { $jumlah = $k->honor_dosendalam * $k->jam; ?>
									<tr>
										<td class="tabel" style="text-align:center"><?php echo $no++;?></td>
										<td class="tabel"><?php echo $k->nama_mk;?></td>
										<td class="tabel"><?php echo $k->nama_dosendalam;?></td>
										<td class="tabel" style="text-align:center"><?php echo $k->pertemuan;?></td>
										<td class="tabel" style="text-align:center"><?php echo $k->jam;?></td>
										<td class="tabel" style="text-align:right"><?php echo number_format($k->honor_dosendalam,0,'','.');?></td>
										<td class="tabel" style="text-align:right">
											<?php echo number_format($jumlah,0,'','.');?>
										</td>
										<td class="tabel"></td>
										<td class="tabel"></td>
									</tr>						
										<?php $totaljumlah += $jumlah; ?>							
								<?php } ?>
								<tr>
									<td class="tabel" colspan="6" style="text-align:center"><b>Jumlah</b></td>
									<td class="tabel" style="text-align:right"><b>Rp. <?php echo number_format($totaljumlah,0,'','.'); ?></b></td>
									<td class="tabel"></td>
									<td class="tabel"></td>
								</tr>
							</tbody>
						</table>
						<br>
						<table border="0" width="100%" style="font-size: 13px">							
							<tbody style="text-align:center">
								<tr>
									<td></td>
									<td>Mengetahui</td>
									<td>Jakarta, <?php echo Date('d F Y');?></td>
								</tr>
								<tr>
									<td>
										Akademi Kebidanan Keris Husada <br>
										Direktur <br><br><br><br>
										Yuni Purwatiningsih, SST, M.Kes
									</td>
									<td>
										Yayasan Keris Samudera Korp Marinir <br>
										Wakil Ketua Yayasan<br><br><br><br>
										drg. Yuyun W. Kosim, MARS
									</td>
									<td>
										Akademi Kebidanan Keris Husada <br>
										Sekertaris Akademik <br><br><br><br>
										Miyatun, SST, M.Kes
									</td>
								</tr>
								<tr>
									<td></td>
									<td> <br><br>
										Yayasan Keris Samudera Korp Marinir <br>
										Ketua Yayasan <br><br><br><br>
										Purwo Siswoko, S.H
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section><br><br>
			<div align="center" style="font-size: 13px">
				<?php
				$jam 	= Date("H:i:s");
				$date 	= Date("d-m-Y");
				echo "Laporan dicetak pada tanggal $date - Jam $jam"; 
				?>
			</div>
		</div>
	</div>
</body>
</html>