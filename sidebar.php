<?php
$pageatual = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
?>

<aside class="col-md-3 menu">
	<div class="row area-search">
		<div class="form-group col-md-12">
			<input type="text" name="search_form" class="form-control" placeholder="Pesquisa interna" />
			<button type="button" class="btn-search"><i class="fa fa-search"></i></button>
		</div>
	</div>

	<a href="<?= HOME; ?>home" class="btn btn-default btn-block <?= ($pageatual == 'home') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-home"></i> Home</a>
	<a href="<?= HOME; ?>aluno" class="btn btn-default btn-block <?= ($pageatual == 'aluno') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-users"></i> Cadastrar aluno</a>
	<a href="<?= HOME; ?>escola" class="btn btn-default btn-block <?= ($pageatual == 'escola') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-university"></i> Cadastrar escola</a>
	<a href="<?= HOME; ?>motorista" class="btn btn-default btn-block <?= ($pageatual == 'motorista') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-users"></i> Cadastrar motorista</a>
	<a href="<?= HOME; ?>veiculo" class="btn btn-default btn-block <?= ($pageatual == 'veiculo') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-bus"></i> Cadastrar veículos</a>
	<a href="#relatorios" class="btn btn-default btn-block <?= ($pageatual == 'relatorios') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-bus"></i> Relatórios</a>
</aside>
