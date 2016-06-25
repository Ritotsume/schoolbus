<!DOCTYPE html>
<html>

<?php include_once './app/Config.inc.php'; ?>
<head>
  <title>Schoolbus - Sistema de Gerenciamento de Transporte Escolar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
  <!-- CSS Libs -->
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/bootstrap-switch.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/checkbox3.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>lib/css/select2.min.css">
  <!-- CSS App -->
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>css/style.css">
  <link rel="stylesheet" type="text/css" href="<?= HOME; ?>css/themes/flat-blue.css">
</head>

<body class="flat-blue login-page">
  <div class="container">
    <div class="login-box">
      <div>
        <div class="login-form row">
          <div class="col-sm-12 text-center login-header">
            <i class="login-logo fa fa-bus fa-5x"></i>
            <h4 class="login-title">Schoolbus</h4>
          </div>
          <div class="col-sm-12">
            <div class="login-body">
              <!-- <div class="progress hidden" id="login-progress"> -->
              <?php
              $dataPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

              if(isset($dataPost) && !empty($dataPost))
              {
                $dataLogin = new ModelAdmin;
                if($dataLogin->Login($dataPost['username'], $dataPost['password']))
                {
                  header('Location: ' . HOME);
                }else{
                  ?>
                  <div class="progress" id="login-progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                      Login ou senha incorretos. Tente novamente.
                    </div>
                  </div>
                  <?php
                }
              }
              ?>
              <!-- <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
              Log In...
            </div>
          </div> -->
          <form method="post" action="">
            <div class="control">
              <input type="text" class="form-control" name="username" value="admin@gmail.com" autocomplete="off" />
            </div>
            <div class="control">
              <input type="password" name="password" class="form-control" value="123456" />
            </div>
            <div class="login-button text-center">
              <input type="submit" class="btn btn-primary" value="Login">
            </div>
          </form>
        </div>
        <div class="login-footer">
          <span class="text-right"><a href="#" class="text-info">Esqueci minha senha.</a></span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Javascript Libs -->
<script type="text/javascript" src="<?= HOME; ?>lib/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/Chart.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/bootstrap-switch.min.js"></script>

<script type="text/javascript" src="<?= HOME; ?>lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/ace/ace.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/ace/mode-html.js"></script>
<script type="text/javascript" src="<?= HOME; ?>lib/js/ace/theme-github.js"></script>
<!-- Javascript -->
<script type="text/javascript" src="<?= HOME; ?>js/app.js"></script>
</body>

</html>
