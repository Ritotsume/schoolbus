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
          $readveiculo->getVeiculos();

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
                  $id = $regs['veiculo_id'];
                  ?>
                  <tr>
                    <td><?= $regs['veiculo_placa']; ?></td>
                    <td><?= $regs['veiculo_marca'] . ' - ' . $regs['veiculo_modelo']; ?></td>
                    <td><?= $regs['veiculo_vagas'] . '/' . $regs['veiculo_poltronas'] . ' vaga(s)'; ?></td>
                    <td><?= $regs['veiculo_status'] ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Desligado</span>'; ?></td>
                    <td>
                      <a href="<?= HOME; ?>veiculo/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="veiculo" title="Inativar/Ativar"><i class="fa fa-minus-circle"></i></button>
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
