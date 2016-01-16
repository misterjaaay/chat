
<?php
session_start();
include_once 'header.php';


if (isset($_SESSION['login'])) {
	header("Refresh: 5; URL=http://localhost/chat.php");
}
?>
<div class="row text-center">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="padding: 35px 50px;">
				<h1>Welcome,<?php echo ($_COOKIE["user_logged"] !='' ? $_COOKIE['user_logged'] : 'Guest');  ?></h1>
				<p>Chat, Oralce edition</p>

				<h4>
					<span class="glyphicon glyphicon-lock"></span> Login
				</h4>
			</div>
			<div class="modal-body" style="padding: 40px 50px;">
				<form role="form" action="login.php" method="POST">
					<div class="form-group">
						<label for="usrname"><span
								class="glyphicon glyphicon-user"></span> Username</label>
						<input type="text" name="login" required
						       class="form-control" id="usrname"
						       placeholder="Enter login">
					</div>
					<div class="form-group">
						<label for="psw"><span
								class="glyphicon glyphicon-eye-open"></span> Password</label>
						<input type="password" name="password" required
						       class="form-control" id="psw"
						       placeholder="Enter password">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked>Remember
							me</label>
					</div>
					<button type="submit" name="submit"
					        class="btn btn-success btn-block">
						<span class="glyphicon glyphicon-off"></span> Login
					</button>
				</form>
			</div>
			<div class="modal-footer">
				<p>
					Not a member? <a href="#modal">Sign Up</a>
				</p>
				<p>
					Forgot <a href="#">Password?</a>
				</p>
			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.php'?>
