<?php
session_start();

include_once 'header.php';

if (isset($_SESSION['login'])) {
	header("Location: http://localhost/chat.php");
}
?>
<div class="row text-center">
	<div class="modal-dialog">
		<div class="modal-content">
			<h1>Welcome,<?php echo " ". ($_COOKIE["user_logged"] != '' ? $_COOKIE['user_logged'] : 'Guest'); ?></h1>

			<p>Chat, Oralce edition</p>
		</div>
	</div>
</div>

<?php include_once 'footer.php' ?>
