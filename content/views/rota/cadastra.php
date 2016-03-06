<div class="side-body">

  <?php
  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelRotas();
    unset($dados['search_form'], $dados['telefone']);
    $cadastra->ModelCreator($dados);
    if($cadastra->getRowCount() > 0):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Rota cadastrada com sucesso.
      </div>";
    else:
      echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar aluno. Verifique e tente novamente.
      </div>";
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de rota.</div>
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
        <div class="col-xs-4">
          <select class="form-control" name="tb_instituicoes_instituicao_id" id="tb_instituicoes_instituicao_id">
            <option value="">Selecione</option>
            <?php
            $read = new Read();
            $stat = 'ativo';
            $read->Reader('tb_instituicoes', 'where instituicao_status = :stat', "stat={$stat}");
            if ($read->getResult()):
              foreach ($read->getResult() as $escolas):
                echo "<option value=\"{$escolas['instituicao_id']}\">{$escolas['instituicao_nome']}</option>";
              endforeach;
            endif;
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="tb_logradouros_logradouro_id" class="col-xs-3 control-label">Logradouros</label>
        <div class="col-xs-4">
          <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
            <option value="">Selecione</option>
            <?php
            $read->Reader('tb_logradouros', 'inner join tb_bairros on '
            . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
            if ($read->getRowCount() > 0):
              foreach ($read->getResult() as $options):
                echo "<option value=\"{$options['logradouro_id']}\">{$options['logradouro_nome']} -- "
                . "{$options['bairros_nome']}</option>";
              endforeach;
            endif;
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="tb_veiculos_veiculo_placa" class="col-xs-3 control-label">Veículos</label>
        <div class="col-xs-4">
          <select class="form-control" name="tb_veiculos_veiculo_placa" id="tb_veiculos_veiculo_placa">
            <option value="">Selecione</option>
            <?php
            $read->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");
            if ($read->getResult()):
              foreach ($read->getResult() as $veiculos):
                $description = $veiculos['veiculo_marca'] . ' - ' . $veiculos['veiculo_modelo'];
                echo "<option value=\"{$veiculos['veiculo_placa']}\">{$description}</option>";
              endforeach;
            endif;
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-xs-3 control-label"></label>
        <div class="col-xs-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
</div>
