<?php
$pageatual = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

if(isset($pageatual) && !empty($pageatual) && $pageatual != 'home'):
	$in = ' in';
else:
	$in = '';
endif;
?>

<aside class="col-md-3 menu">
	<div class="row area-search">
		<div class="form-group col-md-12">
			<input type="text" name="search_form" class="form-control" placeholder="Pesquisa interna" />
			<button type="button" class="btn-search"><i class="fa fa-search"></i></button>
		</div>
	</div>

	<a href="<?= HOME; ?>home" class="btn btn-default btn-block <?= ($pageatual == 'home') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-home"></i> Home</a>

	<a href="#colCadastro" class="btn btn-default btn-block" data-toggle="collapse"
	data-parent="#accordion" aria-expanded="true" aria-controls="colCadastro">
	<i class="fa fa-database"></i> Cadastros
</a>

<div id="colCadastro" class="panel-collapse collapse<?= $in; ?>" role="tabpanel" aria-labelledby="headingOne">
	<a href="<?= HOME; ?>aluno" class="btn btn-default btn-block <?= ($pageatual == 'aluno') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-graduation-cap"></i> Cadastrar aluno</a>
	<a href="<?= HOME; ?>escola" class="btn btn-default btn-block <?= ($pageatual == 'escola') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-university"></i> Cadastrar escola</a>
	<a href="<?= HOME; ?>motorista" class="btn btn-default btn-block <?= ($pageatual == 'motorista') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-users"></i> Cadastrar motorista</a>
	<a href="<?= HOME; ?>veiculo" class="btn btn-default btn-block <?= ($pageatual == 'veiculo') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-bus"></i> Cadastrar veículos</a>
	<a href="<?= HOME; ?>rota" class="btn btn-default btn-block <?= ($pageatual == 'rota') ? 'bold active-default' : ''; ?>" role="button"><i class="fa fa-map-signs"></i> Cadastrar rotas</a>
</div>

<a href="#relatorios" class="btn btn-default btn-block <?= ($pageatual == 'relatorios') ? 'bold active-default' : ''; ?>" role="button" onclick="modals('Teste modal', 'Apenas um teste. Nada demais...')"><i class="fa fa-bus"></i> Relatórios</a>
<a href="#" class="btn btn-default btn-block" onclick="toggleTheme()" role="button"><i class="fa fa-bus"></i> Mudar tema</a>
</aside>
