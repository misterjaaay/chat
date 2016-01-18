<?php
require_once 'inc/Db.php';

/**
 * Class User
 */
class User
{
	/**
	 * UserLogin @vars
	 */
	public $login;
	public $password;
	public $login_date;
	public $rememberMe;

	/**
	 * UserLogin @vars
	 */
	public $new_login;
	public $email;
	public $new_password;
	public $r_password;
	public $registration_date;

	/**
	 * FacebookLogin @vars
	 */
	public function UserLogin()
	{
		$this->login = trim($_POST ['login']);
		$this->password = trim($_POST ['password']);
		$this->rememberMe = $_POST['rememberMe'];
		$this->login = stripslashes($this->login);
		$this->password = stripslashes($this->password);
		$this->login_date = date("Y:m:d h:m:s");


		if (isset ($_POST ['submit'])) {
			$conn = new Db;
			$sql = "SELECT * FROM users WHERE login = '{$this->login}' AND password = '" . sha1('ololo' . $this->password) . "' ";
			$result = $conn->sqlQuery($sql);

			$count = mysqli_num_rows($result);

			if ($count == 1) {

				$sql = "UPDATE users
					SET	 last_login= '" . $this->login_date . "'
					Where `login` = '" . $this->login . "'";
				$conn->sqlQuery($sql);

				if (isset($this->rememberMe)) {
					setcookie('rememberMe', $_SERVER["REMOTE_ADDR"] . $this->login, time()+3600 * 24 * 1000);

					$_SESSION['login'] = $this->login;
					setcookie('user_logged', $this->login, time()+3600 * 24 * 1000);
					header('Location: http://localhost/chat.php');
					exit();

				} else{
					$_SESSION['login'] = $this->login;

					setcookie('user_logged', $this->login);
					header('Location: http://localhost/chat.php');
					exit();
				}


			} else {
				exit('Wrong username or password') ;
				echo '</br><a href = " http://localhost">Return to main page</a>';
			}
		}
	}

	/**
	 *
	 */
	public function UserRegister()
	{
		$this->new_login = trim($_POST ['new_login']);
		$this->email = trim($_POST ['email']);
		$this->new_password = trim($_POST ['new_password']);
		$this->r_password = trim($_POST ['new_r_password']);
		$this->registration_date = date("Y:m:d h:m:s");

		$this->new_login = stripslashes($this->new_login);
		$this->email = stripslashes($this->email);
		$this->new_password = stripslashes($this->new_password);
		$this->r_password = stripslashes($this->r_password);

		if (isset ($_POST ['register'])) {
			$conn = new Db;

			if ($this->new_password === $this->r_password) {
				$this->new_password = sha1('ololo' . $this->new_password);
			} else {
				exit ("passwords do not match");
			}

			if (!(filter_var($this->email, FILTER_VALIDATE_EMAIL))) {
				exit ("This ($this->email) email address is not valid.");
			}

			if (!preg_match("#^[A-Za-z0-9]+$#", $this->new_login)) {
				exit("Please use letters or digits");
			}

			$sql = "SELECT * FROM users WHERE `email` = '{$this->email}' OR `login` = '{$this->new_login}'";
			$result = $conn->sqlQuery($sql);

			$count = mysqli_num_rows($result);

			if ($count >= 1) {
				exit ("USER OR EMAIL is occupied");
			} else {
				$sql = "INSERT INTO users (login, password, last_login, email )
					 VALUES ('" . $this->new_login . "','" . $this->new_password . "', '" . $this->registration_date . "', '" . $this->email . "')";

				$result = $conn->sqlQuery($sql);

				if ($result) {
					if (isset($this->rememberMe)) {
						setcookie('rememberMe', $_SERVER["REMOTE_ADDR"] . $this->login, time()+3600 * 24 * 1000);

						$_SESSION['login'] = $this->login;
						setcookie('user_logged', $this->login, time()+3600 * 24 * 1000);

						/*
						 * need to setup mail server to use the following feature:
						 * mail($this->email, "Сообщение с сайта " . $_SERVER ['SERVER_NAME'], "Приветствуем Вас на сайте " . $_SERVER ['SERVER_NAME']);
						 */
						header('Location: http://localhost/chat.php');
						exit();


					} else{
						$_SESSION['login'] = $this->login;

						setcookie('user_logged', $this->login);
						mail($this->email, "Сообщение с сайта " . $_SERVER ['SERVER_NAME'], "Приветствуем Вас на сайте " . $_SERVER ['SERVER_NAME']);

						header('Location: http://localhost/chat.php');
						exit();
					}

				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
	}

	/**
	 *
	 */
	public function logoutUser()
	{
		if (isset ($_POST ['logout'])) {
			session_unset();
			session_destroy();
			setcookie("user_logged", "", time() - 3600);
			setcookie('rememberMe', "", time() - 3600);
			setcookie("PHPSESSID", "", time() - 3600);
			echo '<script>window.location="http://localhost"</script>';
		}
	}
}
