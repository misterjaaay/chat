<html>
	<head>
		<meta charset="utf-8">
		<title>chat</title>
	</head>
	<body>
		<div id="content">
			<h1>Please login to use chat</h1>

			<form id="login-form" method="post">
				<input type="text" name="login" id=""/>
				<input type="password" name="password" id=""/>
				<input type="submit" name="submit" value="login"/>
			</form>
		</div>
	</body>
</html>

<?php
ini_set('display errors', 1);
echo sha1('ololo' . 'qwerty123~')."<br />";

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "1");
define("DBNAME", "chat");


$login = stripslashes(trim ($_POST['login']));
$password = stripslashes(trim($_POST['password']));

//$login = mysql_real_escape_string($login);
//$password = mysql_real_escape_string($password);

$login_date = date ( "Y:m:d h:m:s" );

if (isset ( $_POST ['submit'] )) {
	if (empty ($login) or empty($password)){
		die("please fill the form above");
	}
	$conn = mysqli_connect ( SERVERNAME, USERNAME, PASSWORD, DBNAME ) or die ( "Connection failed: " . mysqli_connect_error () );
	$sql = "SELECT * FROM users WHERE login = '".$login."' AND password = '".sha1 ( 'ololo' . $password )."' ";
	$result = mysqli_query ( $conn, $sql );
	$count = mysqli_num_rows ( $result );

	print_r($sql, $count);

	echo ' <br />';

	if ($count == 1) {
		echo "Welcome, ".$login."<br />";
		$sql = "UPDATE users
				SET	 last_login = '" . $login_date . "'
				Where `login` = '".$login."'";
		$result = mysqli_query ( $conn, $sql );
		$_SESSION["login"] = "$login";
		echo "Session variables are set:  ".$_SESSION["login"]."<br />";
		/*cookie*/

		$cookie_value = "$login_date";
		setcookie($login, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

		if(!isset($_COOKIE["$login"])) {
			echo "Cookie '" . $login . "' is not set!";
		} else {
			echo "Cookie login '" . $login . "' is set!<br />";
			echo "You have logged in at : " . $_COOKIE["$login"];
		}
		header("Location: http://127.0.0.1/chat.php");

	} else {
		die ('<b>Wrong username or password</b> <br />');
	}

	mysqli_close ( $conn );
}

?>



