<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);
$param = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);

if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
        unset($dados['search_form'], $dados['editar']);
        $upmotorista = new ModelMotorista();

        $upmotorista->ModelUpdate($param, $dados);
        if ($upmotorista->getResult()):
            ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
        else:
            ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
        endif;
    endif;
endif;

if (isset($param) && !empty($param)):
    if (isset($varcheck) && $varcheck == 'atualizar'):
        $read = new Read();
        $read->Reader('tb_motoristas', 'where motorista_id = :id', "id={$param}");
        if ($read->getResult()):
            ?>

            <div class="line-half">
                <div class="item">
                    <label for="" class="bold text-theme">Nome</label><br />
                    <input type="text" name="motorista_nome" placeholder="Joaquim"
                           value="<?= isset($dados['motorista_nome']) ? $dados['motorista_nome'] : $read->getResult()[0]['motorista_nome']; ?>" />
                </div>
                <div class="item">
                    <label for="" class="bold text-theme">Sobrenome</label><br />
                    <input type="text" name="motorista_sobrenome" placeholder="Silva Xavier"
                           value="<?= isset($dados['motorista_sobrenome']) ? $dados['motorista_sobrenome'] : $read->getResult()[0]['motorista_sobrenome']; ?>" />
                </div>
            </div>
            <div class="line-half">
                <div class="item">
                    <label for="" class="bold text-theme">RG</label>
                    <input type="text" name="motorista_rg" placeholder="12345" 
                           value="<?= isset($dados['motorista_rg']) ? $dados['motorista_rg'] : $read->getResult()[0]['motorista_rg']; ?>" />
                </div>
                <div class="item">
                    <label for="" class="bold text-theme">CPF</label>
                    <input type="text" name="motorista_cpf" placeholder="123.456.789-00" 
                           value="<?= isset($dados['motorista_cpf']) ? $dados['motorista_cpf'] : $read->getResult()[0]['motorista_cpf']; ?>" />
                </div>
            </div>
            <div class="line-half">
                <div class="item-2">
                    <label for="" class="bold text-theme">Endereço</label>
                    <select name="tb_logradouros_logradouro_id">
                        <option value="">Selecione...</option>
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