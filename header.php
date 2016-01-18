<?php
include_once 'fblogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<title>Smart chat | buy ETAdirect without registration | how to buy OFSC without SMS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrapper">
	<div id='content' class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button class="btn btn-info  btn-lg"><a class="" href="/">Home</a></button>
					</div>
					<div class="collapse navbar-collapse"
					     id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<button class="btn btn-primary fb-btn btn-lg"><?php echo $link; ?></button>
							</li>
							<li>
								<!-- Trigger the modal with a button -->
								<button type="button" class="btn btn-success btn-lg" id="loginBtn">Login</button>
								<!-- Modal -->
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header" style="padding: 35px 50px;">
												<button type="button" class="close"
												        data-dismiss="modal">&times;</button>
												<h4>
													<span class="glyphicon glyphicon-lock"></span> Login
												</h4>
											</div>
											<div class="modal-body" style="padding: 40px 50px;">
												<form role="form" action="login.php" method="POST">
													<div class="form-group">
														<label for="usrname"><span
																class="glyphicon glyphicon-user"></span>
															Username</label>
														<input type="text" name="login" required
														       class="form-control" id="usrname"
														       placeholder="Enter login">
													</div>
													<div class="form-group">
														<label for="psw"><span
																class="glyphicon glyphicon-eye-open"></span>
															Password</label>
														<input type="password" name="password" required
														       class="form-control" id="psw"
														       placeholder="Enter password">
													</div>
													<div class="checkbox">
														<label><input name="rememberMe" type="checkbox" value="" checked>Remember
															me</label>
													</div>
													<button type="submit" name="submit"
													        class="btn btn-success btn-block">
														<span class="glyphicon glyphicon-off"></span> Login
													</button>
												</form>
											</div>
											<div class="modal-footer">
												<button type="submit"
												        class="btn btn-danger btn-default pull-left"
												        data-dismiss="modal">
													<span class="glyphicon glyphicon-remove"></span> Cancel
												</button>
											</div>
										</div>

									</div>
								</div>
							</li>
							<li>
								<form action="logout.php" method="post">
									<button type="submit" name="logout" id="logoutBtn"
									        class="btn btn-default btn-lg">logout
									</button>
								</form>
							</li>
							<li>
								<!-- Trigger the modal with a button -->
								<button type="button" class="btn btn-warning btn-lg"
								        id="registerBtn">Register
								</button>
								<!-- Modal -->
								<div class="modal fade" id="regModal" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header" style="padding: 35px 50px;">
												<button type="button" class="close"
												        data-dismiss="modal">&times;</button>
												<h4>
													<span class="glyphicon glyphicon-lock"></span> Register
												</h4>
											</div>
											<div class="modal-body" style="padding: 40px 50px;">
												<form role="form" action="register.php" method="POST">
													<div class="form-group">
														<label for="usrname"><span
																class="glyphicon glyphicon-user"></span>
															Username</label>
														<input class="form-control" type="text" name="new_login"
														       id="usrname" placeholder="login" required=""/>
													</div>
													<div class="form-group">
														<label for="email"><span
																class="glyphicon glyphicon-envelope"></span>
															Еmail</label>
														<input class="form-control" type="email" name="email"
														       id="email" placeholder="Enter email" required=""/>
													</div>
													<div class="form-group">
														<label for="psw"><span
																class="glyphicon glyphicon-eye-open"></span>
															Password</label>
														<input class="form-control" type="password"
														       name="new_password" id="psw"
														       placeholder="Enter password" required=""/>
													</div>
													<div class="form-group">
														<label for="r_psw"><span
																class="glyphicon glyphicon-eye-open"></span>
															Password</label>
														<input class="form-control" type="password"
														       name="new_r_password" id="r_psw"
														       placeholder="Repeat password" required=""/>
													</div>
													<div class="checkbox">
														<label><input name='rememberMe' type="checkbox" value="" checked>Remember
															me</label>
													</div>
													<button type="submit" name="register"
													        class="btn btn-success btn-block">
														<span class="glyphicon glyphicon-off"></span> register
													</button>
												</form>
											</div>
											<div class="modal-footer">
												<button type="submit"
												        class="btn btn-danger btn-default pull-left"
												        data-dismiss="modal">
													<span class="glyphicon glyphicon-remove"></span> Cancel
												</button>
											</div>
										</div>

									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>