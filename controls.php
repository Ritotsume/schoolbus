<div class="col-md-9 controls">
  <?php
  if($page != 'home'):
    ?>
    <div class="row">
      <button type="button" class="btn btn-default" name="cadastrar" <?= ($view != 'cadastra') ? 'disabled="disabled"' : ''; ?> data-cadastrar="<?= $page; ?>">Gravar</button>
      <button type="submit" class="btn btn-default" name="editar" <?= ($view != 'update') ? 'disabled="disabled"' : ''; ?>>Editar</button>
      <button type="button" class="btn btn-default" name="cancelar"
      <?= (($view != 'cadastra') && ($view != 'update') && ($view != 'delete')) ? 'disabled="disabled"' : ''; ?>
      onclick="location.href='<?= HOME . $page; ?>'">Cancelar</button>
      <button type="submit" class="btn btn-default" name="deletar" <?= ($view != 'cadastras') ? 'disabled="disabled"' : ''; ?>>Deletar</button>
    </div>
    <?php
  endif;
  ?>
</div>
