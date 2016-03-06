<div id="content-data-escola">
  <article class="itens-table">
    <p class="row">
      <a href="<?= HOME; ?>veiculo/cadastro" class="btn btn-default">
        <i class="fa fa-plus-circle"></i> Adicionar
      </a>
    </p>
    <?php
    $readveiculo = new Read();

    $stat = 'ativo';
    $readveiculo->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");

    if ($readveiculo->getRowCount() > 0):
      ?>
      <div class="row text-uppercase bold active-default">
        <span class="col-md-3">Placa</span>
        <span class="col-md-4">Veículo</span>
        <span class="col-md-2">Vagas</span>
        <span class="col-md-2">Controles</span>
      </div>
      <?php
      foreach ($readveiculo->getResult() as $regs):
        if($regs['veiculo_poltronas'] - $regs['veiculo_vagas'] <= 0):
          $vagas = 'Completo';
        else:
          $vagas =  ($regs['veiculo_poltronas'] - $regs['veiculo_vagas']) . ' vaga(s)';
        endif;
        ?>
        <div class="row">
          <span class="col-md-3"><?= $regs['veiculo_placa']; ?></span>
          <span class="col-md-4"><?= $regs['veiculo_marca'] . ' - ' . $regs['veiculo_modelo']; ?></span>
          <span class="col-md-2"><?= $vagas; ?></span>
          <span class="col-md-2">
            <span class="col-md-3">
              <i class="fa fa-edit text-primary" onclick="redireciona(this)" title="Editar">
                <span dataStr="<?= HOME . 'index.php?pag=veiculo&view=update&var=atualizar&del=' . $regs['veiculo_placa']; ?>"></span>
              </i>
            </span>
            <span class="col-md-3">
              <i class="fa fa-minus-circle text-danger" onclick="esconder(this, 'veiculo')" title="Excluir">
                <span dataStr="<?= 'var=delete&del=' . $regs['veiculo_placa']; ?>"></span>
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
