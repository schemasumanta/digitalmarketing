<!DOCTYPE html>
<html><head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		@media print{
			.card{
				border: 0px solid; 
			}
			.card-header,.btn_detail{
				display: none;
			}
		}


	</style>

	<link href="<?php echo base_url()?>assets_landing/img/logo_bkk.svg" rel="icon">
	<link href="<?php echo base_url()?>assets_landing/img/logo_bkk.svg" rel="apple-touch-icon">
	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
	href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/select2.min.css">
	<script src="<?php echo base_url() ?>assets_landing/js/jquery.min.js"></script>
	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<style type="text/css">
		.select2-selection__rendered {
			line-height: 31px !important;
		}
		.select2-container .select2-selection--single {
			height: 40px !important;
		}
		.select2-selection__arrow {
			height: 34px !important;
		}

		input[type="file"]{
			opacity: 0 !important;
			padding: 0 !important;
			width: 100%!important;

		}
		.imagecheck-figure > img {
			width: 100%!important;
		}

	</style>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/leaflet.css">
</head><body>
</body>
</html>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-light" style="position: fixed;z-index: 99999; left: 25px;top:10px;cursor: pointer;border-radius: 50%;border: 1px solid #afb9b1"  id="konvert" onclick="exportTableToExcel('mytable')" >
							<i class="fas fa-file-excel fa-2x text-success"></i>  
						</div>  
						<div class="card-body">
							<table id="mytable" class="display table table-bordered"> 
								<thead>
									<tr style="border-bottom: 0px solid black;">
										<th colspan="7" style="border-bottom: 0px solid black;">
											<div class="row">
												<div class="col-lg-12" style="border: 0px solid black;text-align: center;font-weight: bold;">
													<h4><b><center>PT. BPR BKK KARANGMALANG (PERSERODA)</center></b></h4>
													<h4><b><center>LAPORAN KUNJUNGAN NASABAH</center></b></h4>

													<span style="text-align: right;">Periode</span><span>&nbsp;&nbsp;:&nbsp;<?php $tanggal=explode('-', $tanggal_awal);
													$bulan = array(
														'01' => 'Januari',
														'02' => 'Februari',
														'03' => 'Maret',
														'04' => 'April',
														'05' => 'Mei',
														'06' => 'Juni',
														'07' => 'Juli',
														'08' => 'Agustus',
														'09' => 'September',
														'10' => 'Oktober',
														'11' => 'November',
														'12' => 'Desember'
													);
													echo $tanggal[2]." ".$bulan[$tanggal[1]]." ".$tanggal[0]
													?></span><span style="text-align: right;">&nbsp;&nbsp;s/d&nbsp;&nbsp;</span><span>&nbsp;<?php $tgl=explode('-', $tanggal_akhir);

													echo $tgl[2]." ".$bulan[$tgl[1]]." ".$tgl[0]
													?></span>
													<br>
													<span style="text-align: right;">Marketing</span><span>&nbsp;&nbsp;:&nbsp;<?php echo  $marketing[0]->nama; ?></span>

												</div>
											</div>

										</th>
									</tr>
									<tr style="border-top:0px solid black;border-bottom: 0px solid black">
										<th colspan="7" style="border-top: 0px solid black;border-bottom: 0px solid black"></th>
									</tr>
									
									<tr style="border-top:0px solid black;border-bottom: 0px solid black">
										<th colspan="7" style="border-top: 0px solid black;border-bottom: 0px solid black"></th>
									</tr>
									<tr style="font-size: 12px;text-align: center;">
										<th width="2%">No</th>
										<th width="8%">Tanggal</th> 
										<?php if ($this->session->level=="Admin" || $this->session->level=="PIC") { ?>
											<th width="10%">Rekening</th>
										<?php } ?>
										
										<th width="10%">Nasabah</th> 
										<th width="10%">Plafon</th>
										<th width="10%">Tanggal Realisasi</th> 
										<th width="10%">Alamat</th> 
										<th width="20%">Hasil Kunjungan</th> 
										<th width="8%">Status</th>
										<th width="10%">Lampiran</th>
									</tr>
								</thead> 
								<tbody id="show_data" style="font-size: 10px;"> 
									<?php if (count($laporan) > 0): ?>
										
										<?php $no=1; foreach ($laporan as $key): ?>
										<tr>
											<td class="text-center"><?php echo $no++;  ?></td>
											<td class="text-center"><?php echo $key->tanggal_kunjungan;  ?></td>
											<?php if ($this->session->level=="Admin" || $this->session->level=="PIC") { ?>
												
												<td class="text-center"><?php echo $key->no_rekening;  ?></td>
											<?php } ?>
											<td ><?php echo $key->nama_nasabah;  ?></td>
											<td class="text-right"><?php echo number_format($key->plafon,0,',','.');  ?></td>
											<td class="text-center"><?php echo $key->tgl_realisasi;  ?></td>


											<td ><?php echo $key->alamat_nasabah;  ?></td>
											<td ><?php echo $key->hasil_kunjungan;  ?></td>
											<td class="text-center"><?php echo $key->status_fu;  ?></td>
											<td class="text-center">
												<?php if ($key->lampiran_kunjungan!='') { ?>
													<img src="<?php echo base_url().$key->lampiran_kunjungan ?>" width="200px">
												<?php } ?>
											</td>
										</tr>
									<?php endforeach ?>
									<?php else : ?>
										<tr>
											<td colspan ="9" class="text-center text-danger"><h4>Data Tidak Ditemukan</h4></td>
										<?php endif ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/leaflet.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

	<!-- Sweet Alert -->
	<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.masknumber.js"></script>
	<!-- Page level custom scripts -->
	<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script> -->
	<!-- <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/modules-datatables.js"></script>
	<script type="text/javascript">

		function exportTableToExcel(mytable, filename = 'Laporan KUNJUNGAN PER NASABAH <?php echo $jenis?> '+<?php echo date("Ymd"); ?>){

			$('.tombol').remove();
			var downloadLink;
			var dataType = 'application/vnd.ms-excel';
			var tableSelect = document.getElementById(mytable);
			var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
    	var blob = new Blob(['\ufeff', tableHTML], {
    		type: dataType
    	});
    	navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
function SeparatorRibuan(bilangan){
	let angka = bilangan.replace(/\./g,'');
	let sisa 	= angka.length % 3;
	awalan 	= angka.substr(0, sisa);
	ribuan 	= angka.substr(sisa).match(/\d{3}/g);
	if (ribuan) {
		separator = sisa ? '.' : '';
		hasil = awalan + separator + ribuan.join('.');
		return hasil;
	}
}
</script>















