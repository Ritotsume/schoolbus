<div class="side-body">
  <?php
  $backup = new ModelAdmin;
  if($backup->BackupDatabase('schoolbus')):
    echo 'Sucesso!!!';
  else:
    var_dump($backup->getResult());
  endif;
   ?>
  <div class="page-title">
    <span class="title">Backup</span>
    <div class="description">Área destinada a realização de backup do sistema Schoolbus.</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <div class="title">
              Apenas clique no botão para realizar o backup.
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <button type="submit" name="backup" class="btn btn-success btn-lg"><i class="fa fa-download"></i> Efetuar backup</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
