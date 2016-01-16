<?php
require_once 'inc/Db.php';

class User{
	// UserLogin vars
	public $login;
	public $password;
	public $login_date;

	// UserRegister vars
	public $new_login;
	public $email;
	public $new_password;
	public $r_password;
	public $registration_date;
	
	public function UserLogin() {
		$this->login = trim ( $_POST ['login'] );
		$this->password = trim ( $_POST ['password'] );
		$this->login = stripslashes ( $this->login );
		$this->password = stripslashes ( $this->password );
		$this->login_date = date ( "Y:m:d h:m:s" );

		if (isset ( $_POST ['submit'] )) {
			$conn = new Db;
			$sql = "SELECT * FROM users WHERE login = '{$this->login}' AND password = '" . sha1 ( 'ololo' . $this->password ) . "' ";
			$result = $conn->sqlQuery ( $sql );
			
			$count = mysqli_num_rows ( $result );
			echo ' <br />';
			
			if ($count == 1) {

				echo "Welcome back, ".$this->login." <br />";
				$sql = "UPDATE users
					SET	 last_login= '" . $this->login_date . "'
					Where `login` = '" . $this->login . "'";
				$_SESSION['login'] = $login;
				setcookie('user_logged', $login);
				echo '<script>window.location="http://localhost/chat.php"</script>';



			} else {
				die ('Wrong username or password');
			}
		}
	}

	public function UserRegister() {
		$this->new_login = trim ( $_POST ['new_login'] );
		$this->email = trim ( $_POST ['email'] );
		$this->new_password = trim ( $_POST ['new_password'] );
		$this->r_password = trim ( $_POST ['new_r_password'] );
		$this->registration_date = date ( "Y:m:d h:m:s" );
		
		$this->new_login = stripslashes ( $this->new_login );
		$this->email = stripslashes ( $this->email );
		$this->new_password = stripslashes ( $this->new_password );
		$this->r_password = stripslashes ( $this->r_password );
		$this->new_login = mysql_real_escape_string ( $this->new_login );
		$this->email = mysql_real_escape_string ( $this->email );
		$this->new_password = mysql_real_escape_string ( $this->new_password );
		$this->r_password = mysql_real_escape_string ( $this->r_password );
		
		if (isset ( $_POST ['register'] )) {
			$conn = new Db;
			
			if ($this->new_password === $this->r_password) {
				$this->new_password = sha1 ( 'ololo' . $this->new_password );
			} else {
				exit ("passwords do not match");
			}
			
			if (! (filter_var ( $this->email, FILTER_VALIDATE_EMAIL ))) {
				exit ("This ($this->email) email address is not valid.");
			}
			
			if (! preg_match ( "#^[A-Za-z0-9]+$#", $this->new_login )) {
				exit("Please use letters or digits");
			}
			
			$sql = "SELECT * FROM users WHERE `email` = '{$this->email}' OR `login` = '{$this->new_login}'";
			$result = $conn->sqlQuery ( $sql );
			
			$count = mysqli_num_rows ( $result );
			
			if ($count >= 1) {
				exit ("USER OR EMAIL is occupied");
			} else {
				$sql = "INSERT INTO users(login, password, email, create_at )
					 VALUES ('" . $this->new_login . "','" . $this->new_password . "', '" . $this->email . "', '" . $this->registration_date . "')";
				$result = $conn->sqlQuery ( $sql );
				
				if ($result) {
					echo "Welcome <br />";
					mail ( $this->email, "Сообщение с сайта " . $_SERVER ['SERVER_NAME'], "Приветствуем Вас на сайте " . $_SERVER ['SERVER_NAME'] );
					echo "Email has been sent to " . $this->email . "<br /> Now you can <a href='login.php'>log in</a><br />";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
	}
	public function logoutUser() {
		if (isset ( $_POST ['logout'] )){
			session_unset();
			session_destroy();
			setcookie("user_logged","", time () -3600);
			setcookie("user_link","", time () -3600);
			setcookie ( "PHPSESSID", "", time () -3600);
			echo '<script>window.location="http://localhost"</script>';
		}
	}
}
