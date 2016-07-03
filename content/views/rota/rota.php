<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Rotas</span>
    <div class="description">Relatório de rotas cadastradas no sistema.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="title">Dados gerais</div>
          </div>
        </div>
        <div class="card-body">
          <?php
          $readrota = new ModelRotas;

          $stat = 1;
          $readrota->getRotas($stat);
          $dataRotas = $readrota->getResult();
          // var_dump($dataRotas);

          if ($readrota->getRowCount() > 0):
            ?>
            <table class="datatable table table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Escolas</th>
                  <th>Saída/Chegada</th>
                  <th>Veículo/Placa</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Escolas</th>
                  <th>Saída/Chegada</th>
                  <th>Veículo/Placa</th>
                  <th>Controles</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                foreach ($readrota->getResult() as $regs):
                  $id = (int) $regs['rota_id'];
                  $getEscolas = clone $readrota;

                  $inicioRota = new ModelEnderecos;
                  $bairroSaida = $inicioRota->getLogradouro($regs['rota_saida']);
                  $bairroSaida = $bairroSaida[0]['bairros_nome'];

                  $fimRota = clone $inicioRota;
                  $bairroChegada = $fimRota->getLogradouro($regs['rota_chegada']);
                  $bairroChegada = $bairroChegada[0]['bairros_nome'];

                  $percurso = $bairroSaida . '/' . $bairroChegada;

                  $veiculoRota = new ModelVeiculo;
                  $veiculoRota->getVeiculo($regs['tb_veiculos_veiculo_id']);
                  $veiculo = $veiculoRota->getResult()[0]['veiculo_modelo'] . '/' . $veiculoRota->getResult()[0]['veiculo_placa'];
                  ?>
                  <tr>
                    <td><?= $getEscolas->getInstituicoes($regs['rota_instituicoes']); ?></td>
                    <td><?= $percurso; ?></td>
                    <td><?= $veiculo; ?></td>
                    <td>
                      <a href="<?= HOME; ?>rota/detail/<?= $id; ?>" class="btn btn-info" title="Detalhes"><i class="fa fa-search-plus"></i></a>
                      <a href="<?= HOME; ?>rota/update/<?= $id; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                      <button type="button" class="btn btn-danger delete-reg" dataStr="<?= 'var=delete&del=' . $id; ?>"
                        data-local="rota" title="Excluir"><i class="fa fa-minus-circle"></i></button>
                    </td>
                  </tr>
                  <?php
                endforeach;
                echo '</tbody></table>';
              endif;
              ?>
        </div>
      </div>
    </div>
  </div>
</div>
