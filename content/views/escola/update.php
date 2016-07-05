<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idEscola = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);

  if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
      unset($dados['search_form'], $dados['editar'], $dados['telefone']);
      $upescola = new ModelInstituicao();

      $upescola->ModelUpdate($idEscola, $dados);
      if ($upescola->getResult()):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Dados atualizados com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Aconteceram erros, portanto, nenhum dado foi atualizado.
        </div>";
      endif;
    endif;
  endif;

  if (isset($idEscola) && !empty($idEscola)):
    $read = new ModelInstituicao;
    $read->getInstituicao($idEscola);
    if ($read->getResult()):
      ?>
      <div class="page-title">
        <span class="title">Atualização de dados cadastrais</span>
        <div class="description">Atualizando dados da escola.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Atenção! Campos com (*) são de preenchimento obrigatório.
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="instituicao_nome" class="col-xs-3 control-label">Nome*</label>
            <div class="col-xs-6">
              <input type="text" class="form-control" name="instituicao_nome" id="instituicao_nome" placeholder="Nome da escola"
              value="<?= isset($dados['instituicao_nome']) ? $dados['instituicao_nome'] : $read->getResult()[0]['instituicao_nome']; ?>" required="required" />
            </div>
          </div>

          <div class="form-group">
            <label for="instituicao_razao" class="col-xs-3 control-label">Razão*</label>
            <div class="col-xs-6">
              <input type="text" class="form-control" name="instituicao_razao" id="instituicao_razao" placeholder="Razão Social da escola"
              value="<?= isset($dados['instituicao_razao']) ? $dados['instituicao_razao'] : $read->getResult()[0]['instituicao_razao']; ?>" required="required" />
            </div>
          </div>

          <div class="form-group">
            <label for="instituicao_cnpj" class="col-xs-3 control-label">CNPJ*</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" name="instituicao_cnpj" id="instituicao_cnpj" placeholder="CNPJ da escola" required="required"
              value="<?= isset($dados['instituicao_cnpj']) ? $dados['instituicao_cnpj'] : $read->getResult()[0]['instituicao_cnpj']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="instituicao_tel" class="col-md-3 control-label">Telefone</label>
            <div class="col-md-2">
              <input type="tel" class="form-control" name="instituicao_tel" id="instituicao_tel" placeholder="Telefone"
              value="<?= isset($dados['instituicao_tel']) ? $dados['instituicao_tel'] : $read->getResult()[0]['instituicao_tel']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="instituicao_cel" class="col-md-3 control-label">Celular</label>
            <div class="col-md-2">
              <input type="tel" class="form-control" name="instituicao_cel" id="instituicao_cel" placeholder="Celular"
              value="<?= isset($dados['instituicao_cel']) ? $dados['instituicao_cel'] : $read->getResult()[0]['instituicao_cel']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="instituicao_email" class="col-xs-3 control-label">Email</label>
            <div class="col-xs-5">
              <input type="email" class="form-control" name="instituicao_email" id="instituicao_email" placeholder="Email da escola"
              value="<?= isset($dados['instituicao_email']) ? $dados['instituicao_email'] : $read->getResult()[0]['instituicao_email']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="tb_logradouros_logradouro_id" class="col-xs-3 control-label">Endereço*</label>
            <div class="col-xs-5">
              <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id" required="required">
                <?php
                $readerlog = new Read;
                $readerlog->Reader('tb_logradouros', 'inner join tb_bairros on '
                . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
                if ($readerlog->getRowCount() > 0):
                  foreach ($readerlog->getResult() as $options):
                    if (($options['logradouro_id'] == $dados['tb_logradouros_logradouro_id']) ||
                    ($options['logradouro_id'] == $read->getResult()[0]['tb_logradouros_logradouro_id'])):
                    echo "<option value=\"{$options['logradouro_id']}\" selected=\"selected\">{$options['logradouro_nome']} -- "
                    . "{$options['bairros_nome']}</option>";
                  else:
                    echo "<option value=\"{$options['logradouro_id']}\">{$options['logradouro_nome']} -- "
                    . "{$options['bairros_nome']}</option>";
                  endif;
                endforeach;
              endif;
              ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_end_numero" class="col-xs-3 control-label">Número</label>
          <div class="col-xs-2">
            <input type="text" class="form-control" name="instituicao_numero" id="instituicao_numero" placeholder="Número do prédio ou casa"
            value="<?= isset($dados['instituicao_numero']) ? $dados['instituicao_numero'] : $read->getResult()[0]['instituicao_numero']; ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="instituicao_diretor" class="col-xs-3 control-label">Diretor</label>
          <div class="col-xs-5">
            <input type="text" class="form-control" name="instituicao_diretor" id="instituicao_diretor" placeholder="Diretor da escola"
            value="<?= isset($dados['instituicao_diretor']) ? $dados['instituicao_diretor'] : $read->getResult()[0]['instituicao_diretor']; ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="" class="col-xs-3"></label>
          <div class="col-xs-2">
            <button type="submit" class="btn btn-success btn-block" name="editar"><i class="fa fa-download"></i> Atualizar</button>
          </div>
        </div>
        <?php
      else:
        ADSError('Não foram encontrados dados relacionados...', CRAZY_INFOR);
      endif;
    else:
      ADSError('Parametro del nao encontrado', CRAZY_INFOR);
    endif;
    ?>
  </div>
</div>
</div>
