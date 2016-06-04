<div class="side-body">
  <div class="page-title">
    <span class="title">Bairros</span>
    <div class="description">Detalhes dos bairros atualmente cadastrados no sistema.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="title">
              <a href="<?= HOME; ?>enderecos/cadastra-bairros" class="btn btn-success btn-lg">Cadastrar Bairros</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php
          $bairros = new ModelEnderecos;
          $bairros->getBairros();

          $del_id = filter_input_array(INPUT_POST, FILTER_DEFAULT);
          if(isset($del_id) && !empty($del_id)):
            $del_bairro = clone $bairros;
            $del_bairro->DeleteBairro($del_id['delete']);
            if($del_bairro->getResult()):
              echo  "<div class='alert alert-success alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong><span class='fa fa-check-circle'></span></strong> Bairro deletado com sucesso.
              </div>";
            else:
              echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao deletar. Este bairro pode estar sendo utilizada.
              </div>";
            endif;
          endif;

          if ($bairros->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Bairro</th>
                  <th>Cidade</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Bairro</th>
                  <th>Cidade</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($bairros->getResult() as $regs):
                  $id = (int) $regs['bairros_id'];
                  ?>
                  <tr>
                    <td><?= $regs['bairros_nome']; ?></td>
                    <td><?= $regs['cidade_nome']; ?></td>
                    <td>
                      <a href="<?= HOME; ?>enderecos/update-bairros/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="submit" class="btn btn-danger delete-reg" name="delete" value="<?= $id; ?>" title="Excluir"><i class="fa fa-minus-circle"></i></button>
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
