var rooms = [];
module.exports.getUserFeeds = function (chatpage, socket, io, pool,async)
{
	socket.on('senddata', function (data)
    {
		socket.user_id = data.user_id;
		pool.getConnection(function (err, connection)
		{
			 async.parallel([
				function(callback)
				{
					connection.query('SELECT * FROM livehelp_chats where id=' + data.user_id + '', function (error1, userdata)
					{
						if (error1) return callback(error1);
						callback(null, userdata);
					});
				},
				function (callback)
				{
					if(data.user_id)
					connection.query('SELECT * FROM livehelp_chats where id=' + data.user_id + '', function (error3, memdata)
					{
						if (error3) return callback(error3);
						callback(null, memdata);
					});
					else
						callback(null,null);
				},
				function(callback)
				{
					if(data.user_id)
					connection.query('SELECT * FROM livehelp_messages INNER JOIN livehelp_chats ON livehelp_messages.chat=livehelp_chats.id and livehelp_chats.id = ' + data.user_id + '',function(error4,converdata){
						if (error4) return callback(error4);
						callback(null, converdata);
					});
					else
						callback(null,null);
				}
			 ], function (err, results)
				{
					if(err) throw err;
					socket.emit('chatdata',
					{
						memdata:results[1],
						converdata:results[2],
					});
					socket.broadcast.to('room'+ data.room_id +'').emit('newuser', {userdata:results[0]});
					connection.release();
				});
		});
	});
	
	socket.on('sendcomment', function (data)
	{
		pool.getConnection(function (err, connection)
        {
			connection.query('INSERT INTO livehelp_messages (chat,username,message,align,status) VALUES (' + data.user_id + ',"add message from node js front","' + data.msg + '","1","0")', function (err, result)
            {
				if (err) throw err;
				async.parallel([
					function (callback)
					{
						connection.query('SELECT * FROM livehelp_messages INNER JOIN livehelp_chats ON livehelp_messages.chat=livehelp_chats.id and livehelp_messages.id = ' + result.insertId + '', function (err1, comments)
						{
							if (err1) return callback(err1);
							callback(null, comments);
						});
					},
					function (callback)
                    {
                        connection.query('SELECT count(id) as unread_count  from livehelp_messages where livehelp_messages.chat = '+ data.user_id +' and status=0', function (err2, comment_count)
                        {
							if (err2) return callback(err2);
                            callback(null, comment_count);
                        });
                    },
					function (callback)
                    {
                       connection.query('SELECT livehelp_chats.*,(COUNT(livehelp_messages.`status`)-SUM(livehelp_messages.`status`)) as unread_msg FROM livehelp_messages INNER JOIN livehelp_chats ON livehelp_messages.chat=livehelp_chats.id and livehelp_chats.status = 0 group by(livehelp_chats.id)', function (err3, userdata)
                        {
							if (err3) return callback(err3);
							callback(null, userdata);
                        });
                    },
					function (callback)
                    {
                       connection.query('SELECT * from livehelp_messages where livehelp_messages.chat='+ data.user_id +'', function (err4, sendmsg)
                        {
							if (err4) return callback(err4);
							callback(null, sendmsg);
                        });
                    },
					function(callback)
					{
						connection.query('SELECT livehelp_chats.* from livehelp_chats where livehelp_chats.id = '+data.user_id+'', function (err5, customerdata)
						{
							if (err5) return callback(err5);
							callback(null, customerdata);
						});
					},
					], function (err, results)
					{
						if (err) throw err;
						if (results[0])
						{
						socket.emit('showcomment',
                            {
								message: results[0],
                                message_count: results[1]
                            });
						socket.broadcast.to().emit('showcustomerlist', {customerdata:results[2]});
						socket.broadcast.to().emit('custinfo-same', {customermsg:results[3],unreadmsg:results[1],customerdata:results[4]});
						}
						connection.release();
					});	
			});
		});
	});
	socket.on('custinfo', function (data)
	{
		pool.getConnection(function (err, connection)
		{
			 async.parallel([
				function(callback)
				{
					connection.query('SELECT livehelp_chats.* from livehelp_chats where livehelp_chats.id = '+data.chatid+'', function (error1, userdata)
					{
						if (error1) return callback(error1);
						callback(null, userdata);
					});
				},
				function (callback)
                {
                    connection.query('SELECT * from livehelp_messages where livehelp_messages.chat='+ data.chatid +'', function (error2, msg_info)
                    {
						if (error2) return callback(error2);
                        callback(null, msg_info);
                    });
                },
				function (callback)
                {
                    connection.query('SELECT count(id) as unread_count from livehelp_messages where livehelp_messages.status=0 and livehelp_messages.chat = '+ data.chatid +'', function (error3,unread_count)
                    {
						if (error3) return callback(error3);
                        callback(null, unread_count);
                    });
                },
			 ], function (err, results)
				{
					if(err) throw err;
					socket.emit('custinfo',
					{
						customerdata:results[0],
						customermsg:results[1],
						unreadmsg:results[2],
					});
					connection.release();
				});
		});
	});
	socket.on('customerlist', function (data)
    {
		socket.admin_user_id = data.admin_user_id;
		pool.getConnection(function (err, connection)
		{
			 async.parallel([
				function(callback)
				{
					connection.query('SELECT livehelp_chats.*,(COUNT(livehelp_messages.`status`)-SUM(livehelp_messages.`status`)) as unread_msg FROM livehelp_messages INNER JOIN livehelp_chats ON livehelp_messages.chat=livehelp_chats.id and livehelp_chats.status = 0 group by(livehelp_chats.id)', function (error1, userdata)
					{
						if (error1) return callback(error1);
						callback(null, userdata);
					});
				}
			 ], function (err, results)
				{
					if(err) throw err;
					socket.emit('customerlist',
					{
						customerdata:results[0],
					});
					//socket.broadcast.to('room'+ data.room_id +'').emit('newuser', {userdata:results[0]});
					connection.release();
				});
		});
	});
	socket.on('removeunread', function (data)
    {
		pool.getConnection(function (err, connection)
        {
			connection.query('UPDATE `livehelp_messages` SET `status` = 1 WHERE `livehelp_messages`.`chat` = '+data.chatid+'', function (err, result)
            {
				if (err) throw err;
				async.parallel([
					function (callback)
                    {
                       connection.query('SELECT livehelp_chats.*,(COUNT(livehelp_messages.`status`)-SUM(livehelp_messages.`status`)) as unread_msg FROM livehelp_messages INNER JOIN livehelp_chats ON livehelp_messages.chat=livehelp_chats.id and livehelp_chats.status = 0 group by(livehelp_chats.id)', function (err3, userdata)
                        {
							if (err3) return callback(err3);
							callback(null, userdata);
                        });
                    },
				],
				function (err, results)
				{
					if(err) throw err;
					socket.emit('showcustomerlist',
					{
						customerdata:results[0],
					});
					connection.release();
				});
			});
		});
    });
	
};