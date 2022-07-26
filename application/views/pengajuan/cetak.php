<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style>
		* { font-family: DejaVu Sans, sans-serif; }
	</style>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
	<style type="text/css">
		.xlText {
			mso-number-format: "\@";
		}
		*{
			font-family: 'Times New Roman'	
		}
	</style> 

	<script src="<?php echo base_url() ?>assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url() ?>assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<?php $bulan = array(
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
	$hari = array(
		'Mon' => "Senin",
		'Tue' => "Selasa",
		'Wed' => "Rabu",
		'Thu' => "Kamis",
		'Fri' => "Jum'at",
		'Sat' => "Sabtu",
		'Sun' => "Minggu",
	); 

	?>
</head><body>

	<?php foreach ($cetak_pengajuan as $key ) {?>

		<div class="main-panel" style="width:100%;padding-left: 25px;padding-right: 25px;padding-top: 5px">
			<div style="margin-top: 10px">
				<h4 style="text-align: center;font-size: 18px;font-weight: bold;text-decoration: underline;">PERMOHONAN KREDIT</h4>
			</div>
			<div class="uraian" style="margin-top: 25px">
				<p style="text-align: justify;justify-content: center;font-size: 14px;line-height: 20px">Saya bertanda tangan dibawah ini menerangkan bahwa :</p>
			</div>
			<div class="isi">
				<br>
				<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">NIK</span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo $key->nik; ?></span>
				<br>

				<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">Nama</span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo $key->nama; ?></span>
				<br>
				<?php if ($key->nama_suami_istri!=''): ?>
					<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">Nama Suami / Istri</span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo $key->nama_suami_istri; ?></span>
					<br>
				<?php endif ?>

				<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">Nama Ibu Kandung</span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo $key->nama_ibu_kandung; ?></span>
				<br>
				<span style="font-size: 14px;margin-top:20px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top">Alamat</span><span style="font-size: 14px;margin-top:20px; display: inline-block;vertical-align: top">: </span><span style="font-size: 14px;margin-top:20px;display: inline-block;vertical-align: top;width: 460px;"><?php echo $key->alamat_rumah; ?></span>
				<br>

				<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">Nama Usaha / Pekerjaan </span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo $key->nama_usaha_pekerjaan; ?></span>
				<br>

				<span style="font-size: 14px;margin-top:10px;width: 150px;display: inline-block;margin-left: 25px;vertical-align: top;">Omset Usaha / Gaji </span><span style="font-size: 14px;margin-top:10px;display: inline-block;vertical-align: top;">: <?php echo number_format($key->omset_usaha,0,",","."); ?></span>
				<br>

			</div>

			<div class="uraian" style="margin-top: 35px;width: 90%">
				<p style="text-align: justify;justify-content: center;font-size: 14px;line-height: 20px;">Dengan ini mengajukan permohonan <?php echo $key->nama_produk; ?> Sebesar <b>Rp. <?php echo number_format($key->besar_plafon,0,",","."); ?></b>.</p>
			</div>

			<div class="uraian" style="margin-top: 55px">
				<p style="font-size: 14px;margin-left: 65%;"><?php echo $key->nama_cabang; ?>, <?php 
				$tanggal_surat = explode(" ", $key->tanggal_input);
				$tgl_surat = explode("-", $tanggal_surat[0]); echo $tgl_surat[2]." ".$bulan[$tgl_surat[1]]." ".$tgl_surat[0] ; ?></p>
				
			</div>


			<div class="uraian" style="margin-top: 55px">
				<?php if ($key->ttd!=''): ?>
					<img src="<?php echo $key->ttd ?>"style="margin-left: 65%;width:  150px">
				<?php endif ?>

				<p style="font-size: 14px;margin-left: 65%;"><b>( <?php echo $key->nama; ?> )</b></p>
				
			</div>
		</div>

	<?php } ?>
</body></html>















