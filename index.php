<html>
<head>
	<meta charset="utf-8">
	<title>chat</title>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<script>
	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			testAPI();
		} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Please log ' +
			'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' +
			'into Facebook.';
		}
	}

	// This function is called when someone finishes with the Login
	// Button.  See the onlogin handler attached to it in the sample
	// code below.
	function checkLoginState() {
		FB.getLoginStatus(function (response) {
			statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function () {
		FB.init({
			appId: '195441934138712',
			cookie: true,  // enable cookies to allow the server to access
		                   // the session
			xfbml: true,  // parse social plugins on this page
			version: 'v2.5' // use version 2.2
		});

		// Now that we've initialized the JavaScript SDK, we call
		// FB.getLoginStatus().  This function gets the state of the
		// person visiting this page and can return one of three states to
		// the callback you provide.  They can be:
		//
		// 1. Logged into your app ('connected')
		// 2. Logged into Facebook, but not your app ('not_authorized')
		// 3. Not logged into Facebook and can't tell if they are logged into
		//    your app or not.
		//
		// These three cases are handled in the callback function.

		FB.getLoginStatus(function (response) {
			statusChangeCallback(response);
		});

	};

	// Load the SDK asynchronously
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function (response) {
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.name + '!';
		});
	}
</script>
<div class="container-fluid">
	<h1>Please login to use chat</h1>
	<!-- Brand and toggle get grouped for better mobile display -->

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<div class="row">
			<div class="col-md-12">
				<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				</fb:login-button>

				<div id="status">
				</div>
				<form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
					<div class="form-group">
						<input placeholder="Login" type="text" name="login" id="" required/>
						<input type="password" name="password" id="" required/>
						<input type="submit" name="submit" value="login" class="btn btn-primary btn-block"/>

						<div class="help-block text-right"><a href="">Forget the password ?</a></div>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> keep me logged-in
						</label>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.navbar-collapse -->
</div>
<!-- /.container-fluid -->


</body>
</html>

<?php
ini_set('display errors', 1);
echo sha1('ololo' . 'qwerty123~') . "<br />";

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "1");
define("DBNAME", "chat");


$login = stripslashes(trim($_POST['login']));
$password = stripslashes(trim($_POST['password']));

//$login = mysql_real_escape_string($login);
//$password = mysql_real_escape_string($password);

$login_date = date("Y:m:d h:m:s");

if (isset($_COOKIE[user_logged])) {
	header("Location: http://127.0.0.1/chat.php");
}


if (isset ($_POST ['submit'])) {
	if (empty ($login) or empty($password)) {
		die("please fill the form above");
	}
	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME) or die ("Connection failed: " . mysqli_connect_error());
	$sql = "SELECT * FROM users WHERE login = '" . $login . "' AND password = '" . sha1('ololo' . $password) . "' ";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	print_r($sql, $count);

	echo ' <br />';

	if ($count == 1) {
		echo "Welcome, " . $login . "<br />";
		$sql = "UPDATE users
				SET	 last_login = '" . $login_date . "'
				Where `login` = '" . $login . "'";
		$result = mysqli_query($conn, $sql);

		$cookie_value = "$login_date";
		$user_name = setcookie(user_logged, $login, time() + (86400 * 30), "/"); // 86400 = 1 day

		if (!isset($_COOKIE["$user_name"])) {
			echo "Cookie '" . $user_name . "' is not set!";
		}
		echo "Cookie login '" . $user_name . "' is set!<br />";
		echo "You have logged in at : " . $_COOKIE["$user_name"];
		header("Location: http://127.0.0.1/chat.php");

	} else {
		die ('<b>Wrong username or password</b> <br />');
	}

	mysqli_close($conn);
}

?>



