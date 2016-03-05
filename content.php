<?php
$page = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$view = filter_input(INPUT_GET, 'view', FILTER_DEFAULT);
$erros = array('401', '403', '404', '500');
?>

<div class="container-fluid">
  <form action="" method="post" class="form-horizontal" id="frm-geral">

    <!-- <div class="side-body padding-top">
    <div class="row"> -->
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
      <!-- </div>
    </div> -->

  </form>
</div><!-- end container-fluid -->
