<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idMotorista = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);

  // $desc = Conn::getConnection();
  // $datas = $desc->prepare('describe tb_aluno');
  // $datas->setFetchMode(PDO::FETCH_ASSOC);
  // $datas->execute();
  // $checkNull = $datas->fetchAll();
  // if($checkNull[3]['Null'] == 'YES'):
  //   echo '*';
  // else:
  //   echo '-5-';
  // endif;

  // var_dump($checkNull);

  if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
      unset($dados['search_form'], $dados['editar']);
      $upmotorista = new ModelMotorista();

      $upmotorista->ModelUpdate($idMotorista, $dados);
      if ($upmotorista->getResult()):
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

  if (isset($idMotorista) && !empty($idMotorista)):
    $read = new Read();
    $read->Reader('tb_motoristas', 'where motorista_id = :id', "id={$idMotorista}");
    if ($read->getResult()):
      ?>

      <div class="page-title">
        <span class="title">Atualização de dados cadastrais</span>
        <div class="description">Atualizando dados do motorista.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Atenção! Campos com (*) são de preenchimento obrigatório.
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="motorista_nome" class="col-xs-3 control-label">Nome</label>
            <div class="col-xs-5">
              <input type="text" class="form-control" name="motorista_nome" id="motorista_nome" placeholder="Francisco"
              value="<?= isset($dados['motorista_nome']) ? $dados['motorista_nome'] : $read->getResult()[0]['motorista_nome']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="motorista_sobrenome" class="col-xs-3 control-label">Sobrenome</label>
            <div class="col-xs-5">
              <input type="text" class="form-control" name="motorista_sobrenome" id="motorista_sobrenome" placeholder="Silva Xavier"
              value="<?= isset($dados['motorista_sobrenome']) ? $dados['motorista_sobrenome'] : $read->getResult()[0]['motorista_sobrenome']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="motorista_rg" class="col-xs-3 control-label">RG</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" name="motorista_rg" id="motorista_rg" placeholder="123456" required="required"
              value="<?= isset($dados['motorista_rg']) ? $dados['motorista_rg'] : $read->getResult()[0]['motorista_rg']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="aluno_cpf" class="col-xs-3 control-label">CPF</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" name="motorista_cpf" id="motorista_cpf" placeholder="123.456.789-00" required="required"
              value="<?= isset($dados['motorista_cpf']) ? $dados['motorista_cpf'] : $read->getResult()[0]['motorista_cpf']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="tb_logradouros_logradouro_id" class="col-xs-3 control-label">Endereço</label>
            <div class="col-xs-5">
              <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
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
