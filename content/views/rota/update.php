<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idRota = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
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
      unset($dados['search_form'], $dados['editar'], $dados['telefone']);
      $uprota = new ModelRotas();

      $uprota->ModelUpdate($idRota, $dados);
      if ($uprota->getResult()):
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

  if (isset($idRota) && !empty($idRota)):
    $readrota = new ModelRotas();
    $readrota->getRotas();
    if ($readrota->getResult()):
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
            <label for="tb_instituicoes_instituicao_id" class="col-xs-3 control-label">Escolas</label>
            <div class="col-xs-5">
              <select class="form-control" name="tb_instituicoes_instituicao_id" id="tb_instituicoes_instituicao_id">
                <?php
                $read = new Read();
                $stat = 'ativo';
                $read->Reader('tb_instituicoes', 'where instituicao_status = :stat', "stat={$stat}");
                if ($read->getResult()):
                  foreach ($read->getResult() as $escolas):
                    if(($escolas['instituicao_id'] == $dados['tb_instituicoes_instituicao_id']) ||
                    ($escolas['instituicao_id'] == $readrota->getResult()[0]['tb_instituicoes_instituicao_id'])):
                      echo "<option value=\"{$escolas['instituicao_id']}\" selected=\"selected\">{$escolas['instituicao_nome']}</option>";
                    else:
                      echo "<option value=\"{$escolas['instituicao_id']}\">{$escolas['instituicao_nome']}</option>";
                    endif;
                  endforeach;
                endif;
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="tb_logradouros_logradouro_id" class="col-xs-3 control-label">Logradouros</label>
            <div class="col-xs-5">
              <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
                <?php
                $read->Reader('tb_logradouros', 'inner join tb_bairros on '
                . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
                if ($read->getRowCount() > 0):
                  foreach ($read->getResult() as $options):
                    if(($options['logradouro_id'] == $dados['tb_logradouros_logradouro_id']) ||
                    ($options['logradouro_id'] == $readrota->getResult()[0]['logradouro_id'])):
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
            <label for="tb_veiculos_veiculo_placa" class="col-xs-3 control-label">Veículos</label>
            <div class="col-xs-5">
              <select class="form-control" name="tb_veiculos_veiculo_placa" id="tb_veiculos_veiculo_placa">
                <?php
                $read->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");
                if ($read->getResult()):
                  foreach ($read->getResult() as $veiculos):
                    $description = $veiculos['veiculo_marca'] . ' - ' . $veiculos['veiculo_modelo'];
                    if(($veiculos['veiculo_placa'] == $dados['tb_veiculos_veiculo_placa']) ||
                    ($veiculos['veiculo_placa'] == $readrota->getResult()[0]['tb_veiculos_veiculo_placa'])):
                      echo "<option value=\"{$veiculos['veiculo_placa']}\" selected=\"selected\">{$description}</option>";
                    else:
                      echo "<option value=\"{$veiculos['veiculo_placa']}\">{$description}</option>";
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
