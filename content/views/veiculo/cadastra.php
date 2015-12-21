<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
    if (isset($dados['cadastrar'])):
        if (!empty($dados['veiculo_placa']) && !empty($dados['veiculo_marca']) && !empty($dados['veiculo_modelo']) && !empty($dados['veiculo_poltronas'])):
            unset($dados['search_form'], $dados['cadastrar']);
            $cadveiculo = new ModelVeiculo();

            $cadveiculo->ModelCreator($dados);
            if ($cadveiculo->getResult()):
                ADSError('Dados cadastrados com sucesso!!!', CRAZY_ACCEPT);
                ?>
                <script type="text/javascript">
                    var teste = location.href = "<?= HOME; ?>veiculo";
                </script>
                <?php
            else:
                ADSError('Erro ao cadastrar, verifique e tente novamente!', CRAZY_ALERT);
            endif;
        else:
            ADSError('Verifique campos de preenchimento obrigatório!!', CRAZY_ALERT);
        endif;
    endif;
endif;
?>

<div class="line-half">
    <div class="item">
        <label for="" class="bold text-theme">*Placa</label>
        <input type="text" name="veiculo_placa" placeholder="ABC1234" 
               value="<?= isset($dados['veiculo_placa']) ? $dados['veiculo_placa'] : ''; ?>" />
    </div>
    <div class="item">
        <label for="" class="bold text-theme">*Marca</label><br />
        <input type="text" name="veiculo_marca" placeholder="Marcopolo" 
               value="<?= isset($dados['veiculo_marca']) ? $dados['veiculo_marca'] : ''; ?>" />
    </div>
</div>
<div class="line-half">
    <div class="item">
        <label for="" class="bold text-theme">*Modelo</label><br />
        <input type="text" name="veiculo_modelo" placeholder="A770" 
               value="<?= isset($dados['veiculo_modelo']) ? $dados['veiculo_modelo'] : ''; ?>" />
    </div>
    <div class="item">
        <label for="" class="bold text-theme">*Poltronas</label>
        <input type="text" name="veiculo_poltronas" placeholder="44" 
               value="<?= isset($dados['veiculo_poltronas']) ? $dados['veiculo_poltronas'] : ''; ?>" />
    </div>
</div>
<div class="line-half">
    <div class="item-2">
        <label for="" class="bold text-theme">Ano</label>
        <input type="text" name="veiculo_ano" placeholder="2010/2011" 
               value="<?= isset($dados['veiculo_ano']) ? $dados['veiculo_ano'] : ''; ?>" />
    </div>
    <div class="item-3">
        <label for="" class="bold text-theme">Tipo de contrato</label>
        <select name="veiculo_agregado">
            <option value="">Selecione...</option>
            <option value="1" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 1 ? 'selected="selected"' : ''; ?>>Agregado</option>
            <option value="2" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 2 ? 'selected="selected"' : ''; ?>>Prefeitura - Município</option>
        </select>
    </div>
</div>
<div class="line-half">
    <div class="item-3">
        <label for="" class="bold text-theme">Kms rodados</label>
        <input type="text" name="veiculo_kms" placeholder="1000" 
               value="<?= isset($dados['veiculo_kms']) ? $dados['veiculo_kms'] : ''; ?>" />
    </div>
</div>
