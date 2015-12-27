<div id="content-data-escola">
  <article class="itens-table">
    <p class="row">
      <a href="<?= HOME; ?>motorista/cadastro" class="btn btn-default">
        <i class="fa fa-plus-circle"></i> Adicionar
      </a>
    </p>
    <?php
    $readmotorista = new Read();

    $stat = 'ativo';
    $readmotorista->Reader('tb_motoristas', 'inner join tb_logradouros on '
    . 'tb_motoristas.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
    . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
    . ' where motorista_status = :stat', "stat={$stat}");

    if ($readmotorista->getRowCount() > 0):
      ?>
      <div class="row text-uppercase bold active-default">
        <span class="col-md-6">Motorista</span>
        <span class="col-md-4">Bairro</span>
        <span class="col-md-2">Controles</span>
      </div>
      <?php
      foreach ($readmotorista->getResult() as $regs):
        $id = (int) $regs['motorista_id'];
        ?>
        <div class="row">
          <span class="col-md-6"><?= $regs['motorista_nome'] . ' ' . $regs['motorista_sobrenome']; ?></span>
          <span class="col-md-4"><?= $regs['bairros_nome']; ?></span>
          <span class="col-md-2">
            <span class="col-md-3">
              <i class="fa fa-edit text-primary" onclick="redireciona(this)" title="Editar">
                <span dataStr="<?= HOME . 'index.php?pag=motorista&view=update&var=atualizar&del=' . $id; ?>"></span>
              </i>
            </span>
            <span class="col-md-3">
              <i class="fa fa-minus-circle text-danger" onclick="esconder(this, 'motorista')" title="Excluir">
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
