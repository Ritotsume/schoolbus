<div class="side-body">
  <div class="page-title">
    <span class="title">Relatório de Motoristas</span>
    <div class="description">Relatório de motoristas cadastrados no sistema.</div>
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
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>enderecos/logradouros">
                <div class="card red summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-map-marker fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $logradouros = new ModelEnderecos;
                        $logradouros->getLogradouros();
                        if($logradouros->getRowCount() > 0):
                          echo $logradouros->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Logradouros</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="#">
                <div class="card yellow summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-map-signs fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $bairros = new ModelEnderecos;
                        $bairros->getBairros();
                        if($bairros->getRowCount() > 0):
                          echo $bairros->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Bairros</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="#">
                <div class="card green summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-map fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $cidades = new ModelEnderecos;
                        $cidades->getCidades();
                        if($cidades->getRowCount() > 0):
                          echo $cidades->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Cidades</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
