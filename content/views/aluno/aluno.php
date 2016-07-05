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
          $readaluno = new ModelAluno();

          $readaluno->getAlunos();

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
                    <td><?= $regs['aluno_status'] ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Desligado</span>'; ?></td>
                    <td>
                      <a href="<?= HOME; ?>aluno/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="aluno" title="Ativar/Inativar"><i class="fa fa-minus-circle"></i></button>
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
