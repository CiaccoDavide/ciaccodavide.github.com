var WebSocketServer = require('ws').Server;
var wss = new WebSocketServer({port: 8080});
var n = 0;
var tmp="",tmp1="",tmp2="";
var s;
wss.broadcast = function(data) {
  for (var i in this.clients)
    this.clients[i].send(data);
};

wss.on('connection', function(ws) {
	ws.on('message', function(message) {
		s="";
		for(var i=0;i<10;i++)
			s+=message.charAt(i);
		if(message.charAt(0)=='1'){
			if(message.charAt(1)!=tmp1.charAt(1)||message.charAt(2)!=tmp1.charAt(2)||message.charAt(3)!=tmp1.charAt(3)||message.charAt(4)!=tmp1.charAt(4)||message.charAt(5)!=tmp1.charAt(5)||message.charAt(6)!=tmp1.charAt(6)||message.charAt(7)!=tmp1.charAt(7)||message.charAt(8)!=tmp1.charAt(8)||message.charAt(9)!=tmp1.charAt(9)){
				console.log('received: %s', message);
				wss.broadcast(message);
				tmp1=message;
			}
		}else if(message.charAt(0)=='2'){
			if(message.charAt(1)!=tmp2.charAt(1)||message.charAt(2)!=tmp2.charAt(2)||message.charAt(3)!=tmp2.charAt(3)||message.charAt(4)!=tmp2.charAt(4)||message.charAt(5)!=tmp2.charAt(5)||message.charAt(6)!=tmp2.charAt(6)||message.charAt(7)!=tmp2.charAt(7)||message.charAt(8)!=tmp2.charAt(8)||message.charAt(9)!=tmp2.charAt(9)){
				console.log('received: %s', message);
				wss.broadcast(message);
				tmp2=message;
			}
		}else{
			if(message.charAt(1)!=tmp.charAt(1)||message.charAt(2)!=tmp.charAt(2)||message.charAt(3)!=tmp.charAt(3)||message.charAt(4)!=tmp.charAt(4)||message.charAt(5)!=tmp.charAt(5)||message.charAt(6)!=tmp.charAt(6)||message.charAt(7)!=tmp.charAt(7)||message.charAt(8)!=tmp.charAt(8)||message.charAt(9)!=tmp.charAt(9)){
				console.log('received: %s', message);
				wss.broadcast(message);
				tmp=message;
			}
		}
		//ws.send(message);
	});
	
});


