<? 

include("config.php");
include("protect.php");
protect();
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
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Relatórios</span> - Usuários Cadastrados</h4>
						</div>

					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Relatório de Usuários</li>
						</ul>
		'			</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Basic table -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Lista de Usuários</h5>
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Cadastrado em</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
								<? $sql = $mysqli->query("SELECT * FROM usuario"); 
								while($arquivos = mysqli_fetch_array($sql)) {
								?>
									<tr>
										<td><?= $arquivos["codigo"]; ?></td>
										<td><?= $arquivos["registro"]; ?></td>
										<td><?= $arquivos["email"]; ?></td>
									</tr>
								<? } ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /basic table -->
				</div>
<? include("footer.php"); ?>