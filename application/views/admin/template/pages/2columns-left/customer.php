<aside class="customer-sidebar">
	<section class="sidebar">
		<ul class="customer-menu" data-widget="tree">
			<li class="active treeview menu-open">
				<a href="">
					<div>Customer</div>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" id="customer-list" style="height:calc(100vh - 105px); overflow:auto">
					<li>
						<a href="">
							<div>Ronak</div>
						</a>
					</li>
				</ul>
			</li>
		</ul>
    </section>
</aside>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>
var admin_user_id='<?php echo $this->session->userdata('userid'); ?>';
if(typeof io=="undefined")
{
	alert('node server not working');
}
else
{
	var socket = io.connect('http://localhost:3000');
	var chatpage=socket.of('/chatpage')
		.on('connect_failed', function (reason) {
			alert('custom connect failed');
			console.error('unable to connect chatpage to namespace', reason);
		})
		.on('error',function(reason){
			alert('customer error');
			console.error('unable to connect chatpage to namespace', reason);
		})
		.on('reconnect_failed',function(){
			alert("customer reconnect_failed");
		})
		.on('connect', function () {
			chatpage.emit('customerlist',{admin_user_id:admin_user_id});
		});
	chatpage.on('customerlist',function(data){
		$('#customer-list').html('');
		if(data.customerdata){
			for(n in data.customerdata){
				$('#customer-list').append('<li class="node"><a id="customer-anchor" data-id='+data.customerdata[n].id+' href="javascript:void(0)"><div><span>'+data.customerdata[n].name+'</span><span style="float:right" data-toggle="tooltip" title="" class="badge bg-red" data-original-title="'+data.customerdata[n].unread_msg+' New Messages" >'+data.customerdata[n].unread_msg+'</span></div></a></li>');
			}
		}
	});
	chatpage.on('showcustomerlist',function(data){
		$('#customer-list').html('');
		if(data.customerdata){
			for(n in data.customerdata){
				$('#customer-list').append('<li class="node"><a id="customer-anchor" data-id='+data.customerdata[n].id+' href="javascript:void(0)"><div><span>'+data.customerdata[n].name+'</span><span style="float:right" data-toggle="tooltip" title="" class="badge bg-red" data-original-title="'+data.customerdata[n].unread_msg+' New Messages" >'+data.customerdata[n].unread_msg+'</span></div></a></li>');
			}
		}
	});
	chatpage.on('custinfo',function(data){
		$("#cust-profile-view").html('');
		$("#chat-windows").html('');
		
		var container='<div class="box box-primary direct-chat direct-chat-warning" id="chat-container"></div>';
		
		$('#chat-windows').append(container);
		var header='';
		var content='';
		var footer='';
		var unread='';
		if(data.unreadmsg[0].unread_count > 0)
		{
			unread='<span data-toggle="tooltip" title="" class="badge bg-red" data-original-title="'+data.unreadmsg[0].unread_count+' New Messages">'+data.unreadmsg[0].unread_count+'</span>';
		}
		header='<div class="box-header with-border"><h3 class="box-title">Live Chat - '+data.customerdata[0].name+'</h3><div class="box-tools pull-right">'+unread+'</div></div>';
		$('#chat-container').append(header);
		
		content='<div class="box-body"><div class="direct-chat-messages"></div></div>';
		$('#chat-container').append(content);
		
		if(data.customermsg)
		{
			for(n in data.customermsg)
			{
				if(data.customermsg[n].align==1){
					$('.direct-chat-messages').append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="<?php echo base_url('skin/admin/images/userPlaceholder.png'); ?>" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
				}
				else if(data.customermsg[n].align==2){
					$('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="<?php echo base_url('skin/admin/images/userPlaceholder.png'); ?>" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
				}
			}
		}
		else
		{
			$('#chat_block_list').append('');
		}
		
		footer='<div class="box-footer"><form action="#" method="post"><div class="input-group"><input type="text" name="message" placeholder="Type Message ..." class="form-control"><span class="input-group-btn"><button type="button" class="btn btn-warning btn-flat">Send</button></span></div></form></div>';
		$('#chat-container').append(footer);
		
		$('#cust-profile-view').append('<div class="box box-primary"><div class="box-body box-profile" id="profile-view"><img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('skin/admin/images/userPlaceholder.png'); ?>" alt="User profile picture"><h3 class="profile-username text-center">'+data.customerdata[0].name+'</h3><p class="text-muted text-center">'+data.customerdata[0].ipaddress+'</p><div class="text-center"><strong><i class="fa fa-envelope margin-r-5"></i> Email</strong><p class="text-muted">'+data.customerdata[0].email+'</p><strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong><p class="text-muted">'+data.customerdata[0].country+'</p><strong><i class="fa fa-globe margin-r-5"></i> Web Browser</strong><p class="text-muted">'+data.customerdata[0].useragent+'</p><strong><i class="fa fa-bookmark margin-r-5"></i> Referrer</strong><p class="text-muted">'+data.customerdata[0].referrer+'</p><strong><i class="fa fa-desktop margin-r-5"></i> Resolution</strong><p class="text-muted">'+data.customerdata[0].resolution+'</p><strong><i class="fa fa-globe margin-r-5"></i> Current Page</strong><p class="text-muted">'+data.customerdata[0].refresh+'</p><strong><i class="margin-r-5"></i> Chat Status</strong><p class="text-muted">'+status+'</p></div></div></div>');
	});
	$('body').on("click",'#customer-anchor', function(e) {	
		var chatid = this.getAttribute("data-id");
		if(chatid)
		{
			viewInfo(chatid);
		}
		function viewInfo(chatid)	
		{
			chatpage.emit('custinfo', {chatid:chatid,admin_user_id:admin_user_id});
		}
	});	
}
</script>

<style>
.text-Be Right Back{
	color: red;
}
.scrollbar {
    float: left;
    height: calc(100vh - 120px);
    width: 100%;
    overflow-y: scroll;
}
.force-overflow {
    min-height: 450px;
}

.scrollbar-primary::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-primary::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #4285F4; }

.scrollbar-danger::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-danger::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-danger::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #ff3547; }

.scrollbar-warning::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-warning::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-warning::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #FF8800; }

.scrollbar-success::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-success::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-success::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #00C851; }

.scrollbar-info::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-info::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-info::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #33b5e5; }

.scrollbar-default::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-default::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-default::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #2BBBAD; }

.scrollbar-secondary::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #F5F5F5;
  border-radius: 10px; }

