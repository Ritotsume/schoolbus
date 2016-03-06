<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);
$param = filter_input(INPUT_GET, 'del', FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
  if (isset($dados['editar'])):
    unset($dados['search_form'], $dados['editar'], $dados['telefone']);
    $uprota = new ModelRotas();

    $uprota->ModelUpdate($param, $dados);
    if ($uprota->getResult()):
      ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
    else:
      ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
    endif;
  endif;
endif;

if (isset($param) && !empty($param)):
  if (isset($varcheck) && $varcheck == 'atualizar'):
    $readrota = new ModelRotas();
    $readrota->getRotas();
    if ($readrota->getResult()):
      ?>

      <div class="row">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="tb_instituicoes_instituicao_id">Escolas</label>
            <select class="form-control" name="tb_instituicoes_instituicao_id" id="tb_instituicoes_instituicao_id">
              <?php
              $read = new Read();
              $stat = 'ativo';
              $read->Reader('tb_instituicoes', 'where instituicao_status = :stat', "stat={$stat}");
              if ($read->getResult()):
                foreach ($read->getResult() as $escolas):
                  if($escolas['instituicao_id'] == $readrota->getResult()[0]['tb_instituicoes_instituicao_id']):
                    echo "<option value=\"{$escolas['instituicao_id']}\" selected=\"selected\">{$escolas['instituicao_nome']}</option>";
                  else:
                    echo "<option value=\"{$escolas['instituicao_id']}\">{$escolas['instituicao_nome']}</option>";
                  endif;
                endforeach;
              endif;
              ?>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="tb_logradouros_logradouro_id">Logradouros</label><br />
            <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
              <?php
              $read->Reader('tb_logradouros', 'inner join tb_bairros on '
              . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
              if ($read->getRowCount() > 0):
                foreach ($read->getResult() as $options):
                  if($options['logradouro_id'] == $readrota->getResult()[0]['logradouro_id']):
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

        <div class="row">
          <div class="form-group col-md-6">
            <label for="tb_veiculos_veiculo_placa">Veículos</label><br />
            <select class="form-control" name="tb_veiculos_veiculo_placa" id="tb_veiculos_veiculo_placa">
              <?php
              $read->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");
              if ($read->getResult()):
                foreach ($read->getResult() as $veiculos):
                  $description = $veiculos['veiculo_marca'] . ' - ' . $veiculos['veiculo_modelo'];
                  if($veiculos['veiculo_placa'] == $readrota->getResult()[0]['tb_veiculos_veiculo_placa']):
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
      </div>
      <?php
    else:
      ADSError('Não foram encontrados dados relacionados...', CRAZY_INFOR);
    endif;
  else:
    ADSError('Parametro var nao encontrado..', CRAZY_INFOR);
  endif;
else:
  ADSError('Parametro del nao encontrado', CRAZY_INFOR);
endif;
