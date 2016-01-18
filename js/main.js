/*
*
* @author evgeniy.zarechenskiy
* @email misterjaaay@gmail.com
* todo list
* 1. storing history
* 2. list of active users
* 3. private messages
* 4. storing FB users in DB
 */
$(document).ready(function () {
    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function getCookie(user_logged) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + user_logged.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    var login = getCookie("user_logged");

    if (!login) {
        if (window.location.href === 'http://localhost/chat.php') {
            alert("please login to continue");
            window.location.assign("http://localhost");
        }
    }

    var socket = io.connect('http://localhost:3000');
    var name = login + " ";
    var messages = $("#messages");
    var uploadBtn = $(".upload");
    var message_txt = $("#message_text");


    function msg(nick, message) {
        var m = '<div class="msg">' +
            '<span class="user">' + safe(nick) + ':</span> '
            + safe(message) +
            '</div>';
        messages
            .append(m)
            .scrollTop(messages[0].scrollHeight);
    }

    function msg_system(message) {
        var m = '<div class="msg system">' + safe(message) + '</div>';
        messages
            .append(m)
            .scrollTop(messages[0].scrollHeight);
    }


    socket.on('connecting', function () {
        msg_system('Соединение...');
    });

    socket.on('connect', function () {
        msg_system('System: Соединение установлено!');
        msg_system('Welcome, ' + login);
    });

    socket.on('message', function (data) {
        msg(data.name, data.message);
        message_txt.focus();
    });
    /**
     * sending message on Enter
     */
    $(window).keydown(function (event) {
        if (event.which === 13) {
            var text = $("#message_text").val();
            if (text.length <= 0)
                return;
            message_txt.val("");
            socket.emit("message", {message: text, name: name});
        }
    });
    document.onkeydown = function(e) {
        e = e || window.event;
        if (e.altKey && e.keyCode == 84) {
            console.log("IGh0dHBzOi8veW91dHUuYmUvd1B3dzhjUlF2MW8=")
            return false
        }
    }

    function safe(str) {
        return str.replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/\+/g, "&nbsp")
            .replace(/>/g, '&gt;');
    }

});
