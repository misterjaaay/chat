<?php
session_start();
include_once 'header.php';

if (isset($_SESSION['login'])) {
	header("Location: http://localhost/chat.php");
}
?>
<div class="row text-center">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="padding: 35px 50px;">
				<h1>Welcome,<?php  echo ($_COOKIE["user_logged"] !='' ? $_COOKIE['user_logged'] : 'Guest');  ?></h1>
				<p>Chat, Oralce edition</p>

			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.php'?>
