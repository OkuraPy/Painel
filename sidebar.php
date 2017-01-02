			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="https://www.gravatar.com/avatar/<?= md5($_SESSION['email']); ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?= $_SESSION['apelido']; ?></span>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="meus_dados.php"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="index.php"><i class="icon-home4"></i> <span>Home</span></a></li>
								<?  if($_SESSION['nivel'] === '1') { ?>
								<li><a href="lista_cadastros.php"><i class="icon-users"></i>Cadastros</a></li>
								<li><a href="lista_downloads.php"><i class="icon-file-download"></i>Downloads</a></li>
								<li><a href="ger_arquivos.php"><i class="icon-copy"></i> <span>Gerenciar Arquivos</span></a></li>
								<li><a href="ger_usuarios.php"><i class="icon-users"></i> <span>Gerenciar Usuários</span></a></li>
								<? } if($_SESSION['nivel'] === '0') { ?>
								<li><a href="meus_dados.php"><i class="icon-user"></i><span>My Account</span></a></li>
								<li><a href="meus_downloads.php"><i class="icon-file-download"></i><span>My Downloads</span></a></li>
								<? } ?>
								<li><a href="logout.php"><i class="icon-exit3"></i> <span>Logout</span></a></li>
								<!-- /main -->
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->
