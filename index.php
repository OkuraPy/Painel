<? 
include("protect.php");
protect();
include("config.php");
$data = date("Y/m/d");
$sql = $mysqli->query("SELECT COUNT(email) AS total FROM usuario");
$n_user = mysqli_fetch_array($sql);
$sql2 = $mysqli->query("SELECT COUNT(id) AS totaldl FROM downloads WHERE active='1'");
$n_dls = mysqli_fetch_array($sql2);

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

if(!empty($_POST['file'])) {

$email = $_SESSION['email'];
$wallet = $mysqli->real_escape_string($_POST['file']);
$data = date("Y/m/d");
$token = rand(000000,999999);

$sql = "INSERT INTO downloads (file, data, email, token, active) VALUES ('$wallet', '$data', '$email', '$token', '0')";
			if ($mysqli->query($sql) === TRUE) {
				header("Location: downloader.php?wallet=$wallet&token=$token");
			} else {
				echo "Error: " . $sql . "<br>" . $mysqli->error;
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

				<!-- Content area -->
				<div class="content">

					<!-- Main charts -->
					<div class="row">
						<div class="col-md-12">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
								<? if($_SESSION['nivel'] === '1') { ?>
									<h6 class="panel-title">Estatísticas</h6>
									<? } if($_SESSION['nivel'] === '0') { ?>
									<h6 class="panel-title">Downloads Center</h6>
									<? } ?>
								</div>

								<div class="container-fluid">
									<div class="row">
									
									<? if($_SESSION['nivel'] === '1') { ?>
										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-user-plus"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">Novos usuários</div>
													<div class="text-muted"><?= $n_user['total']; ?></div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-visitors"></div>
											</div>
										</div>

										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-file-download"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">Novos downloads</div>
													<div class="text-muted"><?= $n_dls['totaldl']; ?></div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-sessions"></div>
											</div>
										</div>
									<? } ?>
									<? if($_SESSION['nivel'] === '0') { ?>
									<div class="col-md-6">
									
																	<!-- Default table -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Windows</h5>
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Version</th>
										<th>File Size</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<? $sql = $mysqli->query("SELECT * FROM arquivos WHERE tipo='windows'"); 
								while($windows = mysqli_fetch_array($sql)) {
								?>
									<tr>
										<td><?= $windows['id']; ?></td>
										<td><?= $windows['version']; ?></td>
										<td><?= formatSizeUnits(filesize("uploads/" .$windows['file'])); ?></td>
										<td>
										<form method="post" action="index.php">
										<input type="hidden" name="file" value="<?= $windows["file"]; ?>">
										<button name="download" class="btn btn-primary">Download</button>
										</form>
										
										</td>
									</tr>
								<? } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /default table -->
									
									
									</div>
									<div class="col-md-6">
									
														<!-- Default table -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Linux</h5>
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Version</th>
										<th>File Size</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<? $sql1 = $mysqli->query("SELECT * FROM arquivos WHERE tipo='linux'"); 
								while($linux = mysqli_fetch_array($sql1)) {
								?>
									<tr>
										<td><?= $linux["id"]; ?></td>
										<td><?= $linux["version"]; ?></td>
										<td><?= formatSizeUnits(filesize("uploads/" .$linux['file'])); ?></td>
										<td>
										<form method="post" action="index.php">
										<input type="hidden" name="file" value="<?= $linux["file"]; ?>">
										<button name="download" class="btn btn-primary">Download</button>
										</form>
										
										</td>
									</tr>
								<? } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /default table -->

									
									
									</div>
									<? } ?>
									</div>
								</div>
								<? if($_SESSION['nivel'] === '1') { ?>
								<div id="container"></div>
								<? } ?>
							</div>
							<!-- /traffic sources -->

						</div>

					</div>
					<!-- /main charts -->
<? include("footer.php"); ?>