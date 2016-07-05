<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    // var_dump($dados);
    $cadastra = new ModelAluno();
    unset($dados['search_form']);

    $request = md5(implode($dados));

    if(isset($_SESSION['last_request']) && $_SESSION['last_request']== $request):
      echo "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-warning'></span></strong> Aluno(a) <b>{$dados['aluno_nome']}</b> já está cadastrado(a).
      <a href='". HOME ."aluno'><span class='label label-warning'>Confira!</span></a>
      </div>";
    else:
      $_SESSION['last_request']  = $request;
      $cadastra->ModelCreator($dados);
      if($cadastra->getRowCount() > 0):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Aluno(a) <b>{$dados['aluno_nome']}</b> cadastrado(a) com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar <b>{$dados['aluno_nome']}</b>. Verifique e tente novamente.
        </div>";
        var_dump($cadastra->getResult());
      endif;
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de aluno.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Campos com (*) são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="aluno_nome" class="col-md-3 control-label">Nome*</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="aluno_nome" id="aluno_nome" placeholder="Nome do aluno"
          value="<?= isset($dados['aluno_nome']) ? $dados['aluno_nome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_sobrenome" class="col-md-3 control-label">Sobrenome*</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="aluno_sobrenome" id="aluno_sobrenome" placeholder="Sobrenome do aluno"
          value="<?= isset($dados['aluno_sobrenome']) ? $dados['aluno_sobrenome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_cpf" class="col-md-3 control-label">CPF*</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="aluno_cpf" id="aluno_cpf" placeholder="Entre com o CPF"
          value="<?= isset($dados['aluno_cpf']) ? $dados['aluno_cpf'] : ''; ?>" pattern="^[0-9]{3}[.][0-9]{3}[.][0-9]{3}[-][0-9]{2}$"
          title="Deve ser no formato xxx.xxx.xxx-xx" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_nascimento" class="col-md-3 control-label">Nascimento*</label>
        <div class="col-md-3">
          <input type="date" class="form-control" name="aluno_nascimento" id="aluno_nascimento" placeholder="Data de nascimento"
          value="<?= isset($dados['aluno_nascimento']) ? $dados['aluno_nascimento'] : ''; ?>" required="required" />
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
                if (($instituicao['instituicao_id'] == $dados['tb_instituicoes_instituicao_id'])):
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
        <label for="aluno_serie" class="col-md-3 control-label">Serie*</label>
        <div class="col-md-2">
          <input type="text" class="form-control" name="aluno_serie" id="aluno_serie" placeholder="Série"
          value="<?= isset($dados['aluno_serie']) ? $dados['aluno_serie'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_turno" class="col-md-3 control-label">Turno*</label>
        <div class="col-md-3">
          <select class="form-control" name="aluno_turno" id="aluno_turno" required="required">
            <option value="">Selecione...</option>
            <option value="Matutino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Matutino') ? 'selected="selected"' : ''; ?>>Matutino</option>
            <option value="Vespertino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Vespertino') ? 'selected="selected"' : ''; ?>>Vespertino</option>
            <option value="Noturno" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Noturno') ? 'selected="selected"' : ''; ?>>Noturno</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_escolaridade" class="col-md-3 control-label">Escolaridade*</label>
        <div class="col-md-3">
          <select class="form-control" name="aluno_escolaridade" id="aluno_escolaridade" required="required">
            <option value="">Selecione...</option>
            <option value="Fundamental" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Fundamental') ? 'selected="selected"' : ''; ?>>Fundamental</option>
            <option value="Médio" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Médio') ? 'selected="selected"' : ''; ?>>Médio</option>
            <option value="Superior" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Superior') ? 'selected="selected"' : ''; ?>>Superior</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_email" class="col-md-3 control-label">Email</label>
        <div class="col-md-5">
          <input type="email" class="form-control" name="aluno_email" id="aluno_email" placeholder="Email do aluno"
          value="<?= isset($dados['aluno_email']) ? $dados['aluno_email'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_tel" class="col-md-3 control-label">Telefone</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="aluno_tel" id="aluno_tel" placeholder="Telefone"
          value="<?= isset($dados['aluno_tel']) ? $dados['aluno_tel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_cel" class="col-md-3 control-label">Celular</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="aluno_cel" id="aluno_cel" placeholder="Celular"
          value="<?= isset($dados['aluno_cel']) ? $dados['aluno_cel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="tb_logradouros_logradouro_id" class="col-md-3 control-label">Endereço*</label>
        <div class="col-md-4">
          <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id" required="required">
            <option value="">Selecione...</option>
            <?php
            $readerlog = new Read;
            $readerlog->Reader('tb_logradouros', 'inner join tb_bairros on '
            . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
            if ($readerlog->getRowCount() > 0):
              foreach ($readerlog->getResult() as $options):
                if (($options['logradouro_id'] == $dados['tb_logradouros_logradouro_id'])):
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
        <label for="aluno_end_numero" class="col-md-3 control-label">Número</label>
        <div class="col-md-2">
          <input type="text" class="form-control" name="aluno_end_numero" id="aluno_end_numero" placeholder="Número da casa"
          value="<?= isset($dados['aluno_end_numero']) ? $dados['aluno_end_numero'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="tb_rotas_rota_id" class="col-md-3 control-label">Rota*</label>
        <div class="col-md-5">
          <select class="form-control" name="tb_rotas_rota_id" id="tb_rotas_rota_id" required="required">
            <option value="">Selecione...</option>
            <?php
            $readerlog = new ModelRotas();
            $readerlog->getRotas();
            if ($readerlog->getRowCount() > 0):
              foreach ($readerlog->getResult() as $rotas):
                $getEscolas = clone $readerlog;

                $inicioRota = new ModelEnderecos;
                $bairroSaida = $inicioRota->getLogradouro($rotas['rota_saida']);
                $bairroSaida = $bairroSaida[0]['bairros_nome'];

                $fimRota = clone $inicioRota;
                $bairroChegada = $fimRota->getLogradouro($rotas['rota_chegada']);
                $bairroChegada = $bairroChegada[0]['bairros_nome'];

                $percurso = $bairroSaida . 'X' . $bairroChegada;

                $veiculoRota = new ModelVeiculo;
                $veiculoRota->getVeiculo($rotas['tb_veiculos_veiculo_id']);
                $veiculo = $veiculoRota->getResult()[0]['veiculo_modelo'] . '/' . $veiculoRota->getResult()[0]['veiculo_placa'];

                if (($rotas['rota_id'] == $dados['tb_rotas_rota_id'])):
                  echo "<option value=\"{$rotas['rota_id']}\" selected=\"selected\">->". substr($getEscolas->getInstituicoes($rotas['rota_instituicoes']), 0, 25) ." -- "
                  . "{$percurso} -- {$veiculo}</option>";
                else:
                  echo "<option value=\"{$rotas['rota_id']}\">->". substr($getEscolas->getInstituicoes($rotas['rota_instituicoes']), 0, 25) ." -- "
                  . "{$percurso} -- {$veiculo}</option>";
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
          value="<?= isset($dados['aluno_resp_nome']) ? $dados['aluno_resp_nome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_resp_sobrenome" class="col-md-3 control-label">Sobrenome*</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="aluno_resp_sobrenome" id="aluno_resp_sobrenome" placeholder="Sobrenome do responsável"
          value="<?= isset($dados['aluno_resp_sobrenome']) ? $dados['aluno_resp_sobrenome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_resp_cpf" class="col-md-3 control-label">CPF*</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="aluno_resp_cpf" id="aluno_resp_cpf" placeholder="CPF do responsável"
          value="<?= isset($dados['aluno_resp_cpf']) ? $dados['aluno_resp_cpf'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_resp_rg" class="col-md-3 control-label">RG*</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="aluno_resp_rg" id="aluno_resp_rg" placeholder="RG do responsável"
          value="<?= isset($dados['aluno_resp_rg']) ? $dados['aluno_resp_rg'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_resp_tel" class="col-md-3 control-label">Telefone</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="aluno_resp_tel" id="aluno_resp_tel" placeholder="Telefone responsável"
          value="<?= isset($dados['aluno_resp_tel']) ? $dados['aluno_resp_tel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="aluno_resp_cel" class="col-md-3 control-label">Celular</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="aluno_resp_cel" id="aluno_resp_cel" placeholder="Celular responsável"
          value="<?= isset($dados['aluno_resp_cel']) ? $dados['aluno_resp_cel'] : ''; ?>" />
        </div>
      </div>

      <hr />

      <div class="form-group">
        <label for="" class="col-md-3 control-label"></label>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
</div>
