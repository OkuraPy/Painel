<?
include("protect.php");
protect();
include("config.php");
include("header.php");

if(!empty($_POST['codigo'])) {
	
	 // get User ID
    $user_id = $mysqli->real_escape_string($_POST['codigo']);
 
    // Get User Details
    $query = "SELECT * FROM usuario WHERE id = '$user_id'";
    if (!$result = mysqli_query($mysqli, $query)) {
        exit(mysqli_error($mysqli));
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}

if(isset($_POST["id"])) {
		$id = $mysqli->real_escape_string($_POST['id']);
		$sql = "DELETE FROM usuario WHERE codigo = '$id'";
			if ($mysqli->query($sql) === TRUE) {
				$msg= '<font color="green">Usuário deletado com sucesso!</font>';
			} else {
				$msg= "Error: " . $sql . "<br>" . $mysqli->error;
			}
		}


if(!empty($_POST['nome'] || $_POST['email'] || $_POST['senha'] || $_POST['senha2'])) {
	
	if($_POST['senha'] === $_POST['senha2']) {

	$apelido = $mysqli->real_escape_string($_POST['nome']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$senha = md5(md5($mysqli->real_escape_string($_POST['senha'])));
	$tipo = $mysqli->real_escape_string($_POST['tipo']);
	$n_user = "INSERT INTO usuario(email,senha,apelido, tipo) VALUES ('$email', '$senha', '$apelido', '$tipo')";
	
	if ($mysqli->query($n_user) === TRUE) {
				$msg= '<font color="green">Usuário cadastrado com sucesso!</font>';
			} else {
				$msg= "Erro: " . $n_user . "<br>" . $mysqli->error;
			}
	} else {
		$msg= '<font color="red">Senhas não conferem!</font>';
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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Gerenciar</span> - Usuários</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Gerênciar Usuários</li>
						</ul>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					
					<!-- Bootstrap file input -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Gerenciamento de Usuários</h5>
						</div>

						<div class="panel-body">
							<p class="content-group">Use o formulário abaixo para adicionar um novo usuário do sistema.<br><br><? if(!empty($msg)) { echo $msg; } ?></p>

							<form action="ger_usuarios.php" method="post">
							
								<fieldset class="content-group">

									<div class="form-group">
										<label class="control-label col-lg-2">Nome do Usuário:</label>
										<div class="col-lg-10">
											<input type="text" name="nome" class="form-control" value="">
										</div>

									<label class="col-lg-2 control-label text-semibold">Email:</label>
									<div class="col-lg-10">
										
									<input type="text" name="email" class="form-control" value="">
									
									</div>

									<label class="col-lg-2 control-label text-semibold">Senha:</label>
									<div class="col-lg-10">
										
									<input type="password" name="senha" class="form-control" value="">
									
									</div>
									<label class="col-lg-2 control-label text-semibold">Confirme a Senha:</label>
									<div class="col-lg-10">
										
									<input type="password" name="senha2" class="form-control" value="">
									
									</div>																		

									<label class="col-lg-2 control-label text-semibold">Tipo:</label>
									<div class="col-lg-10">
										
									<select name="tipo" class="form-control">
				                                <option value="">Selecione o tipo</option>
				                                <option value="0">Usuário</option>
				                                <option value="1">Administrador</option>
				                                
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
							<h5 class="panel-title">Usuários Cadastrados</h5>
						</div>

						<div class="table-responsive">
						<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Registrado em</th>
										<th>Email</th>
										<th>Apelido</th>
										<th>Telefone</th>
										<th>Ações</th>
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
										<td><?= $arquivos["apelido"]; ?></td>
										<td><?= $arquivos["telefone"]; ?></td>
										<td><button onclick="GetUserDetails('.$arquivos['codigo'].')" class="btn btn-primary">Editar</button>
										<form action="ger_usuarios.php" method="post"><input type="hidden" name="id" value="<?= $arquivos["codigo"]; ?>"><button class="btn btn-primary" type="submit">Excluir</button></form>
										</td>
									</tr>
								<? } ?>
								</tbody>
							</table>
							</div>
					</div>
					<!-- /basic table -->
	
					<div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
										<h4 class="modal-title" id="myModalLabel">Alterar Usuário</h4>
									</div>
							<div class="modal-body">
							
							<fieldset class="content-group">

									<div class="form-group">
									<label>Nome do Usuário:</label>
									<input type="text" name="update_nome" id="update_nome" class="form-control" value="">
									<label>Email:</label>
									<input type="text" name="email" id="email" class="form-control" value="">
									<label class="col-lg-2 control-label text-semibold">Tipo:</label>
									<select name="tipo" id="tipo" class="form-control">
				                                <option value="">Selecione o tipo</option>
				                                <option value="0">Usuário</option>
				                                <option value="1">Administrador</option>
				                                
				                            </select>							
								</div>
							</fieldset>
							
							
							
							</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
							</div>
						</div>
					</div>

				
				</div>
<script>
function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $.post("ger_usuarios.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_nome").val(user.nome);
            $("#update_email").val(user.email);
            $("#update_tipo").val(user.tipo);
        }
    );
    // Open modal popup
    $("GSCCModal").modal("show");
}
function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();
 
    // get hidden field value
    var id = $("#hidden_user_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}
</script>
					<!-- /bootstrap file input -->
<? include("footer.php"); ?>