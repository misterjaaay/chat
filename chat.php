<?php include_once 'header.php'; ?>

	<body>
		<div class="wrapper">
			<h1>Smart chat with <strike><sub>blackjack</sub></strike> nodejs and socket.io</h1>
			<div class="pages chat">
				<div class="messages" id="messages"></div>
				<div class="panel">
					<h3><a href="logout.php">Logout</a></h3>
				</div>
				<div class="message-text-holder">
					<input type="text" name="message_text" id="message_text" placeholder="<?php echo $_COOKIE['user_logged'];?> | type text here...">
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="http://localhost:3000/socket.io/socket.io.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>