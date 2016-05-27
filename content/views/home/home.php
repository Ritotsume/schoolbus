<div class="side-body">
  <div class="page-title">
    <span class="title">Schoolbus - Transporte Escolar</span>
    <div class="description">Sistema de gerenciamento de transporte escolar.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="title">Opções gerais do sistema. Apenas clique em uma para começar ou utilize o menu ao lado.</div>
          </div>
        </div>
        <div class="card-body">

          <!-- início da parte de cadastros... -->
          <h3>Cadastros</h3>
          <!-- primeira linha -->
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>aluno/cadastra">
                <div class="card red summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-users fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $alunos = new ModelAluno;
                        $alunos->getAlunos();
                        if($alunos->getRowCount() > 0):
                          echo $alunos->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Alunos</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>escola/cadastra">
                <div class="card yellow summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-university fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $escolas = new ModelInstituicao;
                        $escolas->getInstituicoes();
                        if($escolas->getRowCount() > 0):
                          echo $escolas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Escolas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>motorista/cadastra">
                <div class="card green summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-user fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $motoristas = new ModelMotorista;
                        $motoristas->getMotoristas();
                        if($motoristas->getRowCount() > 0):
                          echo $motoristas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Motoristas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>rota/cadastra">
                <div class="card blue summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-map-signs fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $rotas = new ModelRotas;
                        $rotas->getRotas();
                        if($rotas->getRowCount() > 0):
                          echo $rotas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Rotas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
          <!-- fim da primeira linha -->

          <!-- segunda linha -->
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>veiculo/cadastra">
                <div class="card red summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-bus fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $veiculos = new ModelVeiculo;
                        $veiculos->getVeiculos();
                        if($veiculos->getRowCount() > 0):
                          echo $veiculos->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Veículos</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
          <!-- fim da segunda linha -->

          <hr />

          <!-- início da parte de controles -->
          <h3>Controle</h3>
          <!-- primeira linha -->
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>aluno">
                <div class="card red summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-users fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $alunos = new ModelAluno;
                        $alunos->getAlunos();
                        if($alunos->getRowCount() > 0):
                          echo $alunos->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Alunos</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>escola">
                <div class="card yellow summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-university fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $escolas = new ModelInstituicao;
                        $escolas->getInstituicoes();
                        if($escolas->getRowCount() > 0):
                          echo $escolas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Escolas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>motorista">
                <div class="card green summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-user fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $motoristas = new ModelMotorista;
                        $motoristas->getMotoristas();
                        if($motoristas->getRowCount() > 0):
                          echo $motoristas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Motoristas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>rota">
                <div class="card blue summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-map-signs fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $rotas = new ModelRotas;
                        $rotas->getRotas();
                        if($rotas->getRowCount() > 0):
                          echo $rotas->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Rotas</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
          <!-- fim primeira linha -->

          <!-- segunda linha -->
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="<?= HOME; ?>veiculo">
                <div class="card red summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-bus fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        <?php
                        $veiculos = new ModelVeiculo;
                        $veiculos->getVeiculos();
                        if($veiculos->getRowCount() > 0):
                          echo $veiculos->getRowCount();
                        else:
                          echo 0;
                        endif;
                        ?>
                      </div>
                      <div class="sub-title">Veículos</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
          <!-- fim segunda linha -->

          <hr />

          <!-- início parte de endereços -->
          <h3>Endereços</h3>
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
          <!-- fim parte endereços -->

          <hr />

          <!-- início parte de manutenção -->
          <h3>Manutenção da Base de Dados</h3>
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="#">
                <div class="card green summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-download fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        --
                      </div>
                      <div class="sub-title">Backup</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="#">
                <div class="card blue summary-inline">
                  <div class="card-body">
                    <i class="icon fa fa-upload fa-4x"></i>
                    <div class="content">
                      <div class="title">
                        --
                      </div>
                      <div class="sub-title">Restaurar</div>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
          <!-- fim parte manutençao -->

        </div>
      </div>
    </div>
  </div>
</div>
