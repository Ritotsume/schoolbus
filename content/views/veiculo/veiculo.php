<div id="content-data-escola">
    <div id="msg-escola"></div>

    <a href="<?= HOME; ?>veiculo/cadastro" class="a-button"><i class="fa fa-plus-circle"></i> Adicionar</a><br />

    <?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && !empty($dados)):
        if (isset($dados['editar'])):

            $upveiculo = new ModelVeiculo();

            $param = $dados['veiculo_placa'];
            unset($dados['search_form'], $dados['editar'], $dados['veiculo_placa']);

            $upveiculo->ModelUpdate($param, $dados);
            if ($upveiculo->getResult()):
                ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
            else:
                ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
            endif;
        endif;
    endif;
    
    $readveiculo = new Read();

    $stat = 'ativo';
    $readveiculo->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");

    if ($readveiculo->getRowCount() > 0):
        ?>
        <div class="line-veiculo head">
            <span>Placa</span>
            <span>Veículo</span>
            <span>Vagas</span>
            <span>Controles</span>
        </div>
        <?php
        foreach ($readveiculo->getResult() as $regs):
            if($regs['veiculo_poltronas'] - $regs['veiculo_vagas'] <= 0):
                $vagas = 'Completo';
            else:
                $vagas =  ($regs['veiculo_poltronas'] - $regs['veiculo_vagas']) . ' vaga(s)';
            endif;
            ?>
            <div class="line-veiculo">
                <span><?= $regs['veiculo_placa']; ?></span>
                <span><?= $regs['veiculo_marca'] . ' - ' . $regs['veiculo_modelo']; ?></span>
                <span><?= $vagas; ?></span>
                <span>
                    <i class="fa fa-edit bt-i text-theme" onclick="redireciona(this)" title="Editar">
                        <span dataStr="<?= HOME . 'index.php?pag=veiculo&view=update&var=atualizar&del=' . $regs['veiculo_placa']; ?>"></span>
                    </i>
                    <i class="fa fa-minus-circle bt-i text-theme" onclick="esconder(this, 'veiculo')" title="Excluir">
                        <span dataStr="<?= 'var=delete&del=' . $regs['veiculo_placa']; ?>"></span>
                    </i>
                </span>
            </div>
            <?php
        endforeach;
    endif;
    ?>
</div>

