<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Escolas</span>
    <div class="description">Relatório de escolas cadastradas no sistema.</div>
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
          $readescola = new Read();

          $stat = 'ativo';
          $readescola->Reader('tb_instituicoes', 'inner join tb_logradouros on '
          . 'tb_instituicoes.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
          . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
          . ' where instituicao_status = :stat', "stat={$stat}");

          if ($readescola->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Instituição</th>
                  <th>Bairro</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Instituição</th>
                  <th>Bairro</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readescola->getResult() as $regs):
                  $id = (int) $regs['instituicao_id'];
                  ?>
                  <tr>
                    <td><?= $regs['instituicao_nome']; ?></td>
                    <td><?= $regs['bairros_nome']; ?></td>
                    <td>
                      <a href="<?= HOME; ?>escola/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="escola" title="Excluir"><i class="fa fa-minus-circle"></i></button>
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
