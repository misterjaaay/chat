<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<meta name="robots" content="noindex,nofollow"/>
	<title>Smart chat with nodejs and socket.io</title>
</head>
<body>
<div class="wrapper">
	<h1>Smart chat with <strike><sub>blackjack</sub></strike> nodejs and socket.io</h1>
	<div class="pages chat">
		<div class="messages" id="messages"></div>
		<div class="panel">

			<button class="logout">Logout</button>
		</div>
		<div class="message-text-holder">
			<input type="text" name="message_text" id="message_text" placeholder="<?php echo $_COOKIE['user_logged'];?> | type text here...">
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="main.js"></script>
</body>
</html>