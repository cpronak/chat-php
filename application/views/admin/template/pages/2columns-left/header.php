<header class="main-header">
    <a href="<?php echo base_url('admin'); ?>" class="logo">
		<span class="logo-mini"><img src="<?php echo base_url('skin/admin/images/Logo_50x50.png'); ?>"/></span>
		<span class="logo-lg"><b>Live</b> Help</span>
	</a>
	<nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url('skin/admin/images/userPlaceholder.png'); ?>" class="user-image" alt="User Image">
					<span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
				</a>
				<ul class="dropdown-menu">
				<li class="user-header">
					<img src="<?php echo base_url('skin/admin/images/userPlaceholder.png'); ?>" class="img-circle" alt="User Image">
					<p><?php echo $this->session->userdata('name'); ?><small><?php echo $this->session->userdata('status_mode'); ?></small></p>
				</li>
			  <li class="user-body">
				<div class="row">
					<?php $status_array = array('Online','Offline','Be Right Back','Away'); ?>
					<?php 
						if (($key = array_search($this->session->userdata('status_mode'), $status_array)) !== false) {
							unset($status_array[$key]);
						}
						foreach($status_array as $value){
						?>
							<div class="col-xs-4 text-center">
								<a href="<?php echo $dashboardmodel->getStatusChange($value); ?>"><?php echo $value; ?></a>
							</div>
						<?php 
						} 
					?>
				</div>
				<!-- /.row -->
			  </li>
			  <!-- Menu Footer-->
			  <li class="user-footer">
				<div class="pull-left">
				  <a href="#" class="btn btn-default btn-flat">Profile</a>
				</div>
				<div class="pull-right">
				  <a href="<?php echo $dashboardmodel->getLogoutUrl(); ?>" class="btn btn-default btn-flat">Sign out</a>
				</div>
			  </li>
			</ul>
		  </li>
        </ul>
      </div>

    </nav>
  </header>