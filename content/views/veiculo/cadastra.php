<div class="row">
  <div class="form-group col-md-4">
    <label for="veiculo_placa" class="">*Placa</label>
    <input type="text" name="veiculo_placa" id="veiculo_placa" placeholder="ABC1234"
    class="form-control" value="<?= isset($dados['veiculo_placa']) ? $dados['veiculo_placa'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="veiculo_marca" class="">*Marca</label><br />
    <input type="text" name="veiculo_marca" id="veiculo_marca" placeholder="Marcopolo"
    class="form-control" value="<?= isset($dados['veiculo_marca']) ? $dados['veiculo_marca'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="veiculo_modelo" class="">*Modelo</label><br />
    <input type="text" name="veiculo_modelo" id="veiculo_modelo" placeholder="A770"
    class="form-control" value="<?= isset($dados['veiculo_modelo']) ? $dados['veiculo_modelo'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="veiculo_poltronas" class="">*Poltronas</label>
    <input type="text" name="veiculo_poltronas" id="veiculo_poltronas" placeholder="44"
    class="form-control" value="<?= isset($dados['veiculo_poltronas']) ? $dados['veiculo_poltronas'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="veiculo_ano" class="">Ano</label>
    <input type="text" name="veiculo_ano" id="veiculo_ano" placeholder="2010/2011"
    class="form-control" value="<?= isset($dados['veiculo_ano']) ? $dados['veiculo_ano'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="veiculo_agregado" class="">Tipo de contrato</label>
    <select class="form-control" name="veiculo_agregado" id="veiculo_agregado">
      <option value="">Selecione...</option>
      <option value="1" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 1 ? 'selected="selected"' : ''; ?>>Agregado</option>
      <option value="2" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 2 ? 'selected="selected"' : ''; ?>>Prefeitura - Município</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="veiculo_kms" class="">Kms rodados</label>
    <input type="text" name="veiculo_kms" id="veiculo_kms" placeholder="1000"
    class="form-control" value="<?= isset($dados['veiculo_kms']) ? $dados['veiculo_kms'] : ''; ?>" />
  </div>
</div>
