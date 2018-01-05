<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<?php $this->load->view('admin/template/pages/2columns-left/head', array("style"=>$_styles,"script"=>$_scripts)); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php print $header; ?>
		<?php print $left; ?>
		<?php print $customer; ?>
 		<div class="content-wrapper">
			<?php print $content; ?>
		</div>
	</div>
</body>
</html>
