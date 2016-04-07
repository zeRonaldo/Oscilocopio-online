var ipValue;
var connection;
// funções da ESP

function reset() {
	var toSend = "RESET";
	connection.send(toSend); 
};

function mudaIp(ip){
connection = new WebSocket(ip, ['arduino']); 	
console.log(text)
console.log("IP value changed to:"+ipValue);
};


 //funções gerais
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}


//funções dos Formulários
function validateForm(form, field) {
    var x = document.forms[form][field].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}

function cadastraEsp(){
		ip 			= $("#ip").val();
		porta 		=$("#porta").val();
		
		
		$(".cadastraEspForm").remove();
		connect();

	};

function pushPhp(com, div){

	var php = "<\?php echo '"+com+"'; \?>";
	$(div).html(php);
}

//Gerador de gráficos

