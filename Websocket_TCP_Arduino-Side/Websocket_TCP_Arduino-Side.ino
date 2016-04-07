#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <WebSocketsServer.h>
#include <Hash.h>
#include "Thermistor.h"

//Definição de Usuário e Senha para o ESP8266
#define REDE "projetoFinal"
#define SENHA "projetomicro"

ESP8266WiFiMulti WiFiMulti;
//Abertura da porta 81 como Web Socket
WebSocketsServer webSocket = WebSocketsServer(81);
long lastTimeRefresh = 0;

//Pino Analógico 0 definido como objeto do termistor
Thermistor temp(A0);

//Função que chama a leitura do sensor em graus celsius
float temperatura(){
  temp.getTemp();
  
  return temp.getTemp();
}

//Handler de Evento Web Socket
//                  --Contador  --Tipo do pct  --Conteudo          --Tamanho
void webSocketEvent(uint8_t num, WStype_t type, uint8_t * payload, size_t lenght) {               
    switch(type) {                                                  //  Análise do tipo de pacote
        
        case WStype_DISCONNECTED:                                   //Sem conexão
            Serial.println(" Disconnected!");
            break;
            
        case WStype_CONNECTED:                                     //Conectado
            {   
              
                IPAddress ip = webSocket.remoteIP(num);
                Serial.printf("[%u] Connected from %d.%d.%d.%d url: %s\n", num, ip[0], ip[1], ip[2], ip[3], payload);
        
                                                                //Pega o valor de IP remoto conectado ao programa
                webSocket.sendTXT(num, "ok");                   // envia mensagem ao cliente conectado
            }
            break;

        
        case WStype_TEXT:                                       //Pacote de Texto
           
            Serial.printf("[%u] get Text: %s\n", num, payload); //Imprime o texto recebido na porta serial
            long lastTimeRefresh = millis();                    //inicia um contador de tempo de serviço
            delay(50);                                          //delay de 50ms para que não haja perda de pacotes
            String text = String((char *) &payload[0]);         //extração do texto de dentro do pacote

            
            if (text == "PING") {                               //Caso o texto seja "Ping" responda "Pong"
            webSocket.sendTXT(num, "PONG");
           
            }else if(text == "okpct"){                          //    O okpct foi um flag de confirmação de recebimento programado do lado cliente da aplicação
                                                                //toda vez que esse pacote for recebido o loop cai nesse laço e continua a execução do serviço
              float te = temperatura();                         //Leitura do sensor de temperatura
              String msg = "newpct:";                           //Cabeçalho de nova mensagem
              
              msg+= te;                                         //Temperatura anexada a nova mensagem
              msg+= ":";                                        //Caractére de escape para separação do string do lado do cliente
              msg+= lastTimeRefresh;                            //contador de tempo de serviço anexado ao pacote para manter controle de atraso
              Serial.println(te);
              
              webSocket.sendTXT(num, msg);                     //Pacote enviado ao cliente webSocket
              
             }

            break;
    }

}


void setup() {
  
    Serial.begin(115200);                                  //Setup padrão
    pinMode(0, INPUT);
    Serial.setDebugOutput(true);

    Serial.println();
    Serial.println();
    Serial.println();

    for(uint8_t t = 4; t > 0; t--) {

        Serial.printf("[INICIALIZAÇÃO] AGUARDE %d...\n", t);
        Serial.flush();
        delay(1000);

    }

    WiFiMulti.addAP(REDE,SENHA);                        //Conecta a rede WiFi

    while(WiFiMulti.run() != WL_CONNECTED) {            //Enquanto não estiver conectado 
        delay(300);    
    }
    
    Serial.println("Conectado");                        //Imprime no Serial
    webSocket.begin();                                  //Inicia o serviço de Web Socket
    webSocket.onEvent(webSocketEvent);                  //Handler de Evento
}

void loop() {
    webSocket.loop();                                   //Mantém o Web Socket Ativo
}


