<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Motoristas</span>
    <div class="description">Relatório de motoristas cadastrados no sistema.</div>
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
          $readmotorista = new ModelMotorista();
          $readmotorista->getMotoristas(1);

          if ($readmotorista->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Motorista</th>
                  <th>Bairro</th>
                  <th>Status</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Motorista</th>
                  <th>Bairro</th>
                  <th>Status</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readmotorista->getResult() as $regs):
                  $id = (int) $regs['motorista_id'];
                  ?>
                  <tr>
                    <td><?= $regs['motorista_nome'] . ' ' . $regs['motorista_sobrenome']; ?></td>
                    <td><?= $regs['bairros_nome']; ?></td>
                    <td><?= $regs['motorista_status'] ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>'; ?></td>
                    <td>
                      <a href="<?= HOME; ?>motorista/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="motorista" title="Excluir"><i class="fa fa-minus-circle"></i></button>
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