.scrollbar-secondary::-webkit-scrollbar {
  width: 12px;
  background-color: #F5F5F5; }

.scrollbar-secondary::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  background-color: #aa66cc; }
.skin-blue .customer-sidebar{
	background-color: #222d32;
}
.customer-menu {
  list-style: none;
  margin: 0;
  padding: 0;
}
.customer-menu > li {
  position: relative;
  margin: 0;
  padding: 0;
}
.customer-menu > li > a {
  padding: 12px 5px 12px 15px;
  display: block;
}
.customer-menu > li > a > .fa,
.customer-menu > li > a > .glyphicon,
.customer-menu > li > a > .ion {
  width: 20px;
}
.customer-menu > li .label,
.customer-menu > li .badge {
  margin-right: 5px;
}
.customer-menu > li .badge {
  margin-top: 3px;
}
.customer-menu li.header {
  padding: 10px 25px 10px 15px;
  font-size: 12px;
}
.customer-menu li > a > .fa-angle-left,
.customer-menu li > a > .pull-right-container > .fa-angle-left {
  width: auto;
  height: auto;
  padding: 0;
  margin-right: 10px;
  -webkit-transition: transform 0.5s ease;
  -o-transition: transform 0.5s ease;
  transition: transform 0.5s ease;
}
.customer-menu li > a > .fa-angle-left {
  position: absolute;
  top: 50%;
  right: 10px;
  margin-top: -8px;
}
.customer-menu .menu-open > a > .fa-angle-left,
.customer-menu .menu-open > a > .pull-right-container > .fa-angle-left {
  -webkit-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
.customer-menu .active > .treeview-menu {
  display: block;
}
@media (min-width: 768px){
	.sidebar-mini.sidebar-collapse .customer-sidebar {
		-webkit-transform: translate(0, 0);
		-ms-transform: translate(0, 0);
		-o-transform: translate(0, 0);
		transform: translate(0, 0);
		left: 50px !important;
		z-index: 850;
	}
	.sidebar-collapse .customer-sidebar {
		-webkit-transform: translate(-460px, 0);
		-ms-transform: translate(-460px, 0);
		-o-transform: translate(-460px, 0);
		transform: translate(-460px, 0);
	}
}
@media (min-width: 768px) {
  .sidebar-mini.sidebar-collapse .content-wrapper,
  .sidebar-mini.sidebar-collapse .right-side,
  .sidebar-mini.sidebar-collapse .main-footer {
    margin-left: 280px !important;
    z-index: 840;
  }
  
  .sidebar-mini.sidebar-collapse .customer-sidebar > li {
    position: relative;
  }
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > a {
    margin-right: 0;
  }
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > a > span {
    border-top-right-radius: 4px;
  }
  .sidebar-mini.sidebar-collapse .customer-sidebar > li:not(.treeview) > a > span {
    border-bottom-right-radius: 4px;
  }
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > .treeview-menu {
    padding-top: 5px;
    padding-bottom: 5px;
    border-bottom-right-radius: 4px;
  }
  .sidebar-mini.sidebar-collapse .customer-sidebar .user-panel > .info,
  .sidebar-mini.sidebar-collapse .sidebar-form,
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > a > span,
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > .treeview-menu,
  .sidebar-mini.sidebar-collapse .customer-sidebar > li > a > .pull-right,
  .sidebar-mini.sidebar-collapse .customer-sidebar li.header {
    display: none !important;
    -webkit-transform: translateZ(0);
  }
  .sidebar-mini.sidebar-collapse .main-header .logo {
    width: 50px;
  }
  .sidebar-mini.sidebar-collapse .main-header .logo > .logo-mini {
    display: block;
    margin-left: -15px;
    margin-right: -15px;
    font-size: 18px;
  }
  .sidebar-mini.sidebar-collapse .main-header .logo > .logo-lg {
    display: none;
  }
  .sidebar-mini.sidebar-collapse .main-header .navbar {
    margin-left: 50px;
  }
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > a > span:not(.pull-right),
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > .treeview-menu {
  display: block !important;
  position: absolute;
  width: 180px;
  left: 50px;
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > a > span {
  top: 0;
  margin-left: -3px;
  padding: 12px 5px 12px 20px;
  background-color: inherit;
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > a > .pull-right-container {
  position: relative !important;
  float: right;
  width: auto !important;
  left: 180px !important;
  top: -22px !important;
  z-index: 900;
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > a > .pull-right-container > .label:not(:first-of-type) {
  display: none;
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .customer-sidebar > li:hover > .treeview-menu {
  top: 44px;
  margin-left: 0;
}
.sidebar-expanded-on-hover .main-footer,
.sidebar-expanded-on-hover .content-wrapper {
  margin-left: 50px;
}
.sidebar-expanded-on-hover .customer-sidebar {
  box-shadow: 3px 0 8px rgba(0, 0, 0, 0.125);
}
.customer-sidebar,
.customer-sidebar .user-panel,
.customer-sidebar > li.header {
  white-space: nowrap;
  overflow: hidden;
}
.customer-sidebar:hover {
  overflow: visible;
}
.sidebar-form,
.customer-sidebar > li.header {
  overflow: hidden;
  text-overflow: clip;
}
.customer-sidebar li > a {
  position: relative;
}
.customer-sidebar li > a > .pull-right-container {
  position: absolute;
  right: 10px;
  top: 50%;
  margin-top: -7px;
}
.customer-sidebar {
  position: absolute;
  top: 0;
  left: 0;
  padding-top: 50px;
  min-height: 100%;
  width: 230px;
  left: 230px;
  z-index: 810;
  -webkit-transition: -webkit-transform 0.3s ease-in-out, width 0.3s ease-in-out;
  -moz-transition: -moz-transform 0.3s ease-in-out, width 0.3s ease-in-out;
  -o-transition: -o-transform 0.3s ease-in-out, width 0.3s ease-in-out;
  transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
}
@media (max-width: 767px) {
  .customer-sidebar {
    padding-top: 100px;
  }
}
@media (max-width: 767px) {
  .customer-sidebar {
    -webkit-transform: translate(-230px, 0);
    -ms-transform: translate(-230px, 0);
    -o-transform: translate(-230px, 0);
    transform: translate(-230px, 0);
  }
}
@media (min-width: 768px) {
  .sidebar-collapse .customer-sidebar {
    -webkit-transform: translate(-230px, 0);
    -ms-transform: translate(-230px, 0);
    -o-transform: translate(-230px, 0);
    transform: translate(-230px, 0);
  }
}
@media (max-width: 767px) {
  .sidebar-open .customer-sidebar {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 0);
  }
}
.skin-blue .customer-sidebar > li > a {
  border-left: 3px solid transparent;
}
.skin-blue .customer-sidebar > li:hover > a,
.skin-blue .customer-sidebar > li.active > a,
.skin-blue .customer-sidebar > li.menu-open > a {
  color: #ffffff;
  background: #1e282c;
}
.skin-blue .customer-sidebar > li.active > a {
  border-left-color: #3c8dbc;
}
.skin-blue .customer-sidebar > li > .treeview-menu {
  margin: 0 1px;
  background: #2c3b41;
}
.skin-blue .sidebar a {
  color: #b8c7ce;
}
.skin-blue .sidebar a:hover {
  text-decoration: none;
}
.skin-blue .customer-sidebar .treeview-menu > li > a {
  color: #8aa4af;
}
.skin-blue .customer-sidebar .treeview-menu > li.active > a,
.skin-blue .customer-sidebar .treeview-menu > li > a:hover {
  color: #ffffff;
}
</style>