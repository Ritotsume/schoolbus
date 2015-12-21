<div id="content-data-escola">
    <div id="msg-escola"></div>

    <a href="<?= HOME; ?>motorista/cadastro" class="a-button"><i class="fa fa-plus-circle"></i> Adicionar</a><br />

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && !empty($dados)):
        if (isset($dados['editar'])):

            $upmotorista = new ModelMotorista();

            $param = $dados['motorista_id'];
            unset($dados['search_form'], $dados['editar'], $dados['telefone'], $dados['motorista_id']);

            $upmotorista->ModelUpdate($param, $dados);
            if ($upmotorista->getResult()):
                ADSError('Dados atualizados com sucesso!!!', CRAZY_ACCEPT);
            else:
                ADSError('Erro ao atualizar, verifique e tente novamente!!', CRAZY_ALERT);
            endif;
        endif;
    endif;

    $readmotorista = new Read();

    $stat = 'ativo';
    $readmotorista->Reader('tb_motoristas', 'inner join tb_logradouros on '
            . 'tb_motoristas.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
            . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id'
            . ' where motorista_status = :stat', "stat={$stat}");

    if ($readmotorista->getRowCount() > 0):
        ?>
        <div class="line-veiculo head">
            <span>Motorista</span>
            <span>Bairro</span>
            <span>Status</span>
            <span>Controles</span>
        </div>
        <?php
        foreach ($readmotorista->getResult() as $regs):
            $id = (int) $regs['motorista_id'];
            ?>
            <div class="line-veiculo">
                <span><?= $regs['motorista_nome'] . ' ' . $regs['motorista_sobrenome']; ?></span>
                <span><?= $regs['bairros_nome']; ?></span>
                <span><?= ucfirst($regs['motorista_status']); ?></span>
                <span>
                    <i class="fa fa-edit bt-i text-theme" onclick="redireciona(this)" title="Editar">
                        <span dataStr="<?= HOME . 'index.php?pag=motorista&view=update&var=atualizar&del=' . $id; ?>"></span>
                    </i>
                    <i class="fa fa-minus-circle bt-i text-theme" onclick="esconder(this, 'motorista')" title="Excluir">
                        <span dataStr="<?= 'var=delete&del=' . $id; ?>"></span>
                    </i>
                </span>
            </div>
            <?php
        endforeach;
    endif;
    ?>
</div>

