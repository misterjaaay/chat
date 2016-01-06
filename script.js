/**
 * Created by jay on 06.01.16.
 */
window.onload = function(){
    var label = document.getElementById("status");
    var message = document.getElementById("message");
    var btnSend = document.getElementById("send");
    var btnDisconnect = document.getElementById("disconnect");

    btnSend.onclick = function(){
        console.log('send btn pressed');
        if( socket.readyState === WebSocket.OPEN ){
            socket.send(message.value);
        }
    };

    var socket = new WebSocket("wss://echo.websocket.org");
    socket.onopen = function(event){
        console.log('connection set');
        label.innerHTML = 'connection set';
    };

    socket.onclose = function(event){
        console.log('connection unset');
        label.innerHTML = 'connection unset';
        var code = event.code;
        var reason = event.reason;
        var wasClean = event.wasClean;
    };

    socket.onmessage = function(event){
      if(typeof event.data === 'string'){
          label.innerHTML = event.data;
      }

    };
};