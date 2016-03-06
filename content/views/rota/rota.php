<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Rotas</span>
    <div class="description">Relatório de rotas cadastradas no sistema.</div>
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
          $readrota = new ModelRotas;

          $stat = 1;
          $readrota->getRotas($stat);

          if ($readrota->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Escola</th>
                  <th>Bairro</th>
                  <th>Veículo/Placa</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Escola</th>
                  <th>Bairro</th>
                  <th>Veículo/Placa</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readrota->getResult() as $regs):
                  $id = (int) $regs['rota_id'];
                  ?>
                  <tr>
                    <td><?= $regs['instituicao_nome']; ?></td>
                    <td><?= $regs['bairros_nome']; ?></td>
                    <td><?= $regs['veiculo_placa']; ?></td>
                    <td>
                      <a href="<?= HOME; ?>rota/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="rota" title="Excluir"><i class="fa fa-minus-circle"></i></button>
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
