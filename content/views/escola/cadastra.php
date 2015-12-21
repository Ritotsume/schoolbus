<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
  if (isset($dados['cadastrar'])):
    $telefones['telefone_numero'] = $dados['telefone_numero'];
    unset($dados['search_form'], $dados['cadastrar'], $dados['telefone'], $dados['telefone_numero']);
  $cadescola = new ModelInstituicao();
$xpg = 1;
  //$cadescola->ModelCreator($dados);
  //if ($cadescola->getRowCount()):
if($xpg):
    ADSError('Dados cadastrados com sucesso!!!', CRAZY_ACCEPT);
      //fazer loop dos telefones
  $telefones['telefone_tipo'] = 'fixo';
  $telefones['tb_instiuicoes_instituicao_id'] = $cadescola->getLastId();
  foreach ($telefones['telefone_numero'] as $telefone):
    $insert = new Create();
    //$insert->Inserter('tb_telefones_instituicao', $telefone);
  var_dump($telefones, $telefone);
  endforeach;
  else:
    ADSError('Erro ao cadastrar, verifique e tente novamente!!', CRAZY_ALERT);
  endif;
  endif;
  endif;
  ?>

  <div class="line-half">
    <div class="item">
      <label for="" class="bold text-theme">Nome</label><br />
      <input type="text" name="instituicao_nome" placeholder="EMEF Água Salgada"
      value="<?= isset($dados['instituicao_nome']) ? $dados['instituicao_nome'] : ''; ?>" />
    </div>
    <div class="item">
      <label for="" class="bold text-theme">Razão</label><br />
      <input type="text" name="instituicao_razao" placeholder="EMEF Água Salgada"
      value="<?= isset($dados['instituicao_razao']) ? $dados['instituicao_razao'] : ''; ?>" />
    </div>
  </div>
  <div class="line-half">
    <div class="item-3">
      <label for="" class="bold text-theme">Telefone</label>
      <div class="label-input">
        <input type="text" name="telefone" placeholder="(27)3333-3333" />
        <i class="fa fa-plus-circle text-theme button-i" onclick="addPhone(this)"></i>
      </div>
    </div>
    <div class="item-3">
      <label for="" class="bold text-theme">Email</label>
      <input type="email" name="instituicao_email" placeholder="teste@exemplo.com.br"
      value="<?= isset($dados['instituicao_email']) ? $dados['instituicao_email'] : ''; ?>" />
    </div>
    <div class="item-3">
      <label for="" class="bold text-theme">CNPJ</label>
      <input type="text" name="instituicao_cnpj" placeholder="23.123.123/0001-00"
      value="<?= isset($dados['instituicao_cnpj']) ? $dados['instituicao_cnpj'] : ''; ?>" />
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
        <div class="item-3">
          <label for="" class="bold text-theme">Número</label>
          <input type="text" name="instituicao_numero" placeholder="123"
          value="<?= isset($dados['instituicao_numero']) ? $dados['instituicao_numero'] : ''; ?>" />
        </div>
      </div>
      <div class="line-half">
        <div class="item">
          <label for="" class="bold text-theme">Diretor</label>
          <input type="text" name="instituicao_diretor" placeholder="Juvenal Antena"
          value="<?= isset($dados['instituicao_diretor']) ? $dados['instituicao_diretor'] : ''; ?>" />
        </div>
      </div>

      <div class="line-half">
        <div class="item">
          <div id="telefones" class="item-2">
            <label for="" class="bold text-theme">Telefones</label>
          </div>
        </div>
      </div>
