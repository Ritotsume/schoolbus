<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);
$param = filter_input(INPUT_GET, 'del', FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
        unset($dados['search_form'], $dados['editar'], $dados['telefone']);
        $upescola = new ModelVeiculo();

        $upescola->ModelUpdate($param, $dados);
        if ($upescola->getResult()):
            ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
        else:
            ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
        endif;
    endif;
endif;

if (isset($param) && !empty($param)):
    if (isset($varcheck) && $varcheck == 'atualizar'):
        $read = new Read();
        $read->Reader('tb_veiculos', 'where veiculo_placa = :placa', "placa={$param}");
        if ($read->getResult()):
            ?>

            <div class="line-half">
                <div class="item">
                    <label for="" class="bold text-theme">Placa</label>
                    <input type="text" name="veiculo_placa" placeholder="ABC1234" 
                           value="<?= isset($dados['veiculo_placa']) ? $dados['veiculo_placa'] : $read->getResult()[0]['veiculo_placa']; ?>" />
                </div>
                <div class="item">
                    <label for="" class="bold text-theme">Marca</label><br />
                    <input type="text" name="veiculo_marca" placeholder="Marcopolo" 
                           value="<?= isset($dados['veiculo_marca']) ? $dados['veiculo_marca'] : $read->getResult()[0]['veiculo_marca']; ?>" />
                </div>
            </div>
            <div class="line-half">
                <div class="item">
                    <label for="" class="bold text-theme">Modelo</label><br />
                    <input type="text" name="veiculo_modelo" placeholder="A770" 
                           value="<?= isset($dados['veiculo_modelo']) ? $dados['veiculo_modelo'] : $read->getResult()[0]['veiculo_modelo']; ?>" />
                </div>
                <div class="item">
                    <label for="" class="bold text-theme">Poltronas</label>
                    <input type="text" name="veiculo_poltronas" placeholder="44" 
                           value="<?= isset($dados['veiculo_poltronas']) ? $dados['veiculo_poltronas'] : $read->getResult()[0]['veiculo_poltronas']; ?>" />
                </div>
            </div>
            <div class="line-half">
                <div class="item-2">
                    <label for="" class="bold text-theme">Ano</label>
                    <input type="text" name="veiculo_ano" placeholder="2010/2011" 
                           value="<?= isset($dados['veiculo_ano']) ? $dados['veiculo_ano'] : $read->getResult()[0]['veiculo_ano']; ?>" />
                </div>
                <div class="item-3">
                    <label for="" class="bold text-theme">Tipo de contrato</label>
                    <select name="veiculo_agregado">
                        <option value="">Selecione...</option>
                        <option value="1" <?= (isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 1) || $read->getResult()[0]['veiculo_agregado'] == 1 ? 'selected="selected"' : ''; ?>>Agregado</option>
                        <option value="0" <?= (isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 0) || $read->getResult()[0]['veiculo_agregado'] == 0 ? 'selected="selected"' : ''; ?>>Prefeitura - Município</option>
                    </select>
                </div>
            </div>
            <div class="line-half">
                <div class="item-3">
                    <label for="" class="bold text-theme">Kms rodados</label>
                    <input type="text" name="veiculo_kms" placeholder="1000" 
                           value="<?= isset($dados['veiculo_kms']) ? $dados['veiculo_kms'] : $read->getResult()[0]['veiculo_kms']; ?>" />
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