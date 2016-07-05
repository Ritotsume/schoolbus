<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idAluno = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);

  if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
      unset($dados['search_form'], $dados['editar']);
      $upaluno = new ModelAluno();

      $upaluno->ModelUpdate($idAluno, $dados);
      if ($upaluno->getResult()):
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

  if (isset($idAluno) && !empty($idAluno)):
    $read = new ModelAluno;
    $read->getAluno($idAluno);
    if ($read->getResult()):
      ?>

      <!-- <div class="row"> -->
      <div class="page-title">
        <span class="title">Atualização de dados cadastrais</span>
        <div class="description">Atualizando dados do aluno.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Atenção! Campos com (*) são de preenchimento obrigatório.
          </div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <label for="aluno_nome" class="col-xs-3 control-label">Nome*</label>
            <div class="col-xs-5">
              <input type="text" class="form-control" name="aluno_nome" id="aluno_nome" placeholder="Nome do aluno"
              value="<?= isset($dados['aluno_nome']) ? $dados['aluno_nome'] : $read->getResult()[0]['aluno_nome']; ?>" required="required" />
            </div>
          </div>

          <div class="form-group">
            <label for="aluno_sobrenome" class="col-xs-3 control-label">Sobrenome*</label>
            <div class="col-xs-5">
              <input type="text" class="form-control" name="aluno_sobrenome" id="aluno_sobrenome" placeholder="Sobrenome do aluno"
              value="<?= isset($dados['aluno_sobrenome']) ? $dados['aluno_sobrenome'] : $read->getResult()[0]['aluno_sobrenome']; ?>" required="required" />
            </div>
          </div>

          <div class="form-group">
            <label for="aluno_cpf" class="col-xs-3 control-label">CPF*</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" name="aluno_cpf" id="aluno_cpf" placeholder="CPF do aluno" required="required"
              value="<?= isset($dados['aluno_cpf']) ? $dados['aluno_cpf'] : $read->getResult()[0]['aluno_cpf']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="aluno_nascimento" class="col-xs-3 control-label">Nascimento*</label>
            <div class="col-xs-4">
              <input type="date" class="form-control" name="aluno_nascimento" id="aluno_nascimento" placeholder="Data de nascimento" required="required"
              value="<?= isset($dados['aluno_nascimento']) ? $dados['aluno_nascimento'] : date('d/m/Y', strtotime($read->getResult()[0]['aluno_nascimento'])); ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="tb_instituicoes_instituicao_id" class="col-md-3 control-label">Escola*</label>
            <div class="col-md-4">
              <select class="form-control" name="tb_instituicoes_instituicao_id" id="tb_instituicoes_instituicao_id" required="required">
                <option value="">Selecione...</option>
                <?php
                $instituicoes = new ModelInstituicao();
                $instituicoes->getInstituicoes();
                if ($instituicoes->getRowCount() > 0):
                  foreach ($instituicoes->getResult() as $instituicao):
                    if (($instituicao['instituicao_id'] == $dados['tb_instituicoes_instituicao_id']) ||
                    ($instituicao['instituicao_id'] == $read->getResult()[0]['tb_instituicoes_instituicao_id'])):
                    echo "<option value=\"{$instituicao['instituicao_id']}\" selected=\"selected\">{$instituicao['instituicao_nome']}</option>";
                  else:
                    echo "<option value=\"{$instituicao['instituicao_id']}\">{$instituicao['instituicao_nome']}</option>";
                  endif;
                endforeach;
              endif;
              ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_serie" class="col-xs-3 control-label">Serie*</label>
          <div class="col-xs-2">
            <input type="text" class="form-control" name="aluno_serie" id="aluno_serie" placeholder="Série" required="required"
            value="<?= isset($dados['aluno_serie']) ? $dados['aluno_serie'] : $read->getResult()[0]['aluno_serie']; ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_turno" class="col-xs-3 control-label">Turno*</label>
          <div class="col-xs-3">
            <select class="form-control" name="aluno_turno" id="aluno_turno" required="required">
              <option value="Matutino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Matutino') || $read->getResult()[0]['aluno_turno'] == 'Matutino' ? 'selected="selected"' : ''; ?>>Matutino</option>
              <option value="Vespertino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Vespertino') || $read->getResult()[0]['aluno_turno'] == 'Vespertino' ? 'selected="selected"' : ''; ?>>Vespertino</option>
              <option value="Noturno" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Noturno') || $read->getResult()[0]['aluno_turno'] == 'Noturno' ? 'selected="selected"' : ''; ?>>Noturno</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_escolaridade" class="col-xs-3 control-label">Escolaridade*</label>
          <div class="col-xs-3">
            <select class="form-control" name="aluno_escolaridade" id="aluno_escolaridade" required="required">
              <option value="Fundamental" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Fundamental') || $read->getResult()[0]['aluno_escolaridade'] == 'Fundamental' ? 'selected="selected"' : ''; ?>>Fundamental</option>
              <option value="Médio" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Médio') || $read->getResult()[0]['aluno_escolaridade'] == 'Médio' ? 'selected="selected"' : ''; ?>>Médio</option>
              <option value="Superior" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Superior') || $read->getResult()[0]['aluno_escolaridade'] == 'Superior' ? 'selected="selected"' : ''; ?>>Superior</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_email" class="col-xs-3 control-label">Email</label>
          <div class="col-xs-5">
            <input type="email" class="form-control" name="aluno_email" id="aluno_email" placeholder="Email do aluno"
            value="<?= isset($dados['aluno_email']) ? $dados['aluno_email'] : $read->getResult()[0]['aluno_email']; ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_tel" class="col-md-3 control-label">Telefone</label>
          <div class="col-md-2">
            <input type="tel" class="form-control" name="aluno_tel" id="aluno_tel" placeholder="Telefone"
            value="<?= isset($dados['aluno_tel']) ? $dados['aluno_tel'] : $read->getResult()[0]['aluno_tel']; ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="aluno_cel" class="col-md-3 control-label">Celular</label>
          <div class="col-md-2">
            <input type="tel" class="form-control" name="aluno_cel" id="aluno_cel" placeholder="Celular"
            value="<?= isset($dados['aluno_cel']) ? $dados['aluno_cel'] : $read->getResult()[0]['aluno_cel']; ?>" />
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
          <input type="number" class="form-control" name="aluno_end_numero" id="aluno_end_numero" placeholder="Número da casa"
          value="<?= isset($dados['aluno_end_numero']) ? $dados['aluno_end_numero'] : $read->getResult()[0]['aluno_end_numero']; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="tb_rotas_rota_id" class="col-xs-3 control-label">Rota*</label>
        <div class="col-xs-5">
          <select class="form-control" name="tb_rotas_rota_id" id="tb_rotas_rota_id" required="required">
            <?php
            $readerlog = new ModelRotas;
            $readerlog->getRotas();
            if ($readerlog->getRowCount() > 0):
              foreach ($readerlog->getResult() as $rotas):
                if (($rotas['rota_id'] == $dados['tb_rotas_rota_id']) ||
                ($rotas['rota_id'] == $read->getResult()[0]['tb_rotas_rota_id'])):
                echo "<option value=\"{$rotas['rota_id']}\" selected=\"selected\">{$rotas['instituicao_nome']} X "
                . "{$rotas['bairros_nome']} - {$rotas['veiculo_placa']}</option>";
              else:
                echo "<option value=\"{$rotas['rota_id']}\">{$rotas['instituicao_nome']} X "
                . "{$rotas['bairros_nome']} - {$rotas['veiculo_placa']}</option>";
              endif;
            endforeach;
          endif;
          ?>
        </select>
      </div>
    </div>

    <hr />

    <div class="form-group">
      <label for="" class="col-md-3 control-label"></label>
      <div class="col-md-5">
        <h4>Dados do Responsável</h4>
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_nome" class="col-md-3 control-label">Responsável*</label>
      <div class="col-md-5">
        <input type="text" class="form-control" name="aluno_resp_nome" id="aluno_resp_nome" placeholder="Nome do responsável"
        value="<?= isset($dados['aluno_resp_nome']) ? $dados['aluno_resp_nome'] : $read->getResult()[0]['aluno_resp_nome']; ?>" required="required" />
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_sobrenome" class="col-md-3 control-label">Sobrenome*</label>
      <div class="col-md-5">
        <input type="text" class="form-control" name="aluno_resp_sobrenome" id="aluno_resp_sobrenome" placeholder="Sobrenome do responsável"
        value="<?= isset($dados['aluno_resp_sobrenome']) ? $dados['aluno_resp_sobrenome'] : $read->getResult()[0]['aluno_resp_sobrenome']; ?>" required="required" />
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_cpf" class="col-md-3 control-label">CPF*</label>
      <div class="col-md-3">
        <input type="text" class="form-control" name="aluno_resp_cpf" id="aluno_resp_cpf" placeholder="CPF do responsável"
        value="<?= isset($dados['aluno_resp_cpf']) ? $dados['aluno_resp_cpf'] : $read->getResult()[0]['aluno_resp_cpf']; ?>" required="required" />
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_rg" class="col-md-3 control-label">RG*</label>
      <div class="col-md-3">
        <input type="text" class="form-control" name="aluno_resp_rg" id="aluno_resp_rg" placeholder="RG do responsável"
        value="<?= isset($dados['aluno_resp_rg']) ? $dados['aluno_resp_rg'] : $read->getResult()[0]['aluno_resp_rg']; ?>" required="required" />
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_tel" class="col-md-3 control-label">Telefone</label>
      <div class="col-md-2">
        <input type="tel" class="form-control" name="aluno_resp_tel" id="aluno_resp_tel" placeholder="Telefone responsável"
        value="<?= isset($dados['aluno_resp_tel']) ? $dados['aluno_resp_tel'] : $read->getResult()[0]['aluno_resp_tel']; ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="aluno_resp_cel" class="col-md-3 control-label">Celular</label>
      <div class="col-md-2">
        <input type="tel" class="form-control" name="aluno_resp_cel" id="aluno_resp_cel" placeholder="Celular responsável"
        value="<?= isset($dados['aluno_resp_cel']) ? $dados['aluno_resp_cel'] : $read->getResult()[0]['aluno_resp_cel']; ?>" />
      </div>
    </div>

    <hr />

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
