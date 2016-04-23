<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Input Data</title>
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/select2.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/select2.css');?>" rel="stylesheet">
</head>
<body>

<div class="container">
	<div class="page-header" style="margin-top: 50px;">
		<blockquote>
			<a href="<?php echo base_url('welcome/maps');?>" class="btn btn-primary">Tampilkan Peta</a>
		</blockquote>
	</div>
	<?php
		if($this->session->flashdata('message')) {
			echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>".$this->session->flashdata('message')."
				</div>";
		}
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-body\">";
					echo form_open('',array('class'=>'form-horizontal'));
					echo "<fieldset>
								<legend>Silahkan lengkapi form berikut</legend>
								<div class=\"form-group\">";
										echo form_label('Nama','nama',array('class'=>'col-lg-2 control-label'));
										echo "<div class=\"col-lg-10\">";
											echo form_input(array('name'=>'nama','id'=>'nama','value'=>set_value('nama',$nama),'class'=>'form-control'));
											echo form_error('nama','<div style="color: #ff0000;">','</div>');
										echo "</div>
									</div>
								<div class=\"form-group\">";
									echo form_label('Wilayah','wilayah',array('class'=>'col-lg-2 control-label'));
									echo "<div class=\"col-lg-10\">
												<select class=\"form-control select2\" id=\"wilayah\" name=\"wilayah\" style=\"height: 100px;\"></select>";
												echo form_error('wilayah','<div style="color: #ff0000;">','</div>');
								echo "</div>
						</div>
						<div class=\"form-group\">
							<div class=\"col-lg-10 col-lg-offset-2\">
								<button type=\"submit\" class=\"btn btn-primary\">Simpan</button>
								<button type=\"reset\" class=\"btn btn-danger\">Cancel</button>
							</div>
						</div>
					</form>
				</div>
			</div>";
	?>
</div>
<script>var top_url = '<?php echo base_url();?>'; </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/select2.full.min.js');?>"></script>
<script type="text/javascript">
	$('#wilayah').select2({
		placeholder: "Wilayah tempat tinggal Alumni...",
		minimumInputLength: 1,
		ajax: {
			url: top_url+'welcome/ajax',
			type: "POST",
			dataType: 'json',
			delay: 20,
			data: function (cari) {
				return {
					cari: cari.term,
					page: 10
				};
			},
			processResults: function (data) {
				return {
					results: $.map(data, function(obj) {
						return {
							id: obj.id_desa,
							text: 'Desa '+obj.desa+', Kabupaten '+obj.kab+', Kecamatan '+obj.kec+', Propinsi '+obj.prop
							//text: obj.desa
						};
					})
				};
			},
			cache: true
		}
	});
</script>
</body>
</html>