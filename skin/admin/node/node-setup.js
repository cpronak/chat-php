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
				$('#customer-list').append('<li class="node"><a id="customer-anchor" onclick="customerchatview('+data.customerdata[n].id+')" data-id='+data.customerdata[n].id+' href="javascript:void(0)"><div><span>'+data.customerdata[n].name+'</span><span style="float:right" data-toggle="tooltip" title="" class="badge bg-red" data-original-title="'+data.customerdata[n].unread_msg+' New Messages" >'+data.customerdata[n].unread_msg+'</span></div></a></li>');
			}
		}
	});
	chatpage.on('showcustomerlist',function(data){
		$('#customer-list').html('');
		if(data.customerdata){
			for(n in data.customerdata){
				$('#customer-list').append('<li class="node"><a id="customer-anchor" onclick="customerchatview('+data.customerdata[n].id+')" data-id='+data.customerdata[n].id+' href="javascript:void(0)"><div><span>'+data.customerdata[n].name+'</span><span style="float:right" data-toggle="tooltip" title="" class="badge bg-red" data-original-title="'+data.customerdata[n].unread_msg+' New Messages" >'+data.customerdata[n].unread_msg+'</span></div></a></li>');
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
					$('.direct-chat-messages').append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
				}
				else if(data.customermsg[n].align==2){
					$('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
				}
			}
		}
		else
		{
			$('#chat_block_list').append('');
		}
		
		footer='<div class="box-footer"><form action="#" method="post"><div class="input-group"><input type="text" name="message" placeholder="Type Message ..." class="form-control"><span class="input-group-btn"><button type="button" class="btn btn-warning btn-flat">Send</button></span></div></form></div>';
		$('#chat-container').append(footer);
		
		$('#cust-profile-view').append('<div class="box box-primary"><div class="box-body box-profile" id="profile-view"><img class="profile-user-img img-responsive img-circle" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="User profile picture"><h3 class="profile-username text-center">'+data.customerdata[0].name+'</h3><p class="text-muted text-center">'+data.customerdata[0].ipaddress+'</p><div class="text-center"><strong><i class="fa fa-envelope margin-r-5"></i> Email</strong><p class="text-muted">'+data.customerdata[0].email+'</p><strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong><p class="text-muted">'+data.customerdata[0].country+'</p><strong><i class="fa fa-globe margin-r-5"></i> Web Browser</strong><p class="text-muted">'+data.customerdata[0].useragent+'</p><strong><i class="fa fa-bookmark margin-r-5"></i> Referrer</strong><p class="text-muted">'+data.customerdata[0].referrer+'</p><strong><i class="fa fa-desktop margin-r-5"></i> Resolution</strong><p class="text-muted">'+data.customerdata[0].resolution+'</p><strong><i class="fa fa-globe margin-r-5"></i> Current Page</strong><p class="text-muted">'+data.customerdata[0].refresh+'</p><strong><i class="margin-r-5"></i> Chat Status</strong><p class="text-muted">'+status+'</p></div></div></div>');
		$.cookie('live_chat_user',data.customerdata[0].id);
	});
	chatpage.on('custinfo-same',function(data){
		if($.cookie('live_chat_user')==data.customerdata[0].id)
		{
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
						$('.direct-chat-messages').append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
					}
					else if(data.customermsg[n].align==2){
						$('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+data.customermsg[n].username+'</span><span class="direct-chat-timestamp pull-right">'+data.customermsg[n].datetime+'</span></div><img class="direct-chat-img" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="message user image"><div class="direct-chat-text">'+data.customermsg[n].message+'</div></div>');
					}
				}
			}
			else
			{
				$('#chat_block_list').append('');
			}
			
			footer='<div class="box-footer"><form action="#" method="post"><div class="input-group"><input type="text" name="message" placeholder="Type Message ..." class="form-control"><span class="input-group-btn"><button type="button" class="btn btn-warning btn-flat">Send</button></span></div></form></div>';
			$('#chat-container').append(footer);
			
			$('#cust-profile-view').append('<div class="box box-primary"><div class="box-body box-profile" id="profile-view"><img class="profile-user-img img-responsive img-circle" src="'+ROOT+'skin/admin/images/userPlaceholder.png" alt="User profile picture"><h3 class="profile-username text-center">'+data.customerdata[0].name+'</h3><p class="text-muted text-center">'+data.customerdata[0].ipaddress+'</p><div class="text-center"><strong><i class="fa fa-envelope margin-r-5"></i> Email</strong><p class="text-muted">'+data.customerdata[0].email+'</p><strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong><p class="text-muted">'+data.customerdata[0].country+'</p><strong><i class="fa fa-globe margin-r-5"></i> Web Browser</strong><p class="text-muted">'+data.customerdata[0].useragent+'</p><strong><i class="fa fa-bookmark margin-r-5"></i> Referrer</strong><p class="text-muted">'+data.customerdata[0].referrer+'</p><strong><i class="fa fa-desktop margin-r-5"></i> Resolution</strong><p class="text-muted">'+data.customerdata[0].resolution+'</p><strong><i class="fa fa-globe margin-r-5"></i> Current Page</strong><p class="text-muted">'+data.customerdata[0].refresh+'</p><strong><i class="margin-r-5"></i> Chat Status</strong><p class="text-muted">'+status+'</p></div></div></div>');
		}
	});
	function customerchatview(chatid){	
		if(chatid)
		{
			viewInfo(chatid);
		}
	}
	function viewInfo(chatid)	
	{
		chatpage.emit('custinfo', {chatid:chatid,admin_user_id:admin_user_id});
	}
}