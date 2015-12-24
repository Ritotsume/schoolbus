<div id="content-data-escola">
  <article class="itens-table">
    <p class="row">
      <a href="<?= HOME; ?>aluno/cadastro" class="btn btn-default">
        <i class="fa fa-plus-circle"></i> Adicionar
      </a>
    </p>

    <?php
    $readaluno = new Read();

    $readaluno->Reader('tb_aluno', 'inner join tb_logradouros on '
    . 'tb_aluno.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
    . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
    . ' order by aluno_status asc');

    if ($readaluno->getRowCount() > 0):
      ?>
      <div class="row text-uppercase bold active-default">
        <span class="col-md-6">Aluno</span>
        <span class="col-md-2">Bairro</span>
        <span class="col-md-2">Situação</span>
        <span class="col-md-2">Controles</span>
      </div>
      <?php
      foreach ($readaluno->getResult() as $regs):
        $id = (int) $regs['aluno_id'];
        ?>
        <div class="row">
          <span class="col-md-6"><?= $regs['aluno_nome'] . ' ' . $regs['aluno_sobrenome']; ?></span>
          <span class="col-md-2"><?= $regs['bairros_nome']; ?></span>
          <span class="col-md-2"><?= ucfirst($regs['aluno_status']); ?></span>
          <span class="col-md-2">
            <span class="col-md-6">
              <i class="fa fa-edit text-primary" onclick="redireciona(this)" title="Editar">
                <span dataStr="<?= HOME . 'index.php?pag=aluno&view=update&var=atualizar&del=' . $id; ?>"></span>
              </i>
            </span>
            <span class="col-md-6">
              <i class="fa fa-minus-circle text-danger" onclick="esconder(this, 'aluno')" title="Excluir">
                <span dataStr="<?= 'var=delete&del=' . $id; ?>"></span>
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
