<div class="container-fluid">
  <form action="" method="post" class="form-horizontal" id="frm-geral">
    <?php
      if (isset($page) && !empty($page)):
        if(file_exists('./content/views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $page . '.php')):
          if(isset($view) && !empty($view)):
            if(file_exists('./content/views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $view . '.php')):
              include_once './content' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $view . '.php';
            else:
              header('HTTP/1.0 404 Not Found');
              include_once './errors/404.php';
            endif;
          else:
            include_once './content/views' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $page . '.php';
          endif;
        else:
          header('HTTP/1.0 404 Not Found');
          include_once './errors/404.php';
        endif;
      else:
        include_once './content/views/home/home.php';
      endif;
    ?>
  </form>
</div><!-- end container-fluid -->
