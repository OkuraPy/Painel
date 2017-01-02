<?
session_start();
include("config.php");
if ($_POST['email']) {
	
if (empty($_POST['nome'] || $_POST['email'] || $_POST['telefone'] || $_POST['senha'] || $_POST['senha2'])) {
	
	$msg= "All fields are mandatory.";
	
}

if (!$_POST['senha'] === $_POST['senha2']) {
	
	$msg= "Passwords do not match!";
}

$nome= $mysqli->real_escape_string($_POST['nome']);
$email= $mysqli->real_escape_string($_POST['email']);
$telefone= $mysqli->real_escape_string($_POST['telefone']);
$senha = md5(md5($mysqli->real_escape_string($_POST['senha'])));

	$n_user = "INSERT INTO usuario(email,senha,apelido,telefone,nivel,registro) VALUES ('$email', '$senha', '$nome', '$telefone', '0', now())";
	
	if ($mysqli->query($n_user) === TRUE) {
				$to = $email;
				$subject = "Account created";

				$message = "
					<html><head>
					<title>Account created</title>
					</head><body>
					<p>Hello,</p><br>
					<p>See below you data to login:</p>
					<br><br>
					<p><b>Your Email:</b> " .$email. "<br>
					<b> Your Password: </b>" .$_POST['senha']. "</p>
					<br><br>Regards.
					</body></html>
				";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <system@coins2.trade>' . "\r\n";

				mail($to,$subject,$message,$headers);
				header("Location:login.php");
				$_SESSION['msg'] = '<center><font color="green">Registration successfully complete.</font></center>';
			} else {
				$msg= "Erro: " . $n_user . "<br>" . $mysqli->error;
			}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Painel de Controle - Central de Downloads</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form name="cadastro" method="post" action="cadastro.php">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
								<h5 class="content-group">Sign Up<small class="display-block">Required fields<br><? if(!empty($msg)) { echo $msg; } ?></small></h5>
							</div>

							<div class="content-divider text-muted form-group"><span>Your data</span></div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="nome" class="form-control" placeholder="Type your name">
								<div class="form-control-feedback">
									<i class="icon-user-check text-muted"></i>
								</div>
							</div>
							
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="email" class="form-control" placeholder="Type your e-mail">
								<div class="form-control-feedback">
									<i class="icon-envelop text-muted"></i>
								</div>
							</div>
							
							
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="telefone" class="form-control" placeholder="Enter your phone" required>
								<div class="form-control-feedback">
									<i class="icon-phone text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="senha" class="form-control" placeholder="Type your password" required>
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
							</div>
							
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="senha2" class="form-control" placeholder="Confirm your password" required>
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
							</div>

							<button type="submit" class="btn bg-teal btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
						</div>
					</form>
					<!-- /advanced login -->

<? include("footer.php"); ?>