<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Live Help | Log in</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url('skin/admin/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('skin/admin/css/font-awesome/font-awesome.min.css'); ?>">

<?php /* <link rel="stylesheet" href="<?php echo base_url('skin/admin/css/ionicons.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('skin/admin/css/jquery-jvectormap.css'); ?>"> */ ?>
<link rel="stylesheet" href="<?php echo base_url('skin/admin/css/_all-skins.min.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('skin/admin/css/AdminLTE.css'); ?>">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="<?php echo base_url('skin/admin/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('skin/admin/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('skin/admin/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('skin/admin/js/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('skin/admin/js/adminlte.min.js'); ?>"></script>
<script>var ROOT = '<?php echo base_url(); ?>'</script>
<script>var admin_user_id='<?php echo $this->session->userdata('userid'); ?>'</script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="<?php echo base_url('skin/admin/node/node-setup.js'); ?>"></script>

<?php
if($style!="")
	echo $style;
	
if($script!="")
	echo $script;
?>