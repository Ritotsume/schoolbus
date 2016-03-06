<div class="row">
  <div class="form-group col-md-6">
    <label for="motorista_nome" class="">Nome</label><br />
    <input type="text" name="motorista_nome" id="motorista_nome" placeholder="Joaquim"
    class="form-control" value="<?= isset($dados['motorista_nome']) ? $dados['motorista_nome'] : ''; ?>" />
  </div>
  <div class="form-group col-md-6">
    <label for="motorista_sobrenome" class="">Sobrenome</label><br />
    <input type="text" name="motorista_sobrenome" id="motorista_sobrenome" placeholder="Silva Xavier"
    class="form-control" value="<?= isset($dados['motorista_sobrenome']) ? $dados['motorista_sobrenome'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6">
    <label for=motorista_rg"" class="">RG</label>
    <input type="text" name="motorista_rg" id="motorista_rg" placeholder="12345"
    class="form-control" value="<?= isset($dados['motorista_rg']) ? $dados['motorista_rg'] : ''; ?>" />
  </div>
  <div class="form-group col-md-6">
    <label for="motorista_cpf" class="bold text-theme">CPF</label>
    <input type="text" name="motorista_cpf" id="motorista_cpf" placeholder="123.456.789-00"
    class="form-control" value="<?= isset($dados['motorista_cpf']) ? $dados['motorista_cpf'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6">
    <label for="tb_logradouros_logradouro_id" class="">Endereço</label>
    <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
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
