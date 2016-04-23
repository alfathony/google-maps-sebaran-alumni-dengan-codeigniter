<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Peta Sebaran Alumni</title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<?php echo $map['js']; ?>
</head>
<body>

<div class="container">
	<div class="page-header" style="margin-top: 50px;">
		<blockquote>
			<a href="<?php echo base_url('welcome');?>" class="btn btn-primary">Input Data</a>
		</blockquote>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<legend>Peta Sebaran Alumni</legend>
			<?php echo $map['html']; ?>
		</div>
	</div>
</div>

</body>
</html>