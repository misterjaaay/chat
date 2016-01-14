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
				<div class="about">
					<?php
						echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
						echo "Имя пользователя: " . $userInfo['name'] . '<br />';
						echo "Email: " . $userInfo['email'] . '<br />';
						echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
						echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
						echo "ДР: " . $userInfo['birthday'] . '<br />';
						echo '<img src="http://graph.facebook.com/' . $userInfo['username'] . '/picture?type=large" />';
					echo "<br />";
					?>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="http://localhost:3000/socket.io/socket.io.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>