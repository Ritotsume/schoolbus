<div class="col-md-9 controls">
  <?php
  if($page != 'home'):
    ?>
    <div class="row">
      <button type="submit" class="btn btn-default" name="cadastrar" <?= ($view != 'cadastra') ? 'disabled="disabled"' : ''; ?>>Gravar</button>
      <button type="submit" class="btn btn-default" name="editar" <?= ($view != 'update') ? 'disabled="disabled"' : ''; ?>>Editar</button>
      <button type="submit" class="btn btn-default" name="cancelar" <?= ($view != 'cadastras') ? 'disabled="disabled"' : ''; ?>>Cancelar</button>
      <button type="submit" class="btn btn-default" name="deletar" <?= ($view != 'cadastras') ? 'disabled="disabled"' : ''; ?>>Deletar</button>
    </div>
    <?php
  else:
    ?>
    <div class="area-buttons">
      <a class="a-button theme" href="#cadrotas"> Rotas</a>
      <!--        <button class="theme" name="editar" <?= ($view != 'update') ? 'disabled="disabled"' : ''; ?>>Editar</button>
      <button class="theme" name="cancelar" <?= ($view != 'cadastras') ? 'disabled="disabled"' : ''; ?>>Cancelar</button>
      <button class="theme" name="deletar" <?= ($view != 'cadastras') ? 'disabled="disabled"' : ''; ?>>Deletar</button>-->
    </div>
    <?php
  endif;
  ?>
</div>
