<?php
  function getPath($page) {
      $current_dir = dirname($_SERVER['PHP_SELF']);
      if ($current_dir == '/') {
          $current_dir = '';
      }
      return $current_dir . '/' . $page;
  }
?>
  <div class="nav_center">
    <a href="<?php echo $path2root; ?>index.php"> CONTIGENTE</a>
  </div>

  <div class="nav_block">

      <a href="<?php echo $path2root; ?>paginas_form\produto\listar_loja_produtos.php"> Loja</a>
      <a href="<?php echo $path2root; ?>proxima_page"> Sugestões</a>    
      
    <div class="nav_right">
      <a href="<?php echo $path2root; ?>proxima_page"> Carrinho</a>
      <a href="<?php echo $path2root; ?>paginas_form\geral\form_login.php"> Iniciar sessão</a>   
      <a href="<?php echo $path2root; ?>proxima_page"> Conta</a>    
    </div>
  </div>
  