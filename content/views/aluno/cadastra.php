<div class="row" data-cadastra="aluno">
  <div class="form-group col-md-6">
    <label for="aluno_nome" class="">Nome</label>
    <input type="text" class="form-control" name="aluno_nome" id="aluno_nome" placeholder="Francisco"
    value="<?= isset($dados['aluno_nome']) ? $dados['aluno_nome'] : ''; ?>" required="required" />
  </div>
  <div class="form-group col-md-6">
    <label for="aluno_sobrenome" class="">Sobrenome</label>
    <input type="text" class="form-control" name="aluno_sobrenome" id="aluno_sobrenome" placeholder="Silva Xavier"
    value="<?= isset($dados['aluno_sobrenome']) ? $dados['aluno_sobrenome'] : ''; ?>" required="required" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="aluno_cpf" class="">CPF</label>
    <input type="text" class="form-control" name="aluno_cpf" id="aluno_cpf" placeholder="123.456.789-00" required="required"
    value="<?= isset($dados['aluno_cpf']) ? $dados['aluno_cpf'] : ''; ?>" required="required" />
  </div>
  <div class="form-group col-md-4">
    <label for="aluno_nascimento" class="">Nascimento</label>
    <input type="text" class="form-control" name="aluno_nascimento" id="aluno_nascimento" placeholder="01/01/1991"
    value="<?= isset($dados['aluno_nascimento']) ? $dados['aluno_nascimento'] : ''; ?>" required="required" />
  </div>
  <div class="form-group col-md-4">
    <label for="aluno_serie" class="">Serie</label>
    <input type="text" class="form-control" name="aluno_serie" id="aluno_serie" placeholder="2A"
    value="<?= isset($dados['aluno_serie']) ? $dados['aluno_serie'] : ''; ?>" required="required" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="aluno_turno" class="">Turno</label>
    <select class="form-control" name="aluno_turno" id="aluno_turno" required="required">
      <option value="">Selecione...</option>
      <option value="Matutino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Matutino') ? 'selected="selected"' : ''; ?>>Matutino</option>
      <option value="Vespertino" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Vespertino') ? 'selected="selected"' : ''; ?>>Vespertino</option>
      <option value="Noturno" <?= (isset($dados['aluno_turno']) && $dados['aluno_turno'] == 'Noturno') ? 'selected="selected"' : ''; ?>>Noturno</option>
    </select>
  </div>
  <div class="form-group col-md-4">
    <label for="aluno_escolaridade" class="">Escolaridade</label>
    <select class="form-control" name="aluno_escolaridade" id="aluno_escolaridade" required="required">
      <option value="">Selecione...</option>
      <option value="Fundamental" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Fundamental') ? 'selected="selected"' : ''; ?>>Fundamental</option>
      <option value="Médio" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Médio') ? 'selected="selected"' : ''; ?>>Médio</option>
      <option value="Superior" <?= (isset($dados['aluno_escolaridade']) && $dados['aluno_escolaridade'] == 'Superior') ? 'selected="selected"' : ''; ?>>Superior</option>
    </select>
  </div>
  <div class="form-group col-md-4">
    <label for="aluno_email" class="">Email</label>
    <input type="email" class="form-control" name="aluno_email" id="aluno_email" placeholder="teste@exemplo.com.br"
    value="<?= isset($dados['aluno_email']) ? $dados['aluno_email'] : ''; ?>" required="required" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="tb_logradouros_logradouro_id" class="">Endereço</label>
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
  <div class="form-group col-md-3">
    <label for="aluno_end_numero" class="">Número</label>
    <input type="text" class="form-control" name="aluno_end_numero" id="aluno_end_numero" placeholder="123"
    value="<?= isset($dados['aluno_end_numero']) ? $dados['aluno_end_numero'] : ''; ?>" required="required" />
  </div>
  <div class="form-group col-md-5">
    <label for="tb_rotas_rota_id" class="">Rota</label>
    <select class="form-control" name="tb_rotas_rota_id" id="tb_rotas_rota_id" required="required">
      <option value="">Selecione...</option>
      <?php
      $readerlog->Reader('tb_rotas', 'inner join tb_instituicoes on '
      . 'tb_rotas.tb_instiuicoes_instituicao_id = tb_instituicoes.instituicao_id '
      . 'inner join tb_veiculos on tb_rotas.tb_veiculos_veiculo_placa = tb_veiculos.veiculo_placa '
      . 'inner join tb_logradouros on tb_rotas.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
      . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
      if ($readerlog->getRowCount() > 0):
        foreach ($readerlog->getResult() as $rotas):
          if (($rotas['rota_id'] == $dados['tb_rotas_rota_id'])):
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
