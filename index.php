<?php

require_once 'Db.php';

session_start();

if (isset($_SESSION['login'])) {

	header("Location: http://localhost/chat.php");
	echo "login user = " . $_SESSION['login'];

}
?>

<html>
<head>
	<meta charset="utf-8">
	<title>chat</title>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid">
	<h1>Please login to use chat</h1>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<div class="row">
			<div class="col-md-12">
				<form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
					<div class="form-group">
						<input placeholder="Login" type="text" name="login" id="" required/>
						<input type="password" name="password" id="" required/>
						<input type="submit" name="submit" value="login" class="btn btn-primary btn-block"/>

						<div class="help-block text-right"><a href="">Forgot the password?</a></div>
					</div>
					<h3><a href="logout.php">Logout</a></h3>
					<!--					<div class="checkbox">-->
					<!--						<label>-->
					<!--							<input type="checkbox"> keep me logged-in-->
					<!--						</label>-->
					<!--					</div>-->
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

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "1");
define("DBNAME", "chat");


$login = stripslashes(trim($_POST['login']));
$password = stripslashes(trim($_POST['password']));

//$login = mysql_real_escape_string($login);
//$password = mysql_real_escape_string($password);

$login_date = date("Y:m:d h:m:s");

if (isset ($_POST ['submit'])) {
	if (empty ($login) or empty($password)) {
		die("please fill the form above");
	}


	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME) or die ("Connection failed: " . mysqli_connect_error());
	$sql = "SELECT * FROM users WHERE login = '" . $login . "' AND password = '" . sha1('ololo' . $password) . "' ";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		echo "Welcome, " . $login . "<br />";
		$sql = "UPDATE users
				SET	 last_login = '" . $login_date . "'
				Where `login` = '" . $login . "'";
		$result = mysqli_query($conn, $sql);

		$_SESSION['login'] = $login;
		$user_logged = setcookie('user_logged', $login);
		echo $user_logged;
		header("Location: http://localhost/chat.php");

	} else {
		die ('<b>Wrong username or password</b> <br />');
	}

	mysqli_close($conn);
}


/*fb auth*/

$client_id = '195441934138712'; // Client ID
$client_secret = 'dc96727cda6246ec918b933fe174c273'; // Client secret
$redirect_uri = 'http://localhost/chat.php'; // Redirect URIs

$url = 'https://www.facebook.com/dialog/oauth';

$params = array(
	'client_id' => $client_id,
	'redirect_uri' => $redirect_uri,
	'response_type' => 'code',
	'scope' => 'email,user_birthday'
);

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Facebook</a></p>';

if (isset($_GET['code'])) {
	$result = false;

	$params = array(
		'client_id' => $client_id,
		'redirect_uri' => $redirect_uri,
		'client_secret' => $client_secret,
		'code' => $_GET['code']
	);

	$url = 'https://graph.facebook.com/oauth/access_token';

	$tokenInfo = null;
	parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);

	if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
		$params = array('access_token' => $tokenInfo['access_token']);

		$userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);

		if (isset($userInfo['id'])) {
			$userInfo = $userInfo;
			$result = true;
		}
	}

	if ($result) {
		echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
		echo "Имя пользователя: " . $userInfo['name'] . '<br />';
		echo "Email: " . $userInfo['email'] . '<br />';
		echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
		echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
		echo "ДР: " . $userInfo['birthday'] . '<br />';
		echo '<img src="http://graph.facebook.com/' . $userInfo['username'] . '/picture?type=large" />';
		echo "<br />";
	}

}
/*fb auth end*/
?>



