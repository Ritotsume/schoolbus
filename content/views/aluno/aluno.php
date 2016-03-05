<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Alunos</span>
    <div class="description">Relatório de alunos cadastrados para utilização do transporte escolar.</div>
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
          $readaluno = new Read();

          $readaluno->Reader('tb_aluno', 'inner join tb_logradouros on '
          . 'tb_aluno.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
          . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
          . ' order by aluno_status asc');

          if ($readaluno->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Aluno</th>
                  <th>Bairro</th>
                  <th>Situação</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Aluno</th>
                  <th>Bairro</th>
                  <th>Situação</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readaluno->getResult() as $regs):
                  $id = (int) $regs['aluno_id'];
                  ?>
                  <tr>
                    <td><?= $regs['aluno_nome'] . ' ' . $regs['aluno_sobrenome']; ?></td>
                    <td><?= $regs['bairros_nome']; ?></td>
                    <td><?= ucfirst($regs['aluno_status']); ?></td>
                    <td>
                      <a href="<?= HOME; ?>aluno/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="aluno" title="Excluir"><i class="fa fa-minus-circle"></i></button>
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
