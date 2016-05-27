<div class="side-body">
  <div class="page-title">
    <span class="title">Manutenção de Endereços</span>
    <div class="description">Manutenção da base de endereços do sistema.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <a href="<?= HOME; ?>enderecos">
            <div class="card red summary-inline">
              <div class="card-body">
                <i class="icon fa fa-map-signs fa-4x"></i>
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
                  <div class="sub-title">Endereços</div>
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
                <i class="icon fa fa-comments fa-4x"></i>
                <div class="content">
                  <div class="title">23</div>
                  <div class="sub-title">New Message</div>
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
                <i class="icon fa fa-tags fa-4x"></i>
                <div class="content">
                  <div class="title">280</div>
                  <div class="sub-title">Product View</div>
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
                <i class="icon fa fa-share-alt fa-4x"></i>
                <div class="content">
                  <div class="title">16</div>
                  <div class="sub-title">Share</div>
                </div>
                <div class="clear-both"></div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <a href="<?= HOME; ?>admin/manage-site/banners">
        <div class="card red summary-inline">
          <div class="card-body">
            <i class="icon fa fa-image fa-4x"></i>
            <div class="content">
              <div class="title">
                <?php
                // $banners = new ModelBanners;
                // $banners->getBanners(1);
                // if($banners->getRowCount() > 0):
                //   echo $banners->getRowCount();
                // else:
                //   echo 0;
                // endif;
                ?>
              </div>
              <div class="sub-title">Banners</div>
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
            <i class="icon fa fa-comments fa-4x"></i>
            <div class="content">
              <div class="title">23</div>
              <div class="sub-title">New Message</div>
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
            <i class="icon fa fa-tags fa-4x"></i>
            <div class="content">
              <div class="title">280</div>
              <div class="sub-title">Product View</div>
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
            <i class="icon fa fa-share-alt fa-4x"></i>
            <div class="content">
              <div class="title">16</div>
              <div class="sub-title">Share</div>
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
