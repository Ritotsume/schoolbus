<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
    if (isset($dados['CadRota'])):
        unset($dados['search_form'], $dados['CadRota']);
        $insert = new ModelRotas();
        $insert->ModelCreator($dados);
        if ($insert->getRowCount()):
            echo '<script type="text/javascript">'
            . 'alert("Rota cadastrada com sucesso!");'
            . '</script>';
        else:
            echo '<script type="text/javascript">'
            . 'alert("Erro ao cadastrar rota...");'
            . '</script>';
        endif;
    endif;
endif;
?>

<!-- <img class="absolute" src="<?= HOME; ?>images/site/onibus_escolar.jpg" title="Escolar" alt="Escolar" /> -->

<!-- INICIO MODAL -->
<div id="cadrotas" class="modalDialog">
    <div>
        <?php // var_dump($dados); ?>
        <a class="close" title="Fechar" href="#close">X</a>
        <h2 class="text-theme">Cadastro de Rotas</h2>
        <div class="bloco">
            <label for="">Escolas</label><br />
            <select name="tb_instiuicoes_instituicao_id">
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

        <div class="bloco">
            <label for="">Logradouros</label><br />
            <select name="tb_logradouros_logradouro_id">
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

        <div class="bloco">
            <label for="">Veículos</label><br />
            <select name="tb_veiculos_veiculo_placa">
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
        <div class="bloco">
            <button type="submit" name="CadRota" class="button-b theme"> Cadastrar</button>
        </div>
    </div>
</div>
<!-- FIM MODAL -->
