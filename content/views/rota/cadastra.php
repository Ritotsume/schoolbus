<div class="row" data-cadastra="rota">
  <div class="row">
    <div class="form-group col-md-6">
      <label for="tb_instituicoes_instituicao_id">Escolas</label>
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

    <div class="form-group col-md-6">
      <label for="tb_logradouros_logradouro_id">Logradouros</label><br />
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

  <div class="row">
    <div class="form-group col-md-6">
      <label for="tb_veiculos_veiculo_placa">Veículos</label><br />
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
</div>
