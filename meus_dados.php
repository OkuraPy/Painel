<? 

include("config.php");
include("protect.php");
protect();
if(!empty($_POST['nome'] || $_POST['email'])) {

$email = $mysqli->real_escape_string($_POST['email']);
$nome = $mysqli->real_escape_string($_POST['nome']);
$sql = "UPDATE usuario SET apelido='$nome', email='$email' WHERE email='" .$_SESSION['email']. "'";
			if ($mysqli->query($sql) === TRUE) {
				$_SESSION['apelido'] = $nome;
				$_SESSION['email'] = $email;
				$msg= "Dados atualizados.";
			} else {
				$msg= "Error: " . $sql . "<br>" . $mysqli->error;
			}
}
if(!empty($_POST['senha'] || $_POST['senha1'] || $_POST['senha2'])) {

$senha = $mysqli->real_escape_string(md5(md5($_POST['senha'])));
$senha1 = $mysqli->real_escape_string(md5(md5($_POST['senha1'])));
$senha2 = $mysqli->real_escape_string(md5(md5($_POST['senha2'])));
$sql1 = "SELECT senha FROM usuario WHERE email='" .$_SESSION['email']. "'";

if ($mysqli->query($sql1) === TRUE) {
				
			$sql = "UPDATE usuario SET senha='$senha2' WHERE email='" .$_SESSION['email']. "'";
			if ($mysqli->query($sql) === TRUE) {
				$_SESSION['apelido'] = $nome;
				$_SESSION['email'] = $email;
				$msg= "Your password was saved.";
			} else {
				$msg= "Error: " . $sql . "<br>" . $mysqli->error;
			}
				
			} else {
				$msg= "Error: " . $sql1 . "<br>" . $mysqli->error;
			}
}

include("header.php"); ?>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<? include("sidebar.php"); ?>

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">

					<!-- Header content -->
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">My Account</span> - Profile</h4>

							<ul class="breadcrumb position-right">
								<li><a href="index.php">Home</a></li>
								<li class="active">Profile info</li>
							</ul>
						</div>

					</div>
					<!-- /header content -->

				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- User profile -->
					<div class="row">
						<div class="col-md-12">
										<!-- Profile info -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">Profile Info</h6>
											</div>

											<div class="panel-body">
												<form action="meus_dados.php" method="post">
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>My name</label>
																<input type="text" name="nome" value="<?= $_SESSION['apelido']; ?>" class="form-control" required>
															</div>
															<div class="col-md-6">
																<label>Your e-mail</label>
																<input type="text" name="email" value="<?= $_SESSION['email']; ?>" class="form-control" required>
															</div>
														</div>
													</div>

													<div class="text-right">
							                        	<button type="submit" name="info" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
							                        </div>
												</form>
											</div>
										</div>
										<!-- /profile info -->


										<!-- Account settings -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">Change Password</h6>
											</div>

											<div class="panel-body">
												<form action="meus_dados.php" method="post">
													<div class="form-group">
														<div class="row">

															<div class="col-md-6">
																<label>Your password</label>
																<input type="password" name="senha" value="" placeholder="Your password" class="form-control" autocomplete="off" required>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>New password</label>
																<input type="password" name="senha1" placeholder="Enter new password" class="form-control" autocomplete="off" required>
															</div>

															<div class="col-md-6">
																<label>Confirm new password</label>
																<input type="password" name="senha2" placeholder="Repeat new password" class="form-control" autocomplete="off" required>
															</div>
														</div>
													</div>

													<div class="text-right">
							                        	<button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
							                        </div>
						                        </form>
											</div>
										</div>
										<!-- /account settings -->
						</div>
<? include("footer.php"); ?>