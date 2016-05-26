<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Veículos</span>
    <div class="description">Relatório de veículos cadastrados no sistema.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="title">Dados gerais</div>
          </div>
        </div>
        <div class="card-body">
          <?php
          $readveiculo = new ModelVeiculo();
          $readveiculo->getVeiculos(1);

          if ($readveiculo->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Placa</th>
                  <th>Veículo</th>
                  <th>Vagas</th>
                  <th>Status</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Placa</th>
                  <th>Veículo</th>
                  <th>Vagas</th>
                  <th>Status</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readveiculo->getResult() as $regs):
                  $id = $regs['veiculo_placa'];
                  if(($regs['veiculo_poltronas'] - $regs['veiculo_vagas']) <= 0):
                    $vagas = 'Completo';
                  else:
                    $vagas = ($regs['veiculo_poltronas'] - $regs['veiculo_vagas']) . ' vaga(s)';
                  endif;
                  ?>
                  <tr>
                    <td><?= $regs['veiculo_placa']; ?></td>
                    <td><?= $regs['veiculo_marca'] . ' - ' . $regs['veiculo_modelo']; ?></td>
                    <td><?= $vagas; ?></td>
                    <td><?= $regs['veiculo_status'] ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>'; ?></td>
                    <td>
                      <a href="<?= HOME; ?>veiculo/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="veiculo" title="Excluir"><i class="fa fa-minus-circle"></i></button>
                      </td>
                    </tr>
                    <?php
                  endforeach;
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
