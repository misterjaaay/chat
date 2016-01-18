<?php
session_start();
include_once 'header.php';
?>
<div class="row text-center">
	<div class="modal-dialog">
		<div class="modal-content">
			<h1>Welcome, <?php
				if (isset($_COOKIE["user_logged"])){
					echo $_COOKIE["user_logged"];
				}else{
					echo 'Guest';
				}
					?>
			</h1>
			<p>
				<?php
				if(isset($_COOKIE['user_logged'])){
					echo '<a href="/chat.php">Continue chatting</a>';
				}
			?>
			</p>
		</div>
	</div>
</div>
<?php include_once 'footer.php' ?>
