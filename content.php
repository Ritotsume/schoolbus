<form action="" method="post">
  <?php
  $page = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
  $view = filter_input(INPUT_GET, 'view', FILTER_DEFAULT);
  $erros = array('401', '403', '404', '500');
  //
  //    if (isset($page) && $page != 'home'):
  //        include_once './controls.php';
  //    endif;

  include_once './controls.php';
  ?>
  <div class="col-md-9">
    <?php
    if (!in_array($page, $erros)):
      if (isset($page) && !empty($page)):
        if (isset($view) && !empty($view)):
          include_once './content' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $view . '.php';
          elseif (isset($page) && $page == 'home'):
            include_once './content/home.php';
          else:
            include_once './content/views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $page . '.php';
          endif;
        else:
          include_once './content/home.php';
        endif;
      else:
        include_once './errors' . DIRECTORY_SEPARATOR . $page . '.php';
      endif;
      ?>
    </form>
  </div>
  <script type="text/javascript" src="<?= HOME; ?>js/jquery.js"></script>
  <script type="text/javascript" src="<?= HOME; ?>js/bootstrap.js"></script>
  <script type="text/javascript" src="<?= HOME; ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= HOME; ?>js/npm.js"></script>
  <script type="text/javascript" src="<?= HOME; ?>js/bootbox.js"></script>
  <script type="text/javascript" src="<?= HOME; ?>js/myscripts.js"></script>
</body>
</html>
