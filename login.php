<?php
session_start();
include("config.php");

if(isset($_POST['email']) && strlen($_POST['email']) > 0){

	if(!isset($_SESSION))
        session_start();

    $_SESSION['email'] = $mysqli->escape_string($_POST['email']);
    $_SESSION['senha'] = md5(md5($_POST['senha']));

    $sql_code = "SELECT senha, codigo, apelido, nivel FROM usuario WHERE email = '$_SESSION[email]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    if($total == 0){
    	$erro[] = "Este email não pertence à nenhum usuário.";
    }else{

    	if($dado['senha'] == $_SESSION['senha']){

    		$_SESSION['usuario'] = $dado['codigo'];
			$_SESSION['apelido'] = $dado['apelido'];
			$_SESSION['nivel'] = $dado['nivel'];
			unset($_SESSION['msg']);

    	}else{

    		$erro[] = "Senha incorreta.";

    	}

    }

    if(count($erro) == 0 || !isset($erro)){
    	echo "<script>alert('Login efetuado com sucesso'); location.href='index.php';</script>";
    }

}
$men= $_SESSION['msg'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VibbeCoin</title>

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
	<script type="text/javascript" src="assets/js/core/app.js"></script>
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
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Back to site</span>
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

					<!-- Simple login form -->
					<form method="POST" action="">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Panel Access <small class="display-block">Use your credential.</small></h5>
							</div>
							<?php if(count($erro) > 0)
			foreach($erro as $msg){
				echo "<p>$msg</p>";
			} echo $men;
		?>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="email" class="form-control" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="senha" class="form-control" placeholder="Senha">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot your password?</a>
							</div>
							<div class="text-center">
								<a href="cadastro.php">Not registered yet? Sign Up.</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


										<!-- Footer -->
					<div class="footer text-muted">
						&copy; <?= date("Y"); ?>. <a href="#">VibbeCoin</a>. All rights reserved.
					</div>
					<!-- /footer -->


				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
