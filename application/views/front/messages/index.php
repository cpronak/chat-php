<div class="error-feeds alert alert-danger" style="display:none;margin: 0px;">Sorry seems like we are having some problems displaying the chat!!!</div>
<div class="panel panel-default" id="chat-window" style="display:none;">
<h1>Chat</h1>
<div id="messages">
	<?php foreach ($messages as $message): ?>
		<div class="message msg-id-<?php print $message['id']; ?>">
			<div class="created">[<?php print $message['datetime']; ?>]</div>
			<div class="author"><?php print $message['username']; ?></div>
			<div class="text"><?php print $message['message']; ?></div>
		</div>
	<?php endforeach; ?>
</div>

<?php echo validation_errors(); ?>
<?php echo form_open('messages/create', array('id' => 'new-message-form')) ?>
	<input type="input" name="msg" class="form-text"/>
	<input type="submit" name="submit" value="Send" class="form-submit"/>
<?php echo form_close(); ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>
var user_id='<?php echo $this->input->cookie('chat-userid'); ?>';
if(typeof io=="undefined")
{
	$('#chat-window').hide();
	$('.error-feeds').show();
}
else
{
	var socket = io.connect('http://localhost:3000');
	var chatpage=socket.of('/chatpage')
		.on('connect_failed', function (reason) {
			$('#chat-window').hide();
			$('.error-feeds').show();
			console.error('unable to connect chatpage to namespace', reason);
		})
		.on('error',function(reason){
			//alert("in error func");
			$('#chat-window').hide();
			$('.error-feeds').show();
			$('#chat-window').html('');
			console.error('unable to connect chatpage to namespace', reason);
		})
		.on('reconnect_failed',function(){
			alert("in reconnect fail func");
			$('#chat-window').hide();
			$('.error-feeds').show();
			$('#chat-window').html('');
		})
		.on('connect', function () {
			console.info('sucessfully established a connection of chatpage with the namespace');
			chatpage.emit('senddata',{user_id:user_id});
		});
		chatpage.on('chatdata',function(data){
			$('#chat-window').html('');
			$('#chat-window').show();
			var header='';
			var content='';
			var footer='';
			
			var cells='';
			if(data.memdata)
			{
				for(n in data.memdata)
				{
					cells+='<span class="label label-default"><input type="hidden" class="userId" value="'+data.memdata[n].user_id+'"/>'+data.memdata[n].username+'</span>&nbsp;';
				}
			}
			header='<div class="panel-heading"><h3 class="panel-title"><span class="label label-success">Online:</span> <span id="online-list"> '+cells+'</span></h3></div>';
			$('#chat-window').append(header);
			
			content='<div class="panel-body" style="min-height:200px;"><ul class="media-list" id="chat_block_list"></ul></div>';
			$('#chat-window').append(content);
			if(data.converdata)
			{
				for(n in data.converdata)
				{
					$('#chat_block_list').append('<li class="media"><div class="media-body"><h4 class="media-heading">'+data.converdata[n].username+'</h4><p>'+data.converdata[n].message+'</p></div></li>');
				}
			}
			else
			{
				$('#chat_block_list').append('');
			}
			footer='<div class="panel-footer"><textarea class="form-control" rows="2" style="display:inline;width:95%" name="msg_box" id="msg_box"></textarea><button type="button" class="btn btn-primary btn-sm pull-right" id="msg_send">Send</button></div>';
			$('#chat-window').append(footer);	
		});
		chatpage.on('showcomment',function(data){
			console.log(data);
			$('#chat_block_list').append('<li class="media"><div class="media-body"><h4 class="media-heading">'+data.message[0].username+'</h4><p>'+data.message[0].message+'</p></div></li>');
			$('#msg_box').val('');
		});
		chatpage.on('newuser',function(data){
			$('#online-list').append('<span class="label label-default"><input type="hidden" class="userId" value="'+data.userdata[0].user_id+'"/>'+data.userdata[0].username+'</span>&nbsp;') 
		});
		chatpage.on('removeuser',function(data){
			$('#online-list span').each(function(index){
				var user_id=$(this).find('.userId').val();
				if(user_id==data.user_id)
				{
					$(this).remove();
				}
			});	
		});
		$('body').on("keypress",'#msg_box', function(e) {	
		if (e.which == 13) {
			$(this).blur();
			var message = $(this).val();
			if(message)
			{
				sendChat(message);
			}
			return false; // prevent the button click from happening
		}
		});	
		$('body').on("click",'#msg_send', function(e) {	
			var message = $('#msg_box').val();
			if(message)
			{
				sendChat(message);
			}
		});
		function sendChat(message)	
		{
			chatpage.emit('sendcomment', {msg:message,user_id:user_id});
		}
}
</script>
