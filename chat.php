<?php include_once 'header.php'; ?>

<div class="wrapper">
	<h1>Smart chat with <strike><sub>blackjack</sub></strike> nodejs and socket.io</h1>

	<div class="pages chat">
		<div class="messages" id="messages"></div>
		<div class="message-text-holder">
			<input type="text" name="message_text" id="message_text"
			       placeholder="<?php echo $_COOKIE['user_logged']; ?> | type text here...">
		</div>
	</div>
</div>
<?php include_once 'footer.php' ?>
