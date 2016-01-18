<?php
/**
 * * @author evgeniy.zarechenskiy
 * @email misterjaaay@gmail.com
 *
 * Created by PhpStorm.
 * User: jay
 * Date: 18.01.16
 * Time: 11:19
 * Facebook login
 */

/*fb auth*/

$client_id = '195441934138712';
$client_secret = 'dc96727cda6246ec918b933fe174c273';
$redirect_uri = 'http://localhost/';
$url = 'https://www.facebook.com/dialog/oauth';
$params = array(
	'client_id' => $client_id,
	'redirect_uri' => $redirect_uri,
	'response_type' => 'code'
);
$link = '<a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Facebook login</a>';
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
		setcookie('user_logged', $userInfo['name']);
		header("Location:http://localhost/chat.php");
	}
}