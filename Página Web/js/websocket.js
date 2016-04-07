var webSocket;
var ip;
var porta;
var tent = 0;
var pause = false;
var sensorVal = 0;
function time(){
	tent ++;
	console.log('não foi possível conectar, tentando novamente: '+tent+'/10');
}

function connect(){
	
		var add = "ws://"+ip+":"+porta;
		webSocket = new WebSocket(add, ['arduino']);
		
		$('#relatorio').show();
		webSocket.onopen = function(evt) { onOpe(evt) };
		webSocket.onmessage = function(evt){OnMsg(evt)};
		webSocket.onerror = function(evt){OnERR(evt)};
		webSocket.onClose = function(evt){OnClo(evt)};
}
function onOpe(evt){
	webSocket.send("PING");
}

var lastLoad = 0;

function OnMsg(evt){
	var msg = evt.data;
	var filtered = msg.split(":");
		var val = filtered[1];

		var time = filtered[2];		
		var timepass =  time - lastLoad;
		lastLoad = time;
		switch (val){
			case "PONG":
			{	$('.ipShow').html(ip);
				$('.portaShow').html(porta);
				$('.activeShow').html("Ativo");
				webSocket.send("okpct");
			}
				break;
			default:
			{	$('.ipShow').html(ip);
				$('.portaShow').html(porta);
				$('.activeShow').html("Ativo");
				$('.taxaShow').html(timepass);
				sensorVal = val;
				console.log(sensorVal);
				webSocket.send("okpct");
			}
			break;
}
}

function OnERR(evt){
		$('#erro').show();
				$('#relatorio').hide();
		
}
function OnClo(evt){
			console.log('Encerrando conexão com o Arduino');
			webSocket.close();
			$('#relatorio').hide();
			$('#cadastraEspForm').show();
}



/*}catch (exception){
		$("#erro").show();
		if(tent <= 9){
		 tent++;
		 $(".tent").html(tent);
		 console.log("não conectado, tentando novamente");
		 setTimeout(connect,500);
		}else{
			$("#erro").remove();
			$("#aviso").css("display: inline");
			console.log("Servidor ocupado, tente mais tarde");
		}}*/

