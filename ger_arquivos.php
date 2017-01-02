<?
include("protect.php");
protect();
include("config.php");
include("header.php");

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$versao = $mysqli->real_escape_string($_POST['versao']);
$tipo = $mysqli->real_escape_string($_POST['tipo']);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if(isset($_POST["submit"])) {
    
	if (file_exists($target_file)) {
    $msg = "Arquivo já existe!";
    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
    $msg= '<font color="red">Arquivo não pode ser salvo! Verifique a permissão da pasta uploads</font>';
		// Se tudo estiver ok, salvamos no servidor.
	} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $msg= 'Para baixar o arquivo, use o <a href="download.php?wallet='. basename( $_FILES["fileToUpload"]["name"]). '">Esse link</a>';
		$arquivo = $_FILES["fileToUpload"]["name"];
		$data = date("Y/m/d");
		$sql = "INSERT INTO arquivos (file, data, version,tipo) VALUES ('$arquivo', '$data', '$versao', '$tipo')";
			if ($mysqli->query($sql) === TRUE) {
				$msg= '<font color="green">Arquivo enviado com sucesso!</font>';
			} else {
				$msg= "Error: " . $sql . "<br>" . $mysqli->error;
			}
    } else {
        $msg= "Não foi possível salvar o arquivo, verifique as permissões do servidor.";
    }
	}
	}

		if(isset($_POST["id"])) {
		$id = $mysqli->real_escape_string($_POST['id']);
		$file = $mysqli->real_escape_string($_POST['file']);
		$sql = "DELETE FROM arquivos WHERE id = '$id'";
			if ($mysqli->query($sql) === TRUE) {
				$msg= '<font color="green">Arquivo deletado com sucesso!</font>';
				unlink("uploads/". $file);
			} else {
				$msg= "Error: " . $sql . "<br>" . $mysqli->error;
			}
		}

	?>

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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Gerenciar</span> - Arquivos</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Gerênciar Arquivos</li>
						</ul>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Bootstrap file input -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Gerenciamento de Arquivos para Download</h5>
						</div>

						<div class="panel-body">
							<p class="content-group">Use o formulário abaixo para enviar novas carteiras e gerar o link para download.<br><br><? if(!empty($msg)) { echo $msg; } ?></p>

							<form action="ger_arquivos.php" method="post" enctype="multipart/form-data">
								
								<fieldset class="content-group">

									<div class="form-group">
										<label class="control-label col-lg-2">Arquivo</label>
										<div class="col-lg-10">
											<input type="file" name="fileToUpload" class="file-styled">
										</div>

									<label class="col-lg-2 control-label text-semibold">Versão:</label>
									<div class="col-lg-10">
										
									<input type="text" name="versao" class="form-control" value="">
									
									</div>								

									<label class="col-lg-2 control-label text-semibold">Tipo:</label>
									<div class="col-lg-10">
										
									<select name="tipo" class="form-control">
				                                <option value="">Selecione o tipo</option>
				                                <option value="windows">Windows</option>
				                                <option value="linux">Linux</option>
				                                
				                            </select>
									
									</div>
									<div class="text-right"><br>
									<button type="submit" name="submit" class="btn btn-primary">Enviar <i class="icon-arrow-up7 position-right"></i></button>
								</div>
									
								</div>
								</fieldset>
							</form>
						</div>
					</div>
					
									<!-- Basic table -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Arquivos enviados</h5>
						</div>

						<div class="table-responsive">
						<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Data</th>
										<th>Arquivo</th>
										<th>Versão</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
								<? $sql = $mysqli->query("SELECT * FROM arquivos"); 
								while($arquivos = mysqli_fetch_array($sql)) {
								?>
									<tr>
										<td><?= $arquivos["id"]; ?></td>
										<td><?= $arquivos["data"]; ?></td>
										<td><?= $arquivos["file"]; ?></td>
										<td><?= $arquivos["version"]; ?></td>
								<td><form action="ger_arquivos.php" method="post"><input type="hidden" name="file" value="<?= $arquivos["file"]; ?>"><input type="hidden" name="id" value="<?= $arquivos["id"]; ?>"><button class="btn btn-primary" type="submit">Excluir</button></form></td>
									</tr>
								<? } ?>
								</tbody>
							</table>
							</div>
					</div>
					<!-- /basic table -->
	
				
				
				</div>
					<!-- /bootstrap file input -->
<? include("footer.php"); ?>