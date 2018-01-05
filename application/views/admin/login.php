<div class="login-box">
	<div class="login-logo">
		<a href="#"><img src="<?php echo base_url('skin/admin/images/Logo.png'); ?>"/></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg"><?php echo $global_message; ?></p>
		<form action="<?php echo $dashboardmodel->getLoginPostUrl(); ?>" method="post">
		<div class="form-group <?php echo ((form_error('username')!="")?"has-error":"has-feedback"); ?>">
			<label>User Name</label>
			<input type="text" class="form-control required-entry validate-email" name="username" id="username" placeholder="User Name">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
			<?php echo ((form_error('username')!="")?'<span class="text-danger">'.form_error('username').'</span>':''); ?>
		</div>
		<div class="form-group <?php echo ((form_error('username')!="")?"has-error":"has-feedback"); ?>">
			<label>Password</label>
			<input type="password" class="form-control required-entry" name="password" id="password" placeholder="Password">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<?php echo ((form_error('password')!="")?'<span class="text-danger">'.form_error('password').'</span>':''); ?>
		</div>
		<div class="form-group has-feedback">
			<label>Status Mode</label>
			<select class="form-control select2" name="status_mode" id="status_mode" style="width: 100%;">
				<option value="Online">Online</option>
				<option value="Offline">Offline</option>
				<option value="Be Right Back">Be Right Back</option>
				<option value="Away">Away</option>
            </select>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<a href="#">Reset Password</a>
			</div>
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>	
		</div>
		</form>
	</div>
</div>