<div class="side-menu sidebar-inverse">
	<nav class="navbar navbar-default" role="navigation">
		<div class="side-menu-container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					<div class="icon fa fa-bus"></div>
					<div class="title">SchoolBus</div>
				</a>
				<button type="button" class="navbar-expand-toggle pull-right visible-xs">
					<i class="fa fa-times icon"></i>
				</button>
			</div>
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="<?= HOME; ?>home">
						<span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
					</a>
				</li>
				<li class="panel panel-default dropdown">
					<a data-toggle="collapse" href="#dropdown-entries">
						<span class="icon fa fa-archive"></span><span class="title">Cadastros</span>
					</a>
					<!-- Dropdown level 1 -->
					<div id="dropdown-entries" class="panel-collapse collapse">
						<div class="panel-body">
							<ul class="nav navbar-nav">
								<li>
									<a href="<?= HOME; ?>aluno/cadastra"><span class="icon fa fa-group"></span> Alunos</a>
								</li>
								<li>
									<a href="<?= HOME; ?>escola/cadastra"><span class="icon fa fa-university"></span> Escolas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>motorista/cadastra"><span class="icon fa fa-user"></span> Motoristas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>rota/cadastra"><span class="icon fa fa-map-signs"></span> Rotas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>veiculo/cadastra"><span class="icon fa fa-bus"></span> Veículos</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li class="panel panel-default dropdown">
					<a data-toggle="collapse" href="#dropdown-controls">
						<span class="icon fa fa-tasks"></span><span class="title">Controle</span>
					</a>
					<!-- Dropdown level 1 -->
					<div id="dropdown-controls" class="panel-collapse collapse">
						<div class="panel-body">
							<ul class="nav navbar-nav">
								<li>
									<a href="<?= HOME; ?>aluno"><span class="icon fa fa-group"></span> Alunos</a>
								</li>
								<li>
									<a href="<?= HOME; ?>escola"><span class="icon fa fa-university"></span> Escolas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>motorista"><span class="icon fa fa-user"></span> Motoristas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>rota"><span class="icon fa fa-map-signs"></span> Rotas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>veiculo"><span class="icon fa fa-bus"></span> Veículos</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li class="panel panel-default dropdown">
					<a data-toggle="collapse" href="#dropdown-graphs">
						<span class="icon fa fa-area-chart"></span><span class="title">Gráficos</span>
					</a>
					<!-- Dropdown level 1 -->
					<div id="dropdown-graphs" class="panel-collapse collapse">
						<div class="panel-body">
							<ul class="nav navbar-nav">
								<li>
									<a href="<?= HOME; ?>aluno"><span class="icon fa fa-group"></span> Alunos</a>
								</li>
								<li>
									<a href="<?= HOME; ?>escola"><span class="icon fa fa-university"></span> Escolas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>motorista"><span class="icon fa fa-user"></span> Motoristas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>rota"><span class="icon fa fa-map-signs"></span> Rotas</a>
								</li>
								<li>
									<a href="<?= HOME; ?>veiculo"><span class="icon fa fa-bus"></span> Veículos</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li>
					<a href="license.html">
						<span class="icon fa fa-thumbs-o-up"></span><span class="title">License</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>
</div>
