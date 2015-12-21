<div id="content-data-escola">
  <article class="itens-table">
    <p class="row">
      <a href="<?= HOME; ?>escola/cadastro" class="btn btn-default">
        <i class="fa fa-plus-circle"></i> Adicionar
      </a>
    </p>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && !empty($dados)):
      if (isset($dados['editar'])):

        $upescola = new ModelInstituicao();

        $param = $dados['instituicao_id'];
        unset($dados['search_form'], $dados['editar'], $dados['telefone'], $dados['instituicao_id']);

        $upescola->ModelUpdate($param, $dados);
        if ($upescola->getResult()):
          ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
        else:
          ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
        endif;
      endif;
    endif;

    $readescola = new Read();

    $stat = 'ativo';
    $readescola->Reader('tb_instituicoes', 'inner join tb_logradouros on '
    . 'tb_instituicoes.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
    . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
    . ' where instituicao_status = :stat', "stat={$stat}");

    if ($readescola->getRowCount() > 0):
      ?>
      <div class="row text-uppercase bold active-default">
        <span class="col-md-6">Instituição</span>
        <span class="col-md-4">Bairro</span>
        <span class="col-md-2">Controles</span>
      </div>
      <?php
      foreach ($readescola->getResult() as $regs):
        $id = (int) $regs['instituicao_id'];
        ?>
        <div class="row">
          <span class="col-md-6"><?= $regs['instituicao_nome']; ?></span>
          <span class="col-md-4"><?= $regs['bairros_nome']; ?></span>
          <span class="col-md-2">
            <span class="col-md-6">
              <i class="fa fa-edit text-primary text-primary" onclick="redireciona(this)" title="Editar">
                <span dataStr="<?= HOME . 'index.php?pag=escola&view=update&var=atualizar&del=' . $regs['instituicao_id']; ?>"></span>
              </i>
            </span>
            <span class="col-md-6">
              <i class="fa fa-minus-circle text-danger" onclick="esconder(this, 'escola')" title="Excluir">
                <span dataStr="<?= 'var=delete&del=' . $regs['instituicao_id']; ?>"></span>
              </i>
            </span>
          </span>
        </div>
        <?php
      endforeach;
    endif;
    ?>
  </article>
</div>
