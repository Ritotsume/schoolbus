<div id="content-data-escola">
  <article class="itens-table">
    <p class="row">
      <a href="<?= HOME; ?>rota/cadastro" class="btn btn-default">
        <i class="fa fa-plus-circle"></i> Adicionar
      </a>
    </p>
    <?php
    $readrota = new ModelRotas;

    $stat = 1;
    $readrota->getRotas($stat);

    if ($readrota->getRowCount() > 0):
      ?>
      <div class="row text-uppercase bold active-default">
        <span class="col-md-4">Escola</span>
        <span class="col-md-4">Bairro</span>
        <span class="col-md-2">Veículo/Placa</span>
        <span class="col-md-2">Controles</span>
      </div>
      <?php
      foreach ($readrota->getResult() as $regs):
        $id = (int) $regs['rota_id'];
        ?>
        <div class="row">
          <span class="col-md-4"><?= $regs['instituicao_nome']; ?></span>
          <span class="col-md-4"><?= $regs['bairros_nome']; ?></span>
          <span class="col-md-2"><?= $regs['veiculo_placa']; ?></span>
          <span class="col-md-2">
            <span class="col-md-3">
              <i class="fa fa-edit text-primary" onclick="redireciona(this)" title="Editar">
                <span dataStr="<?= HOME . 'index.php?pag=rota&view=update&var=atualizar&del=' . $id; ?>"></span>
              </i>
            </span>
            <span class="col-md-3">
              <i class="fa fa-minus-circle text-danger" onclick="esconder(this, 'rota')" title="Excluir">
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
