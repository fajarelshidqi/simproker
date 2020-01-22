<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
</head>
<body>
	<style type="text/css">
		table.tabel{
			border-collapse: collapse;
			font-size: 14px;
		}
		table th,td{
			border: 1px solid #000;
		}
	</style>
	<div class="container">
		<!-- <img src="assets/img/kop.jpg" alt="" style="position: center; width: 700px; height: auto;"><br> -->
		<div class="content-wrapper">
			<section class="content-header">
				<h3 align="center">DATA DANA & PROPOSAL PROGRAM KERJA</h3>
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
					              	<td colspan="3" style="text-align:center; font-weight: bold;">Jumlah</td>
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
					              	<td colspan="6" style="text-align:center; font-weight: bold;">Jumlah</td>
					              	<td style="font-weight: bold;" align="right"><?php echo number_format($jumlah2,0,'','.'); ?></td>	
					              </tr>
							</tbody>
						</table>
						<?php 
						$total = 0;
						$total = $jumlah - $jumlah2;
						?>
						<ul>
							<li>
								Dana yang belum diajukan :<br>
								<i text-align="left">(Jumlah Program Kerja - Jumlah Dana Proposal = Rp. ...)</i><br>
								<span>Rp. <?php echo number_format($jumlah,0,'','.'); ?> - Rp. <?php echo number_format($jumlah2,0,'','.'); ?> = <b>Rp. <?php echo number_format($total,0,'','.'); ?></b></span>
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